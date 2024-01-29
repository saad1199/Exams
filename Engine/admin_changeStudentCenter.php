<?php
session_start();

function execute($conn,$code){

    $sqlx = "SELECT * FROM Student,StudentRegistration,proposedInstitute where Student.student_id=StudentRegistration.student_student_id AND StudentRegistration.reg_allocated_center_inst_id=proposedInstitute.pins_id AND pins_id='".$code."';";
    $resultx = mysqli_query($conn, $sqlx);
    $count=1;
    while ($rowx = mysqli_fetch_assoc($resultx)) {
    
             $rollno = $code.'0'.$count;
             $updateStudentx = "UPDATE StudentRegistration SET reg_roll_no='".$rollno."',isNewRoll=0 WHERE student_student_id='".$rowx['student_student_id']."';";
             mysqli_query($conn, $updateStudentx);
             $count++;    
    } 
 }


$code = $_SESSION['inst_code'];
$std_cnic = $_POST['stdId'];
$std_name=$_POST['stdName'];
$subcat =$_POST['subcat'];
$center=$_POST['centers'];

if(($center=="" || $subcat=="" || $center==null || $subcat==null)){
    header('location:../pages/changeStudentCenter.php?status=BAD');
    exit();
}

$session_token=null;

include 'dbutils.php';
$conn = OpenCon();


if(isset($_SESSION['session_token'])){
    $session_token = $_SESSION['session_token'];
 
}
$grantAccess=false;
$live_key = getKey($code,$conn); 

if($live_key==$session_token){
    $grantAccess= true;
}

if($grantAccess){
  
    $lock=getInstituteLockStatus($_SESSION['inst_code'],$conn);

   
$sid=getStudentId($conn,$std_name,$std_cnic);

$isSubjectOnly=false;

$currentCenter=getStudentCenterId($sid,$conn);

if($currentCenter==$center){
   
    $currentClass = getStudentClass($sid,$conn);
    $class=getClass($subcat,$conn);
  
    if($currentClass==$class){
       $isSubjectOnly=true;
    } 
}


if($isSubjectOnly){
   
    $sql = "UPDATE StudentRegistration SET reg_student_subjectCat_sub_cat_id='".$subcat."' WHERE student_student_id='".$sid."';";

            if(mysqli_query($conn,$sql)){
              $str = "SUBJECT UPDATE - STUDENT CNIC ".getStudentCNIC($sid,$conn)." SUBJECT TO ".$subcat;
              //setChangeLog($str,$code);  
              header('location:../pages/changeStudentCenter.php?status=OK_SUBJECT');
                exit();
            }else {
                header('location:../pages/changeStudentCenter.php?status=ERROR');
                exit();
            //ERROR
            
            }

}else{

$cls = getClass($subcat,$conn);
$rollno=$cls."".$center."100";
$nexRoll = $rollno;
$isav = false;
$limit = getCenterLimit($center,$conn);


 for($i=0;$i<$limit;$i++){
    $isVacc=isRollVaccant($nexRoll,$conn);
    if($isVacc){
        $isav=true;
        break;
    }
    $nexRoll++;
 }
   
 $sql = "UPDATE StudentRegistration SET reg_allocated_center_inst_id='".$center."',reg_roll_no='".$nexRoll."',reg_student_subjectCat_sub_cat_id='".$subcat."' WHERE student_student_id='".$sid."';";

            if(mysqli_query($conn,$sql)){
                $str = " CENTER UPDATE - STUDENT CNIC ".getStudentCNIC($sid,$conn)." FROM ".$currentCenter." TO ".$center;
                 //execute($conn,$currentCenter);
                 //execute($conn,$center);
                //setChangeLog($str,$code);
                header('location:../pages/changeStudentCenter.php?status=OK_CENTER');
                exit();
            }else {
                header('location:../pages/changeStudentCenter.php?status=ERROR');
                exit();
            //ERROR
            
            }
}
header('location:../pages/changeStudentCenter.php?status=OK_ALL');
exit();
}
else{
    header('location:../pages/changeStudentCenter.php?status=ERROR');
    exit();
}
