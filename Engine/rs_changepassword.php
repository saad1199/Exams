<?php
session_start();
header('Content-Type: application/json; charset=utf-8');


if (isset($_POST['changepassword-submit'])) {
	
	$old= $_POST['current-password'];
	$type=$_POST['type-password'];
	$retype=$_POST['retype-password'];



	$session_token = null;
	include 'dbutils.php';
	$conn = OpenCon();
	$grantAccess = false;
	$selection="";


	if(isset($_SESSION['std_code'])){
		$code = $_SESSION['std_code'];
		$live_key = getStudentKey($code, $conn); //db token
		$selection="student";
	}else if(isset($_SESSION['inst_code'])){
		$code = $_SESSION['inst_code'];
		$live_key = getKey($code, $conn); //db token
		$selection="institute";
	}else{
		//break;
	}


	
	if (isset($_SESSION['session_token'])) {
		$session_token = $_SESSION['session_token'];
	}

	
	if ($live_key == $session_token) {
		$grantAccess = true;
	}
	if ($grantAccess) {

		if($type==$retype){
			
			$status=false;
			
			if($selection=="institute"){
				$status = changeInstitutePass($conn,$_SESSION['inst_code'],$old,$type);
			}else{
				$status = changeInstitutePass($conn,$_SESSION['inst_code'],$old,$type);
			}
			
			if($status){
				header('location:../changepassword.php?status=OK'); 
				exit();
			}else{
				header('location:../changepassword.php?status=WRONG'); 
				exit();
			}
		}else{
			header('location:../changepassword.php?status=MISMATCHED'); 
			exit();
		}
	}else{
	header('location:../login.html?status=SESSION_EXPIRED'); 
	exit();
	}
} else {
	header('location:../login.html?status=SESSION_EXPIRED'); 
	exit();
}
