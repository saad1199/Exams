<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
$uid = $_SESSION['_____USER_____ID'];
$sql="";

$sroll= $_GET['toSearchRollStart'];
//$eroll= $_GET['toSearchRollEnd'];


$localBridge="_______NEXT______INTEGER";
$parametricArrayIndex="________ROLL______NO____IN___";

$centerCodeArray = str_split($sroll);
$class=$centerCodeArray[0];
$first = $centerCodeArray[1];
$sec = $centerCodeArray[2];
$third = $centerCodeArray[3];

$centerCodeFinal=$first."".$sec."".$third;

$sql = "SELECT `Student`.*, `StudentRegistration`.*, `Institute`.* , RefGender.*, RefReligion.*, RefStudentType.*,SubjectCategory.*,proposedInstitute.*  FROM `Student` LEFT JOIN `Institute` ON `Student`.`student_institute_inst_id` = `Institute`.`inst_id`  LEFT JOIN `StudentRegistration` ON `StudentRegistration`.`student_student_id` = `Student`.`student_id` LEFT JOIN RefGender ON Student.student_gender_gender_id=RefGender.gender_id LEFT JOIN RefReligion ON Student.student_religion_religion_id=RefReligion.religion_id LEFT JOIN RefStudentType ON StudentRegistration.reg_student_type_std_type_id = RefStudentType.std_type_id LEFT JOIN SubjectCategory ON StudentRegistration.reg_student_subjectCat_sub_cat_id=SubjectCategory.sub_cat_id LEFT JOIN proposedInstitute ON proposedInstitute.pins_id=StudentRegistration.reg_allocated_center_inst_id WHERE StudentRegistration.reg_allocated_center_inst_id='".$centerCodeFinal."' AND reg_roll_no LIKE '".$class."%';";    
//$sql = "SELECT `StudentRegistration`.reg_roll_no,`StudentRegistration`.student_student_id,SubjectCategory.class FROM `Student` LEFT JOIN `Institute` ON `Student`.`student_institute_inst_id` = `Institute`.`inst_id`  LEFT JOIN `StudentRegistration` ON `StudentRegistration`.`student_student_id` = `Student`.`student_id` LEFT JOIN RefGender ON Student.student_gender_gender_id=RefGender.gender_id LEFT JOIN RefReligion ON Student.student_religion_religion_id=RefReligion.religion_id LEFT JOIN RefStudentType ON StudentRegistration.reg_student_type_std_type_id = RefStudentType.std_type_id LEFT JOIN SubjectCategory ON StudentRegistration.reg_student_subjectCat_sub_cat_id=SubjectCategory.sub_cat_id LEFT JOIN proposedInstitute ON proposedInstitute.pins_id=StudentRegistration.reg_allocated_center_inst_id WHERE reg_roll_no BETWEEN '".$sroll."' AND '".$eroll."';";

$subId =  $_SESSION['_____SUB_____ID'];
	

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
    $response=array();

    while($row =mysqli_fetch_assoc($result))
    {

       

            $sqlPs="SELECT marking_marks FROM `Marking` WHERE `marking_student_id`='".$row['reg_roll_no']."' AND `marking_sub_id`='".$subId."';";
		$ps=array();
            mysqli_set_charset( $conn, 'utf8');
            $resultPs = mysqli_query($conn, $sqlPs) or die("Error in Selecting " . mysqli_error($conn));
            while($rowPs =mysqli_fetch_assoc($resultPs))
            {
                    $ps[]=$rowPs;
    
            }
    

            $check_first= checkIfTrueSubject($row['reg_roll_no'],$conn);

            if($check_first){
            $response[] = array('student' => $row, 'marks' => $ps);
            }



              //  $emparray[] = $row;
            
                
        
   
    }
    echo json_encode($response);
    mysqli_close($conn);
}else {
    echo "Unauthorize Access";
}
?>

