<?php
session_start();

if(isset($_POST['consent-submit'])){

$challandate = $_POST['challan-deposit-date'];
$challanbank=$_POST['challan-bank-name'];
$code = $_SESSION['inst_code'];
$challanuser = $_POST['challan-input'];
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
$lock=getInstituteLockStatus($_SESSION['inst_code'],$conn);
if($lock=='1'){
	header('location:../index.php?status=SECURITY_REVOKED'); 
	exit();
}else{
	
	$challanid=getInstituteChallanId($code,$conn);
	if($challanid!=$challanuser){
		header('location:../index.php?status=INVALID_CHALLAN'); 
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
			header('location:../index.php?status=BAD_SELECT_IMAGE');
			exit();
		}   
		else if (! in_array($file_extension, $allowed_image_extension)) {
			header('location:../index.php?status=BAD_IMAGE_EXTENSION');
				exit();
		}   
		else if (($_FILES["file-input"]["size"] > 800000)) {
			header('location:../index.php?status=BAD_IMAGE_SIZE');
			exit();
		}  
		else if ($width > "3000" || $height > "3000") {
			header('location:../index.php?status=BAD_IMAGE_DIMENSIONS');
			exit();
		} else {
			$target="../uploads-challans/".$_SESSION['inst_code']."-".$challanid.".".$file_extension;
			if(file_exists($target)) 
				  unlink($target);
			
			if (move_uploaded_file($_FILES["file-input"]["tmp_name"], $target)) {
				$isUploaded=true;
			} else {
				header('location:../index.php?status=BAD_IMAGE');
				exit();
			}
		}
		if($isUploaded==false){
			header('location:../index.php?status=BAD_IMAGE');
				exit();
		}
		//__________________________IMAGE UPLOAD_____________________________
		}catch(Error $e){ 
			header('location:../index.php?status=BAD_SELECT_IMAGE');
			exit();
		}  
    $camt= getChallanCurrentAmount($challanid,$conn);
	$sql = "UPDATE BankChallan SET isPaid='1',challan_bank_name='".$challanbank."',challan_deposit_date='".$challandate."',challan_difference='".$camt."' WHERE challan_id='".$challanid."';";
	mysqli_query($conn,$sql);
	setInstituteLock($code,$conn);
	header('location:../index.php?status=CONSENT_OK'); 
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