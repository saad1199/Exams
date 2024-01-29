<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
$uid = $_SESSION['_____USER_____ID'];
$sql="";
//$sroll= $_GET['toSearchRollStart'];
//$eroll= $_GET['toSearchRollEnd'];
$localBridge="_______NEXT______INTEGER";
$parametricArrayIndex="________ROLL______NO____IN___";
$centercode=$_GET['center'];
//$sql = "SELECT `StudentRegistration`.reg_roll_no,`StudentRegistration`.student_student_id FROM `Student` LEFT JOIN `Institute` ON `Student`.`student_institute_inst_id` = `Institute`.`inst_id`  LEFT JOIN `StudentRegistration` ON `StudentRegistration`.`student_student_id` = `Student`.`student_id` LEFT JOIN RefGender ON Student.student_gender_gender_id=RefGender.gender_id LEFT JOIN RefReligion ON Student.student_religion_religion_id=RefReligion.religion_id LEFT JOIN RefStudentType ON StudentRegistration.reg_student_type_std_type_id = RefStudentType.std_type_id LEFT JOIN SubjectCategory ON StudentRegistration.reg_student_subjectCat_sub_cat_id=SubjectCategory.sub_cat_id LEFT JOIN proposedInstitute ON proposedInstitute.pins_id=StudentRegistration.reg_allocated_center_inst_id WHERE reg_roll_no BETWEEN '".$sroll."' AND '".$eroll."';";
$sql = "SELECT `Student`.*, `StudentRegistration`.*, `Institute`.* , RefGender.*, RefReligion.*, RefStudentType.*,SubjectCategory.*,proposedInstitute.*  FROM `Student` LEFT JOIN `Institute` ON `Student`.`student_institute_inst_id` = `Institute`.`inst_id`  LEFT JOIN `StudentRegistration` ON `StudentRegistration`.`student_student_id` = `Student`.`student_id` LEFT JOIN RefGender ON Student.student_gender_gender_id=RefGender.gender_id LEFT JOIN RefReligion ON Student.student_religion_religion_id=RefReligion.religion_id LEFT JOIN RefStudentType ON StudentRegistration.reg_student_type_std_type_id = RefStudentType.std_type_id LEFT JOIN SubjectCategory ON StudentRegistration.reg_student_subjectCat_sub_cat_id=SubjectCategory.sub_cat_id LEFT JOIN proposedInstitute ON proposedInstitute.pins_id=StudentRegistration.reg_allocated_center_inst_id WHERE proposedInstitute.pins_id='".$centercode."';";    

$token = $_GET['token'];
$session_token=null;
include 'dbutils.php';
$conn = OpenCon();
if(isset($_SESSION['_____USER_____KEY'])){
    $session_token = $_SESSION['_____USER_____KEY'];
}
$grantAccess=false;
$live_key = getUserAPIToken($uid,$conn); //db token

if($live_key==$session_token&&$live_key==$token&&$session_token==$token&&$_SESSION['_____AUTHENTICATED']==true){
    $grantAccess= true;
}
if($grantAccess){
   
    mysqli_set_charset( $conn, 'utf8');
    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
    
    //create an array
    
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {

        $check_first= checkIfTrueSubject($row['reg_roll_no'],$conn);

        if($check_first){
            $check = checkIfMarksFinal($row['reg_roll_no'],$conn);
            if(!$check){
                $emparray[] = $row;
            }
        }
   
    }
    echo json_encode($emparray);
    mysqli_close($conn);
}else {
    echo "Unauthorize Access";
}
?>

