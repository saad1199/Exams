<?php
ob_start();
session_start();

$code = $_SESSION['inst_code'];
$sid = $_POST['stdId'];
$reason=$_POST['stdReason'];
$session_token=null;

include 'dbutils.php';
$conn = OpenCon();


if(isset($_SESSION['session_token'])){
    $session_token = $_SESSION['session_token'];
 
}
$grantAccess=false;
$live_key = getKey($code,$conn); 

if($live_key==$session_token){
    $grantAccess= true;
}

if($grantAccess){

    $lock=getInstituteLockStatus($_SESSION['inst_code'],$conn);
    if($lock=='1'){
        makeStrictLog($_SESSION['inst_code'],"DELETE","DELETE STUDENT","LOCKED",$sid,$conn);
        header('location:../search.php?status=LOCK&sid='.$_GET['sid']);
        exit();
    }
    if($lock=='-1'){
        $type=getStudentFeeType($sid,$conn);//check if late student if yes proceed otherwise send lock
        if($type!="Late"){
            header('location:../search.php?status=LOCK&sid='.$sid);
        exit();
        }
    }

$checkExistance=checkStudentExistanceInInstitute($sid,$code,$conn);
$student_cnic=getStudentCNIC($sid,$conn);

if($checkExistance){
    $checkIfAlready = checkIfAlreadySentRequest($sid,$conn);
    if($checkIfAlready){
        header('location:../search.php?status=ALREADY');
        exit();
    }else{
        $sql = "INSERT INTO DeleteRequests (del_req_std,del_reason_user,del_inst_id) VALUES ('".$sid."','".$reason."','".$code."');";
            if(mysqli_query($conn,$sql)){
               
                makeStrictLog($_SESSION['inst_code'],"DELETE","DELETE STUDENT","Submitted Request",$student_cnic,$conn);
                
                header('location:../search.php?status=OK');
                exit();
            }else {
                makeStrictLog($_SESSION['inst_code'],"DELETE","DELETE STUDENT","ERROR Submitting Request",$student_cnic,$conn);
                header('location:../search.php?status=ERROR');
                exit();
            //ERROR
            
            }
    }

}else{
    makeStrictLog($_SESSION['inst_code'],"DELETE","DELETE STUDENT","SECURITY ERROR",$student_cnic,$conn);
    header('location:../search.php?status=SECURITY_ERROR');
    exit();
}

header('location:../search.php?status=OK');
exit();
}
else{
    header('location:../search.php?status=ERROR');
    exit();
}
ob_end_flush();
?>
