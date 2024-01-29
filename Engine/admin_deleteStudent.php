<?php
session_start();

$code = $_SESSION['inst_code'];
$role = $_SESSION['role'];
$token = $_GET['token'];
$sid = $_GET['sid'];
$did = $_GET['did'];
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
    
    if(isset($_POST['del_approve_submit'])){
        $sqlr = "DELETE FROM StudentRegistration WHERE StudentRegistration.student_student_id='".$sid."';";
        mysqli_query($conn, $sqlr);
    
        $sql = "DELETE FROM Student where Student.student_id='".$sid."';";
        mysqli_query($conn, $sql);
          
        $sqlu = "UPDATE DeleteRequests SET isDeleted=1,del_reason='".$reason."' where del_req_id='".$did."';";
        mysqli_query($conn, $sqlu);

        mysqli_close($conn);
        header('location:../pages/dashboard.php?status=OK');
        exit();


    }else if (isset($_POST['del_reject_submit'])){
        $sqlu = "UPDATE DeleteRequests SET isDeleted=2,del_reason='".$reason."' where del_req_id='".$did."';";
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