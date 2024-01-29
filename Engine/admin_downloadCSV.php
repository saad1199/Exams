<?php
session_start();

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="data.csv"');

$code = $_SESSION['inst_code'];
$centercode=$_GET['emis'];

$token = $_GET['token'];
$session_token=null;
include 'dbutils.php';
$conn = OpenCon();
if(isset($_SESSION['session_token'])){
    $session_token = $_SESSION['session_token'];
}
$grantAccess=false;
$live_key = getKey($code,$conn); //db token
if($live_key==$session_token&&$live_key==$token&&$session_token==$token){
    $grantAccess= true;
}
if($grantAccess){
    $sql = "";
    //
    if($emis=="ALL"){
        $sql = "SELECT `Student`.*, `StudentRegistration`.*, `Institute`.* , RefGender.*, RefReligion.*, RefStudentType.*,SubjectCategory.* FROM `Student` LEFT JOIN `Institute` ON `Student`.`student_institute_inst_id` = `Institute`.`inst_id` LEFT JOIN `StudentRegistration` ON `StudentRegistration`.`student_student_id` = `Student`.`student_id` LEFT JOIN RefGender ON Student.student_gender_gender_id=RefGender.gender_id LEFT JOIN RefReligion ON Student.student_religion_religion_id=RefReligion.religion_id LEFT JOIN RefStudentType ON StudentRegistration.reg_student_type_std_type_id = RefStudentType.std_type_id LEFT JOIN SubjectCategory ON StudentRegistration.reg_student_subjectCat_sub_cat_id=SubjectCategory.sub_cat_id ORDER BY reg_roll_no LIMIT ".$startLimit.",500;";    
    }else{
        $sql = "SELECT `Student`.*, `StudentRegistration`.*, `Institute`.* , RefGender.*, RefReligion.*, RefStudentType.*,SubjectCategory.*,proposedInstitute.*  FROM `Student` LEFT JOIN `Institute` ON `Student`.`student_institute_inst_id` = `Institute`.`inst_id`  LEFT JOIN `StudentRegistration` ON `StudentRegistration`.`student_student_id` = `Student`.`student_id` LEFT JOIN RefGender ON Student.student_gender_gender_id=RefGender.gender_id LEFT JOIN RefReligion ON Student.student_religion_religion_id=RefReligion.religion_id LEFT JOIN RefStudentType ON StudentRegistration.reg_student_type_std_type_id = RefStudentType.std_type_id LEFT JOIN SubjectCategory ON StudentRegistration.reg_student_subjectCat_sub_cat_id=SubjectCategory.sub_cat_id LEFT JOIN proposedInstitute ON proposedInstitute.pins_id=StudentRegistration.reg_allocated_center_inst_id WHERE proposedInstitute.pins_id='".$centercode."';";    
 
    }
    mysqli_set_charset( $conn, 'utf8');
    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
  

    if (mysqli_num_rows($result) > 0) {
        // Create the CSV file
        $csv = fopen('data.csv', 'w');
        
        // Write the data to the CSV file
        fputcsv($csv, array('Roll Number','Type','Full Name','Father Name','Gender','Date of Birth','CNIC/B-Form','Contact','Residential Address','Email Address','Class','Subject Category','Reg.Institute EMIS','Reg.Institute Name','Date Registered'));
        
        while($row = mysqli_fetch_assoc($result)) {
            fputcsv($csv, array($row['reg_roll_no'],$row['std_type_det'],$row['student_name'], $row['student_father_name'],$row['gender_det'],$row['student_date_of_birth'],$row['student_b_form'], $row['student_contact_number'],$row['student_address'],$row['student_email'],$row['class'],$row['cls_name'],$row['inst_id'],$row['inst_name'],$row['reg_date']));
        }
    
        // Close the file
        fclose($csv);
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
    // Open the file
$file = fopen('data.csv', 'r');

// Read the contents of the file and send it to the browser
echo fread($file, filesize('data.csv'));

// Close the file
fclose($file);
}else {
    echo "Unauthorize Access";
}
?>

