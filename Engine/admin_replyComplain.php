<?php
session_start();

$code = $_SESSION['inst_code'];
$role = $_SESSION['role'];


$token = $_GET['token'];

$cid = $_GET['cid'];

$reason=$_POST['reason'];

$session_token=null;

include 'dbutils.php';
$conn = OpenCon();

if($role!=2){
    header('location:../pages/index.html');
    exit();
}

if(isset($_SESSION['session_token'])){
    $session_token = $_SESSION['session_token'];
}

$grantAccess=false;

$live_key = getKey($code,$conn); //db token

if($live_key==$session_token&&$live_key==$token){
    $grantAccess= true;
}

if($grantAccess){
    
    if(isset($_POST['complain_submit'])){
       
        $sqlu = "UPDATE Complaints SET complain_status=1,complain_reply='".$reason."' where complain_id='".$cid."';";
        mysqli_query($conn, $sqlu);

        mysqli_close($conn);
        header('location:../pages/dashboard.php?status=OK');
        exit();


    }else{

        mysqli_close($conn);
        header('location:../pages/index.html?status=ERROR');
        exit();

    }
    
}else {
    mysqli_close($conn);
    header('location:../pages/index.html?status=ERROR');
        exit();
}
?>