<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
$code = $_SESSION['inst_code'];
$centercode=$_GET['centerCode'];
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
   
    
        $sql = "Select Institute.* from StudentRegistration,Student,Institute where Student.student_id=StudentRegistration.student_student_id AND  StudentRegistration.reg_allocated_center_inst_id='".$centercode."'  AND Institute.inst_id=Student.student_institute_inst_id GROUP BY Institute.inst_id;";
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

