<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

$token = $_GET['token'];
$session_token=null;

include 'dbutils.php';
$conn = OpenCon();


if(isset($_SESSION['session_token'])){
$session_token = $_SESSION['session_token'];
}

$grantAccess=false;
	if($session_token==$token){
			$grantAccess= true;		
}


if($grantAccess){
	
$sql="SELECT COUNT(*) As marked from Marking WHERE Marking.marking_student_id IN (Select StudentRegistration.reg_roll_no from StudentRegistration) AND marking_sub_id='".$_SESSION['_____SUB_____ID']."';";
mysqli_set_charset( $conn, 'utf8');
    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));

    //create an array
    $emparray = null;
    while($row =mysqli_fetch_assoc($result))
    {
		
        $emparray = $row;
		
    }
    
    
$sqlx="SELECT COUNT(*) As total from StudentRegistration,RefSubject,SubjectCategory_RefSubject WHERE 
StudentRegistration.reg_student_subjectCat_sub_cat_id=SubjectCategory_RefSubject.SubjectCategory_sub_cat_id AND
RefSubject.sub_id=SubjectCategory_RefSubject.sub_cat_subjects_sub_id AND
RefSubject.sub_id='".$_SESSION['_____SUB_____ID']."';";

mysqli_set_charset( $conn, 'utf8');
    $resultx = mysqli_query($conn, $sqlx) or die("Error in Selecting " . mysqli_error($conn));

    //create an array
    $emparrayx = null;
    while($rowx =mysqli_fetch_assoc($resultx))
    {
		
        $emparrayx = $rowx;
		
    }

    $response[] = array('marked' => $emparray, 'total' => $emparrayx);

	echo json_encode($response);
    mysqli_close($conn);
}else {
	echo "Unauthorize Access";	
}
?>
