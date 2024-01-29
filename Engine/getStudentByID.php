<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
$code = $_SESSION['inst_code'];
$sid = $_GET['sid'];
$token = $_GET['token'];
$session_token=null;
include 'dbutils.php';
$conn = OpenCon();
if(isset($_SESSION['session_token'])){
    $session_token = $_SESSION['session_token'];
}
$grantAccess=false;
$live_key = getKey($code,$conn); //db token
if($live_key==$session_token&&$live_key==$token){
    $grantAccess= true;
}
if($grantAccess){
    $sql = "SELECT * FROM `Student`,StudentRegistration,RefStudentType,RefReligion,RefGender,SubjectCategory,Institute,proposedInstitute WHERE Student.student_id=StudentRegistration.student_student_id AND StudentRegistration.reg_student_type_std_type_id = RefStudentType.std_type_id AND proposedInstitute.pins_id=StudentRegistration.reg_allocated_center_inst_id AND Student.student_gender_gender_id = RefGender.gender_id AND Student.student_religion_religion_id = RefReligion.religion_id AND StudentRegistration.reg_student_subjectCat_sub_cat_id=SubjectCategory.sub_cat_id AND Institute.inst_id=Student.student_institute_inst_id AND Student.student_institute_inst_id = '".$code."' AND Student.student_id='".$sid."';";     
    mysqli_set_charset( $conn, 'utf8');
    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
    //create an array
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
    echo json_encode($emparray);
    mysqli_close($conn);
}else {
    echo "Unauthorize Access";
}
?>