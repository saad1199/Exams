<?php
ob_start();
session_start();

$code = $_SESSION['inst_code'];
$sid = $_POST['stdId'];
$roll = $_POST['stdRoll'];
$subcat = $_POST['subcat'];
$center = $_POST['centers'];
$isSubjectOnly = $_POST['subOnly'];

if (!$isSubjectOnly) {
    if (($center == "" || $subcat == "" || $center == null || $subcat == null)) {
        header('location:../search.php?status=BAD');
        exit();
    }
} else {
    if (($subcat == "" || $subcat == null)) {
        header('location:../search.php?status=BAD');
        exit();
    }
}

$session_token = null;

include 'dbutils.php';
$conn = OpenCon();


if (isset($_SESSION['session_token'])) {
    $session_token = $_SESSION['session_token'];
}
$grantAccess = false;
$live_key = getKey($code, $conn);

if ($live_key == $session_token) {
    $grantAccess = true;
}

if ($grantAccess) {
    $lock = getInstituteLockStatus($_SESSION['inst_code'], $conn);
    $cnic = getStudentCNIC($sid, $conn);
    if ($lock == '1') {
        makeStrictLog($_SESSION['inst_code'],"Change Student Center","Student Center Update","LOCKED",$cnic,$conn);
        header('location:../search.php?status=LOCK&sid=' . $sid);
        exit();
    }

    if ($lock == '-1') {
        $type = getStudentFeeType($sid, $conn); //check if late student if yes proceed otherwise send lock
        if ($type != "Late" || $type != "Double") {
            header('location:../search.php?status=LOCK&sid=' . $sid);
            exit();
        }
    }

    $currentCenter = getStudentCenterId($sid, $conn);
    $class = getClass($subcat, $conn);

    if ($isSubjectOnly) {

        $currentClass = getStudentClass($sid,$conn);
        $center=$currentCenter;
             if($currentClass==$class){
                $sql = "UPDATE StudentRegistration SET reg_student_subjectCat_sub_cat_id='" . $subcat . "' WHERE student_student_id='" . $sid . "';";
             
            }else{
            
                $cls = getClass($subcat, $conn);
                $rollno = $cls . "" . $center . "100";
                $nexRoll = $rollno;
                $isav = false;
                $limit = getCenterLimit($center, $conn);
        
                for ($i = 0; $i < $limit; $i++) {
                    $isVacc = isRollVaccant($nexRoll, $conn);
                    if ($isVacc) {
                        $isav = true;
                        break;
                    }
                    $nexRoll++;
                }
        
                $sql = "UPDATE StudentRegistration SET reg_allocated_center_inst_id='" . $center . "',reg_roll_no='" . $nexRoll . "',reg_student_subjectCat_sub_cat_id='" . $subcat . "' WHERE student_student_id='" . $sid . "';";

             }

        if (mysqli_query($conn, $sql)) {
            makeStrictLog($_SESSION['inst_code'],"Change Student SUBJECT","Student SUBJECT Update","UPDATED",$cnic,$conn);
            $str = "SUBJECT UPDATE - STUDENT CNIC " . getStudentCNIC($sid, $conn) . " SUBJECT TO " . $subcat;
            setChangeLog($str, $code);
            header('location:../search.php?status=OK_SUBJECT');
            exit();
        } else {
            header('location:../search.php?status=ERROR');
            exit();
            //ERROR
        }
    } else {

        $cls = getClass($subcat, $conn);
        $rollno = $cls . "" . $center . "100";
        $nexRoll = $rollno;
        $isav = false;
        $limit = getCenterLimit($center, $conn);

        for ($i = 0; $i < $limit; $i++) {
            $isVacc = isRollVaccant($nexRoll, $conn);
            if ($isVacc) {
                $isav = true;
                break;
            }
            $nexRoll++;
        }

        $sql = "UPDATE StudentRegistration SET reg_allocated_center_inst_id='" . $center . "',reg_roll_no='" . $nexRoll . "',reg_student_subjectCat_sub_cat_id='" . $subcat . "' WHERE student_student_id='" . $sid . "';";

        if (mysqli_query($conn, $sql)) {
            makeStrictLog($_SESSION['inst_code'],"Change Student Subject and Center","Student Subject and Center Updated","UPDATED",$cnic,$conn);
            $str = " CENTER UPDATE - STUDENT CNIC " . getStudentCNIC($sid, $conn) . " FROM " . $currentCenter . " TO " . $center;
            setChangeLog($str, $code);
            header('location:../search.php?status=OK_CENTER');
            exit();
        } else {
            header('location:../search.php?status=ERROR');
            exit();
            //ERROR

        }
    }
    header('location:../search.php?status=OK_ALL');
    exit();
} else {
    header('location:../search.php?status=ERROR');
    exit();
}
ob_end_flush();
?>
