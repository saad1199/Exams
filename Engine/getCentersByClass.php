<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
$code = $_SESSION['inst_code'];

$token = $_GET['token'];
$subcat = $_GET['subcat'];

$session_token=null;

include 'dbutils.php';
$conn = OpenCon();
$class=getClass($subcat,$conn);

if(isset($_SESSION['session_token'])){
$session_token = $_SESSION['session_token'];
}
$grantAccess=false;
	if($session_token==$token){
			$grantAccess= true;		
}
if($grantAccess){
    
    $sql = "SELECT * FROM proposedInstitute WHERE pins_max_std>(SELECT COUNT(*) from StudentRegistration,SubjectCategory WHERE SubjectCategory.sub_cat_id=StudentRegistration.reg_student_subjectCat_sub_cat_id AND StudentRegistration.reg_allocated_center_inst_id=proposedInstitute.pins_id AND SubjectCategory.class=".$class.");";
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