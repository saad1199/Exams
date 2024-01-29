<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
$code = $_SESSION['inst_code'];
$query=$_GET['query'];
$token = $_GET['token'];
$isInst = $_GET['isInst'];

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
    if($isInst=="1"){
        $sql = "SELECT * FROM `InsCredentials` WHERE `institute_inst_id`='".$query."'";
      }else if($isInst=="0"){
        $sql = "SELECT * FROM `Student` WHERE `student_b_form`='".$query."';";
      }else{

    }
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

