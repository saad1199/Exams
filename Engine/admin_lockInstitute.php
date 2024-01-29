<?php
session_start();
header('Content-Type: application/text; charset=utf-8');
$code = $_SESSION['inst_code'];
$emis=$_GET['emis'];
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
    
    $clock = getInstituteLockStatus($emis,$conn);
    if($clock==-1){
      echo "ERROR"; 
      exit();
    }
        $sql = "UPDATE Institute SET `isRegistered`= '1' WHERE `inst_id`='".$emis."';";
        
  if(mysqli_query($conn, $sql)){
    mysqli_close($conn);
    echo "OK";
  }else{
    mysqli_close($conn);
    echo "ERROR";
  }
   
}else {
    echo "Unauthorize Access";
}
?>

