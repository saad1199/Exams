<?php
session_start();

include 'Engine/dbutils.php';

$conn = OpenCon();
//reg_allocated_center_inst_id=117 AND
$sql = "SELECT * from StudentRegistration where reg_roll_no LIKE '8%'";

$result = mysqli_query($conn, $sql);

$suspecious = array();
$incomplete = array();

$PASS_PERCENTAGE = 35;
$PASS_PERCENTAGE_OTHERS = 35;
$SUBJECT_PROMOTING_PERCENTAGE = 20;
$logStr = "";


function getPercentage($marks, $threshold)
{
    return $threshold * ($marks / 100);
}

function hardPolicy($marks,$subID)
{
    if($subID==12 || $subID==13){

        if($marks==14){
            $marks+=4;
        }else if($marks==15){
            $marks+=3;
        }else if($marks==16){
            $marks+=2;
        }else if($marks==17){
            $marks+=1;
        }
    }else{
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

        $isl = 0; //cat 2
        $his = 0;    //cat 2
        $geo = 0;    //cat 1
        $ikh = 0;    //cat 2
        $sci = 0;    //cat 2
        $com = 0;    //cat 2


        $engt = 100;    //cat 1 
        $mathst = 100;   //cat 1
        $urdt = 100;    //cat 2
        $islt = 100;    //cat 2
        //$nazrat = 40;  //cat 2
        $hist = 50;    //cat 2
        $geot = 50;    //cat 1
        $comt = 100;    //cat 2
        $scit = 100;    //cat 2
        $ikht = 100;    //cat 2

        $totalMarks = $engt + $mathst + $urdt + $hist + $geot + $scit + $islt+ $comt;

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

            if($rowx['sub_id']!=15){

            
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

                        $isl = $x;
                        $logStr .= "[ MUSLIM ] ";
                    }

                } else if ($rowx['sub_id'] == 8) { //eng
                    $eng = $x;
                } else if ($rowx['sub_id'] == 10) { //sci
                    $sci = $x;
                } else if ($rowx['sub_id'] == 11) { //maths
                    $maths = $x;
                }  else if ($rowx['sub_id'] == 12) { //geo
                    $geo = $x;
                } else if ($rowx['sub_id'] == 13) { //his
                    $his = $x;
                } else if ($rowx['sub_id'] == 14) { //com
                    $com = $x;
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
                } else if ($rowx['sub_id'] == 10) { //sci
                    array_push($incompleteCourses,"sst");
                } else if ($rowx['sub_id'] == 11) { //maths
                   array_push($incompleteCourses,"maths");
                } else if ($rowx['sub_id'] == 12) { //geo
                     array_push($incompleteCourses,"geo");
                } else if ($rowx['sub_id'] == 13) { //his
                     array_push($incompleteCourses,"his");
                }else if ($rowx['sub_id'] == 14) { //com
                    array_push($incompleteCourses,"com");
               }
                $isResultComplete = false;
                //break;
            }

        }
        } //Each Subject





        if ($isResultComplete) {


            $eng = hardPolicy($eng,8);
            $aggregateMarks += $eng;


            $maths = hardPolicy($maths,11);
            $aggregateMarks += $maths;


            $sci = hardPolicy($sci,10);
            $aggregateMarks += $sci;


            $urd = hardPolicy($urd,5);
            $aggregateMarks += $urd;

            $geo = hardPolicy($geo,12);
            $aggregateMarks += $geo;

            $his = hardPolicy($his,13);
            $aggregateMarks += $his;

            $com = hardPolicy($com,14);
            $aggregateMarks += $com;

          

            if ($isNonMuslim) {
                $ikh = hardPolicy($ikh,7);
                $aggregateMarks += $ikh;
            } else {

                $isl = hardPolicy($isl,6);
                $aggregateMarks += $isl;
            }

 
            $pp=getPercentage($engt,$PASS_PERCENTAGE);


            if ($eng < getPercentage($engt,$PASS_PERCENTAGE)) {

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

            if ($geo < getPercentage($geot, $PASS_PERCENTAGE_OTHERS)) {
                if ($geo == -1) {
                    array_push($absentSub, "geo");
                } else {
                    array_push($catBFailed, "geo");
                }
            }



            if ($his < getPercentage($hist, $PASS_PERCENTAGE_OTHERS)) {
                if ($his == -1) {
                    array_push($absentSub, "his");
                } else {
                    array_push($catBFailed, "his");
                }
            }

            if ($com < getPercentage($comt, $PASS_PERCENTAGE)) {
                if ($com == -1) {
                    array_push($absentSub, "com");
                } else {
                    array_push($catBFailed, "com");
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

                if ($isl < getPercentage($islt, $PASS_PERCENTAGE)) {
                    if ($isl == -1) {
                        array_push($absentSub, "isl");
                    } else {
                        array_push($catBFailed, "isl");
                    }
                }

                
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
                            if ($isl < getPercentage($islt, $SUBJECT_PROMOTING_PERCENTAGE)) {
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

                        if ($catBFailed[$i] == "his") {

                            if ($his < getPercentage($hist, $SUBJECT_PROMOTING_PERCENTAGE)) {
                                $assesmentStr .= "History Marks less than 20% ";
                                $toContinue = -1;
                                break;
                            }
                        }

                        if ($catBFailed[$i] == "geo") {

                            if ($geo < getPercentage($geot, $SUBJECT_PROMOTING_PERCENTAGE)) {
                                $assesmentStr .= "Geography Marks less than 20% ";
                                $toContinue = -1;
                                break;
                            }
                        }

                        if ($catBFailed[$i] == "com") {

                            if ($com < getPercentage($comt, $SUBJECT_PROMOTING_PERCENTAGE)) {
                                $assesmentStr .= "Computer Marks less than 20% ";
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
            $logStr .= ",computer : " . $com;

            if (!$isNonMuslim) {
                $logStr .= ",isl : " . $isl;
            } else {
                $logStr .= ",ikhlaqiat : " . $ikh;
            }

            $logStr .= ",urdu : " . $urd;
            $logStr .= ",geography : " . $geo;
            $logStr .= ",history : " . $his;

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

                $sqli = "INSERT INTO ResultEighth (
                res_e_student_id,
                res_e_isComplete,
                res_e_isIkhlaqiat,
                res_e_eng,
                res_e_maths,
                res_e_science,
                res_e_urdu,
                res_e_ikhlaqiaat,
                res_e_history,
                res_e_geography,
                res_e_computer,
                res_e_aggregate,
                res_e_percentage,
                res_e_assesment,
                res_e_status,
                res_e_grade) VALUES (
                '" . $row['reg_roll_no'] . "',
                '1',
                '1',
                '" . $eng . "',
                '" . $maths . "',
                '" . $sci . "',
                '" . $urd . "',
                '" . $ikh . "',
                '" . $his . "',
                '" . $geo . "',
                '" . $com . "',
                '" . $aggregateMarks . "',
                '" . $aggregatePercentage . "',
                '" . $assesmentStr . "',
                '" . $status . "',
                '" . $FinalGrade . "'
                );
        ";
       

            } else {
                $sqli = "INSERT INTO ResultEighth (
                res_e_student_id,
                res_e_isComplete,
                res_e_isIkhlaqiat,
                res_e_eng,
                res_e_maths,
                res_e_science,
                res_e_urdu,
                res_e_isl,
                res_e_history,
                res_e_geography,
                res_e_computer,
                res_e_aggregate,
                res_e_percentage,
                res_e_assesment,
                res_e_status,
                res_e_grade) VALUES (
                '" . $row['reg_roll_no'] . "',
                '1',
                '0',
                '" . $eng . "',
                '" . $maths . "',
                '" . $sci . "',
                '" . $urd . "',
                '" . $isl . "',
                '" . $his . "',
                '" . $geo . "',
                '" . $com . "',
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
