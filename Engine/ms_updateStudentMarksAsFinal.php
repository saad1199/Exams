<?php
session_start();
if(!isset($_SESSION['_____AUTHENTICATED'])){
    header('location: ../main.html');
  }
header('Content-Type: application/json; charset=utf-8');
$uid = $_SESSION['_____USER_____ID'];
$subId =  $_SESSION['_____SUB_____ID'];

$sroll= $_GET['toSearchRollStart'];
$eroll= $_GET['toSearchRollEnd'];

if($sroll =="" || $eroll==""){
    echo json_encode("false");
    exit();
}

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
     
    try{
        $str = " MARKS MARKED AS FINAL- START [".$sroll."] END [".$eroll."] SUBJECT [".$subId."] ENTERED BY [".$uid."]";
        setMSLog($str,$_SESSION['_____MARKINGCENTER_____ID']);
        $sql = "UPDATE Marking SET isFinal='1' WHERE marking_student_id BETWEEN '".$sroll."' AND '".$eroll."';";
    mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));


    }catch(Exception $e){

        $str = " MARKS MARKED AS FINAL- START [".$sroll."] END [".$eroll."] SUBJECT [".$subId."] ENTERED BY [".$uid."]";
        setMSLog($str,$_SESSION['_____MARKINGCENTER_____ID']);
        $sql = "UPDATE Marking SET isFinal='1' WHERE marking_student_id BETWEEN '".$sroll."' AND '".$eroll."';";
    mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));

    }
        
    echo json_encode("true");
    

}else {
    echo "Unauthorize Access";
}
?>

