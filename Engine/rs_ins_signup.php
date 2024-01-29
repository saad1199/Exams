<?php
ob_start();
session_start();

$code = $_SESSION['inst_code'];

if($code!='11111'){
     header('location:../main.html');
exit();
}

$session_token=null;

include 'dbutils.php';
$conn = OpenCon();


if(isset($_SESSION['session_token'])){
    $session_token = $_SESSION['session_token'];
}
$grantAccess=false;
$live_key = getKey($code,$conn); //db token

if($live_key==$session_token){
    $grantAccess= true;
}


if($grantAccess){


if(isset($_GET['volcanoSubmit'])){


$instName =$_GET['instName'];
$instCode =$_GET['instCode'];
$instContact =0;
$instAddress =$_GET['instAddress'];


$length= checkLengthInt($instCode);

if($length!=5){
    header('location:../register.php?status=LENGTH_ERROR');
exit();
}

$exists = checkInstituteExists($instCode,$conn);
if($exists){
    header('location:../register.php?status=EXISTS');
    exit();
}

$sql="INSERT INTO Institute (
inst_id,
inst_address,
inst_code_sec,
inst_contact,
inst_name,
inst_num_of_std,
isRegistered,
insType_inst_type_id
) VALUES (
'".$instCode."',    
'".$instAddress."',
'".$instCode."',
'".$instContact."',
'".$instName."',
'0',
'0',
'1'
);";


$instLoginName =$instCode."@peira.gov.pk";
$instPassword=$instCode;


mysqli_query($conn,$sql);


$id = getInstituteId($conn,$instCode);
$sql = "INSERT INTO InsCredentials (
icred_login_name,
icred_login_special,
institute_inst_id
) VALUES (
'".$instLoginName."',
'".$instPassword."',
'".$id."'
);";
mysqli_query($conn,$sql);
header('location:../register.php?status=REGISTERED');
exit();
}
else{
echo '<script>alert("Unknown Error occured Report IT section Immediately");</script>';
}
}else {
    echo '<script>alert("Unknown Error occured Report IT section Immediately");</script>';
}
?>