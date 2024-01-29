<?php 
ob_start();
 include 'dbutils.php';
 $conn = OpenCon();
 if(isset($_POST['private_submit']))
{
$stdName =$_POST['fullName'];
$cnic =$_POST['cnic'];
$contact =$_POST['contact'];
$address =$_POST['address'];
$password = $_POST['password'];

$exists = stdExists($cnic,$stdName,$conn);

if($exists){
   header('location:../private-login.html?status=EXISTS');
   exit();
}
$sql = "INSERT INTO `Student` (
    student_address,
    student_b_form,
    student_contact_number,
    student_name,
    student_login_special
    ) VALUES (
    '".$address."',
    '".$cnic."',
    '".$contact."',
    '".$stdName."',
    '".$password."'
    );";

    mysqli_query($conn,$sql);
    header('location:../private-login.html?status=REGISTERED');

 }else{
    header('location:../private-login.html?status=BAD');
 }
?>