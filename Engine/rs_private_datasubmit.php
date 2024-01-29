<?php
session_start();

if(isset($_POST['consent-submit'])){

$code = $_SESSION['std_code'];
$challanuser = $_POST['challan-input'];
$challandate = $_POST['challan-deposit-date'];
$challanbank=$_POST['challan-bank-name'];
$session_token=null;
include 'dbutils.php';
$conn = OpenCon();

if(isset($_SESSION['session_token'])){
    $session_token = $_SESSION['session_token'];
}
$grantAccess=false;
$live_key = getStudentKey($code,$conn); //db token
if($live_key==$session_token){
    $grantAccess= true;
}
if($grantAccess){
$lock=getStudentLockStatus($_SESSION['std_code'],$conn);
if($lock=='1'){
	header('location:../private-datasubmit.php?status=SECURITY_REVOKED'); 
	exit();
}else{
	
	$challanid=getStudentChallanId($code,$conn);
	if($challanid!=$challanuser){
		header('location:../private-datasubmit.php?status=INVALID_CHALLAN'); 
		exit();
	}


	try{
		//__________________________IMAGE UPLOAD_____________________________
		
		$fileinfo = @getimagesize($_FILES["file-input"]["tmp_name"]);
		$width = $fileinfo[0];
		$height = $fileinfo[1];
		$allowed_image_extension = array(
			"jpg",
			"jpeg"
		);
		
		$isUploaded=false;
		$file_extension = pathinfo($_FILES["file-input"]["name"], PATHINFO_EXTENSION);
		if (!file_exists($_FILES["file-input"]["tmp_name"])) {
			header('location:../private-datasubmit.php?status=BAD_SELECT_IMAGE&sid='.$_GET['sid']);
			exit();
		}   
		else if (! in_array($file_extension, $allowed_image_extension)) {
			header('location:../private-datasubmit.php?status=BAD_IMAGE_EXTENSION&sid='.$_GET['sid']);
				exit();
		}   
		else if (($_FILES["file-input"]["size"] > 800000)) {
			header('location:../private-datasubmit.php?status=BAD_IMAGE_SIZE&sid='.$_GET['sid']);
			exit();
		}  
		else if ($width > "3000" || $height > "3000") {
			header('location:../private-datasubmit.php?status=BAD_IMAGE_DIMENSIONS&sid='.$_GET['sid']);
			exit();
		} else {
			$target="../uploads-challans/".$_SESSION['std_code']."-".$challanid.".".$file_extension;
			if(file_exists($target)) 
				  unlink($target);
			
			if (move_uploaded_file($_FILES["file-input"]["tmp_name"], $target)) {
				$isUploaded=true;
			} else {
				header('location:../private-datasubmit.php?status=BAD_IMAGE&sid='.$_GET['sid']);
				exit();
			}
		}
		if($isUploaded==false){
			header('location:../private-datasubmit.php?status=BAD_IMAGE&sid='.$_GET['sid']);
				exit();
		}
		//__________________________IMAGE UPLOAD_____________________________
		}catch(Error $e){ 
			header('location:../private-datasubmit.php?status=BAD_SELECT_IMAGE&sid='.$_GET['sid']);
			exit();
		}  


    $camt= getChallanCurrentAmount($challanid,$conn);
	$sql = "UPDATE BankChallan SET isPaid='1',challan_bank_name='".$challanbank."',challan_deposit_date='".$challandate."',challan_amount='".$cmt."' WHERE challan_id='".$challanid."';";
	mysqli_query($conn,$sql);
	setStudentLock($code,$conn);
	header('location:../private-datasubmit.php?status=CONSENT_OK'); 
	exit();
}
}else{
	header('location:../login.html?status=SESSION_EXPIRED'); 
	exit();
}
}else{
	header('location:../login.html?status=SESSION_EXPIRED'); 
	exit();
}



?>