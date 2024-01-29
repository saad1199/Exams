<?php
session_start();
if(!isset($_SESSION['_____AUTHENTICATED'])){
    header('location: ../main.html');
  }
header('Content-Type: application/json; charset=utf-8');

$uid = $_SESSION['_____USER_____ID'];
$localBridge="_______NEXT___HASH";
$parametricArrayIndex="ROLL____NO____IN___";
$token = $_GET['token'];
$session_token=null;
$center = $_SESSION['_____MARKINGCENTER_____ID'];
$str = $_GET['logtext'];

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
    date_default_timezone_set('Asia/Karachi');

    $fname="../logs/".$center.".txt";

    if (!file_exists($fname)) {
        mkdir($fname);
    }

    $old="";
    $t=date("h:i:sa");
    $d=date("Y-m-d");
    $fd=" [".$d." ".$t."] ".$str;


    if(file_exists($fname)){
    $old=file_get_contents($fname);
    $old=$old."\n";
    }
    
    $old=$old.$fd;
    
    file_put_contents($fname,$old);

}else {
    echo "Unauthorize Access";
}
?>

