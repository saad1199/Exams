<?php
session_start();

include 'Engine/dbutils.php';

$conn = OpenCon();
//reg_allocated_center_inst_id=117 AND
$sql = "SELECT * from StudentRegistration where reg_roll_no LIKE '5%'";

$result = mysqli_query($conn, $sql);

$suspecious = array();
$incomplete = array();
$PASS_PERCENTAGE = 35;
$SUBJECT_PROMOTING_PERCENTAGE = 20;
$logStr = "";


function getPercentage($marks, $threshold)
{
    return $threshold * ($marks / 100);
}

function hardPolicy($marks)
{
    if ($marks == 32) { //AUTOMATIC POLICY IF 32 OR 18 MARKS GIVE ABSOLUTE MARKS MARKS
        $marks += 3;
    } else if ($marks == 33) {
        $marks += 2;
    } else if ($marks == 34) {
        $marks += 1;
    } else if ($marks == 18) {
        $marks += 2;
    } else if ($marks == 19) {
        $marks += 1;
    }
    return $marks;
}

while ($row = mysqli_fetch_assoc($result)) {
    echo "Processing " . $row['reg_roll_no'] . " ";
    $logStr .= "Processing [" . $row['reg_roll_no'] . "] ";
    $isAlreadyDone = checkIfFifthStudentAlreadyCompiled($row['reg_roll_no'], $conn);

    if (!$isAlreadyDone) {


        $sqlSUB = "SELECT sub_id,SubjectCategory.sub_cat_id FROM `StudentRegistration`,SubjectCategory,RefSubject,SubjectCategory_RefSubject WHERE StudentRegistration.reg_student_subjectCat_sub_cat_id=SubjectCategory.sub_cat_id AND SubjectCategory.sub_cat_id=SubjectCategory_RefSubject.SubjectCategory_sub_cat_id AND SubjectCategory_RefSubject.sub_cat_subjects_sub_id=RefSubject.sub_id AND StudentRegistration.reg_roll_no='" . $row['reg_roll_no'] . "';";

        $nresult = mysqli_query($conn, $sqlSUB);

        $eng = 0;    //cat 1 
        $maths = 0;   //cat 1
        $urd = 0;    //cat 2
        $isl = 0;    //cat 2
        $nazra = 0;  //cat 2
        $islAndNazra = 0; //cat 2
        $sst = 0;    //cat 2
        $sci = 0;    //cat 1
        $ikh = 0;    //cat 2


        $engt = 100;    //cat 1 
        $mathst = 100;   //cat 1
        $urdt = 100;    //cat 2
        $islAndNazrat = 100;    //cat 2
        //$nazrat = 40;  //cat 2
        $sstt = 100;    //cat 2
        $scit = 100;    //cat 1
        $ikht = 100;    //cat 2

        $totalMarks = $engt + $mathst + $urdt + $nazrat + $sstt + $scit + $ikht;

  
        $aggregateMarks = 0;
        $aggregatePercentage = 0;
        $FinalGrade = "";

        $catAFailed = array();
        $catBFailed = array();
        $absentSub = array();

        $isNonMuslim = false;
        $isResultComplete = true;

        $isPolicyApplicable = true;
        $isSecurePass = false;

        $incompleteCourses= array();

        while ($rowx = mysqli_fetch_assoc($nresult)) {

            $x = getStudentMarks($row['reg_roll_no'], $rowx['sub_id'], $conn);

            if ($x != "") {

                if ($rowx['sub_id'] == 5) { //urd
                    $urd = $x;
                } else if ($rowx['sub_id'] == 6 || $rowx['sub_id'] == 7) { //isl || ikh

                    if ($rowx['sub_id'] == 7) {

                        $ikh = $x;
                        $isNonMuslim = true;
                        $logStr .= "[ NON-MUSLIM ] ";

                    } else {
                        $islAndNazra += $x;
                        $isl = $x;
                        $logStr .= "[ MUSLIM ] ";
                    }

                } else if ($rowx['sub_id'] == 8) { //eng

                    $eng = $x;
                } else if ($rowx['sub_id'] == 9) { //sst

                    $sst = $x;
                } else if ($rowx['sub_id'] == 11) { //maths

                    $maths = $x;
                } else if ($rowx['sub_id'] == 15) { //nazra
                    $nazra = $x;
                    if ($nazra != -1) {
                        $islAndNazra += $x;
                    }
                } else if ($rowx['sub_id'] == 16) { //science
                    $sci = $x;
                }
            } else {
                 if ($rowx['sub_id'] == 5) { //urd
                    array_push($incompleteCourses,"urd");
                } else if ($rowx['sub_id'] == 6 || $rowx['sub_id'] == 7) { //isl || ikh

                    if ($rowx['sub_id'] == 7) {
                        $isNonMuslim = true;
                         array_push($incompleteCourses,"ikh");
                    } else {
                         array_push($incompleteCourses,"isl");
                    }
                } else if ($rowx['sub_id'] == 8) { //eng

                   array_push($incompleteCourses,"eng");
                } else if ($rowx['sub_id'] == 9) { //sst

                    array_push($incompleteCourses,"sst");
                } else if ($rowx['sub_id'] == 11) { //maths

                   array_push($incompleteCourses,"maths");
                } else if ($rowx['sub_id'] == 15) { //nazra
                     array_push($incompleteCourses,"nazra");
                } else if ($rowx['sub_id'] == 16) { //science
                     array_push($incompleteCourses,"sci");
                }
                $isResultComplete = false;
                //break;
            }
        } //Each Subject





        if ($isResultComplete) {

            $eng = hardPolicy($eng);
            $aggregateMarks += $eng;


            $maths = hardPolicy($maths);
            $aggregateMarks += $maths;



            $sci = hardPolicy($sci);
            $aggregateMarks += $sci;



            $urd = hardPolicy($urd);
            $aggregateMarks += $urd;



            $sst = hardPolicy($sst);
            $aggregateMarks += $sst;


            if ($isNonMuslim) {

                $ikh = hardPolicy($ikh);
                $aggregateMarks += $ikh;
            } else {

                $islAndNazra = hardPolicy($islAndNazra);
                $aggregateMarks += $islAndNazra;
            }

            if ($eng < getPercentage($engt, $PASS_PERCENTAGE)) {
                if ($eng == -1) {
                    array_push($absentSub, "eng");
                } else {
                    array_push($catAFailed, "eng");
                }
            }


            if ($maths < getPercentage($mathst, $PASS_PERCENTAGE)) {
                if ($maths == -1) {
                    array_push($absentSub, "maths");
                } else {
                    array_push($catAFailed, "maths");
                }
            }


            if ($sci < getPercentage($scit, $PASS_PERCENTAGE)) {
                if ($sci == -1) {
                    array_push($absentSub, "sci");
                } else {
                    array_push($catAFailed, "sci");
                }
            }



            if ($urd < getPercentage($urdt, $PASS_PERCENTAGE)) {
                if ($urd == -1) {
                    array_push($absentSub, "urd");
                } else {
                    array_push($catBFailed, "urd");
                }
            }

            if ($sst < getPercentage($sstt, $PASS_PERCENTAGE)) {
                if ($sst == -1) {
                    array_push($absentSub, "sst");
                } else {
                    array_push($catBFailed, "sst");
                }
            }

            if ($isNonMuslim) {
                if ($ikh < getPercentage($ikht, $PASS_PERCENTAGE)) {
                    if ($ikh == -1) {
                        array_push($absentSub, "ikh");
                    } else {
                        array_push($catBFailed, "ikh");
                    }
                }
            } else {

                if ($islAndNazra < getPercentage($islAndNazrat, $PASS_PERCENTAGE)) {
                    if ($isl == -1) {
                        array_push($absentSub, "isl");
                    } else {
                        array_push($catBFailed, "isl");
                    }
                }

                // if ($nazra < getPercentage($nazrat,$PASS_PERCENTAGE)) {
                if ($nazra == -1) {
                    array_push($absentSub, "nazra");
                }
                //else {
                //         array_push($catBFailed, "nazra");
                //   }
                //}
            }


            $aggregatePercentage = ($aggregateMarks / $totalMarks) * 100;

            $assesmentStr = "";

            if (count($catAFailed) == 0 && count($catBFailed) == 0 && count($absentSub) == 0 && $aggregatePercentage >= 40) {
                $isPolicyApplicable = false;
                $assesmentStr .= "Passed ";
                $isSecurePass = true;
            } else {
                $shouldSeek = true;

                if (count($catAFailed) >= 2) {
                    $assesmentStr .= "Category A Failed with 2 or more ";
                    $shouldSeek = false;
                }
                if (count($catBFailed) >= 3) {
                    $assesmentStr .= "Category B Failed with 3 or more ";
                    $shouldSeek = false;
                }
                if (count($absentSub) > 0) {
                    $assesmentStr .= "Absent in one or more ";
                    $shouldSeek = false;
                }
                if ($aggregatePercentage < 40.00) {
                    $assesmentStr .= "Aggregate is less than 40%";
                    $shouldSeek = false;
                }

                if (!$shouldSeek) {
                    $isPolicyApplicable = false;
                }
            }

            $toContinue = 0;

            if ($isPolicyApplicable) {
                $logStr .= "[ APPLIED ] ";


                for ($i = 0; $i < count($catAFailed); $i++) {

                    if ($catAFailed[$i] == "eng") {
                        if ($eng < getPercentage($engt, $SUBJECT_PROMOTING_PERCENTAGE)) {
                            $assesmentStr .= "English Marks less than 20% ";
                            $toContinue = -1;
                            break;
                        }
                    }
                    if ($catAFailed[$i] == "maths") {
                        if ($maths < getPercentage($mathst, $SUBJECT_PROMOTING_PERCENTAGE)) {
                            $assesmentStr .= "Maths Marks less than 20% ";
                            $toContinue = -1;
                            break;
                        }
                    }
                    if ($catAFailed[$i] == "sci") {
                        if ($sci < getPercentage($scit, $SUBJECT_PROMOTING_PERCENTAGE)) {
                            $assesmentStr .= "Science Marks less than 20% ";
                            $toContinue = -1;
                            break;
                        }
                    }
                    $toContinue = 2;
                }

                if ($toContinue == 2 || $toContinue == 0) {

                    for ($i = 0; $i < count($catBFailed); $i++) {

                        if ($catBFailed[$i] == "isl") {
                            if ($islAndNazra < getPercentage($islAndNazrat, $SUBJECT_PROMOTING_PERCENTAGE)) {
                                $assesmentStr .= "Islamiat and Nazra Marks less than 20% ";
                                $toContinue = -1;
                                break;
                            }
                        }

                        if ($catBFailed[$i] == "ikh") {
                            if ($ikh < getPercentage($ikht, $SUBJECT_PROMOTING_PERCENTAGE)) {
                                $assesmentStr .= "Ikhlaqiaat Marks less than 20% ";
                                $toContinue = -1;
                                break;
                            }
                        }

                        if ($catBFailed[$i] == "sst") {

                            if ($sst < getPercentage($sstt, $SUBJECT_PROMOTING_PERCENTAGE)) {
                                $assesmentStr .= "SST Marks less than 20% ";
                                $toContinue = -1;
                                break;
                            }
                        }
                        if ($catBFailed[$i] == "urd") {
                            if ($urd < getPercentage($urdt, $SUBJECT_PROMOTING_PERCENTAGE)) {
                                $assesmentStr .= "Urdu Marks less than 20% ";
                                $toContinue = -1;
                                break;
                            }
                        }
                        $toContinue = 2;
                    }
                    if ($toContinue == 2) {
                        $assesmentStr .= "Satisfied Policy ";
                    }
                }
            } else {
                $logStr .= "[ NOT APPLIED ] ";
            }

            $logStr .= "[ ";
            $logStr .= "eng : " . $eng;
            $logStr .= ",maths : " . $maths;
            $logStr .= ",science : " . $sci;
            $logStr .= ",sst : " . $sst;

            if (!$isNonMuslim) {
                $logStr .= ",isl : " . $isl;
                $logStr .= ",nazra : " . $nazra;
            } else {
                $logStr .= ",ikhlaqiat : " . $ikh;
            }

            $logStr .= ",urdu : " . $urd;
            $logStr .= "] [Assessment : " . $assesmentStr;
            $logStr .= "] [STATUS : ";

            $status = "";
            if ($isSecurePass) {
                $logStr .= "PASSED ]";
                $status = "PASSED";
            } else {
                if ($toContinue == 2) {
                    $logStr .= "PROMOTED ]";
                    $status = "PROMOTED";
                } else {
                    $logStr .= "FAILED ]";
                    $status = "FAILED";
                }
            }
            $logStr .= " [ Failed Category A COUNT : " . count($catAFailed) . "]";
            $logStr .= " [Failed Category B COUNT : " . count($catBFailed) . "] [";

            $logStr .= $row['reg_roll_no'] . " ABSENT SUBJECTS : " . count($absentSub) . " ] [ ";

            $sqli = "";

            
if ($aggregatePercentage >= 90.00 && $aggregatePercentage <= 100.00) {
    $FinalGrade = "A1";
} else if ($aggregatePercentage >= 80.00 && $aggregatePercentage < 90.00) {
    $FinalGrade = "A";
} else if ($aggregatePercentage >= 70.00 && $aggregatePercentage < 80.00) {
    $FinalGrade = "B";
} else if ($aggregatePercentage >= 60.00 && $aggregatePercentage < 70.00) {
    $FinalGrade = "C";
} else if ($aggregatePercentage >= 50.00 && $aggregatePercentage < 60.00) {
    $FinalGrade = "D";
} else if ($aggregatePercentage >= 40.00 && $aggregatePercentage < 50.00) {
    $FinalGrade = "E";
} else if ($aggregatePercentage < 40.00) {
    $FinalGrade = "F";
}

            $logStr .= " [ " . $FinalGrade . " ] ";

            if ($isNonMuslim) {
                $sqli = "INSERT INTO ResultFifth (
                res_f_student_id,
                res_f_isComplete,
                res_f_isIkhlaqiat,
                res_f_eng,
                res_f_maths,
                res_f_science,
                res_f_sst,
                res_f_urdu,
                res_f_ikhlaqiaat,
                res_f_aggregate,
                res_f_percentage,
                res_f_assesment,
                res_f_status,
                res_f_grade) VALUES (
                '" . $row['reg_roll_no'] . "',
                '1',
                '1',
                '" . $eng . "',
                '" . $maths . "',
                '" . $sci . "',
                '" . $sst . "',
                '" . $urd . "',
                '" . $ikh . "',
                '" . $aggregateMarks . "',
                '" . $aggregatePercentage . "',
                '" . $assesmentStr . "',
                '" . $status . "',
                '" . $FinalGrade . "'
                );
        ";
            } else {
                $sqli = "INSERT INTO ResultFifth (
                res_f_student_id,
                res_f_isComplete,
                res_f_isIkhlaqiat,
                res_f_eng,
                res_f_maths,
                res_f_science,
                res_f_sst,
                res_f_urdu,
                res_f_isl,
                res_f_nazra,
                res_f_aggregate,
                res_f_percentage,
                res_f_assesment,
                res_f_status,
                res_f_grade) VALUES (
                '" . $row['reg_roll_no'] . "',
                '1',
                '0',
                '" . $eng . "',
                '" . $maths . "',
                '" . $sci . "',
                '" . $sst . "',
                '" . $urd . "',
                '" . $isl . "',
                '" . $nazra . "',
                '" . $aggregateMarks . "',
                '" . $aggregatePercentage . "',
                '" . $assesmentStr . "',
                '" . $status . "',
                '" . $FinalGrade . "'
                );
        ";
            }

            if (mysqli_query($conn, $sqli)) {
                echo " Updated";
                $logStr .= " [ UPDATED ] ";
                if (checkIfFifthStudentAlreadyNotCompiled($row['reg_roll_no'], $conn)) {
                    $sqld = "DELETE FROM FailedCompilation WHERE fc_student_id='" . $row['reg_roll_no'] . "';";
                    if (mysqli_query($conn, $sqld)) {
                        echo " DELETED COMPILATION";
                        $logStr .= " [ DELETED COMPILATION RECORD ] ";
                    } else {


                        echo " ERROR Updating Compilation";
                        $logStr .= " [ ERROR UPDATING COMPILATION RECORD ] ";
                    }
                }
            } else {
                echo " ERROR";
                $logStr .= " [ ERROR ] ";
            }

            if (count($absentSub) >= 6) {
                array_push($suspecious, $row['reg_roll_no']);
                if (!checkIfFifthStudentAlreadyNotCompiled($row['reg_roll_no'], $conn)) {
                    $sqlInc = "INSERT INTO FailedCompilation (
                    fc_student_id,
                    fc_type
                    ) VALUES (
                    '" . $row['reg_roll_no'] . "',
                    'Suspecious'
                    );
            ";
                    if (mysqli_query($conn, $sqlInc)) {
                        echo " Updated Compilation";
                        $logStr .= " [ UPDATED COMPILATION RECORD ] ";
                    } else {
                        echo " ERROR Updating Compilation";
                        $logStr .= " [ ERROR UPDATING COMPILATION RECORD ] ";
                    }
                }
            } else {
                //ADD TO RESULT UPDATE IF EXISTS

            }


            $logStr .= " [ PERCENTAGE : " . $aggregatePercentage . " ] ";
        } else {

            array_push($incomplete, $row['reg_roll_no']);

            //ADD TO INCOMPLETE RESULT UPDATE IF EXISTS
            if (!checkIfFifthStudentAlreadyNotCompiled($row['reg_roll_no'], $conn)) {
                $sqlInc = "INSERT INTO FailedCompilation (
                fc_student_id,
                fc_type,
                fc_courses
                ) VALUES (
                '" . $row['reg_roll_no'] . "',
                'Incomplete',
                '".implode(",",$incompleteCourses)."'
                );
        ";
    
                if (mysqli_query($conn, $sqlInc)) {
                    echo " Updated Compilation";
                    $logStr .= " [ UPDATED COMPILATION RECORD ] ";
                } else {
                    echo " ERROR Updating Compilation";
                    $logStr .= " [ ERROR UPDATING COMPILATION RECORD ] ";
                }
            }
            echo "<br>Incomplete<br><br><br>";
            $logStr .= " [ INCOMPLETE ] ";
        }
    } //Already DONE CHECK
    else {
        echo "ALREADY PROCESSED";
        $logStr .= " [ ALREADY PROCESSED ] ";
    }
    echo "_______________________________________<br>";
    $logStr .= "\n";
}

setResultLog($logStr);
echo $logStr;
