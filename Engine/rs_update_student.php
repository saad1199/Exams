<?php
ob_start();
session_start();

if(!isset($_GET['sid'])){
    header('location:../index.php');
    exit();

}
if(isset($_POST['edit-ins-submit'])){

include 'dbutils.php';
$conn = OpenCon();

//$lock=getInstituteLockStatus($_SESSION['inst_code'],$conn);

$lock = getStudentLockStatus($_GET['sid'], $conn);

 if($lock=='1'){

     makeStrictLog($_SESSION['inst_code'],"Edit Student","Student Edit","Not Updated due to LOCK","N/A",$conn);
     header('location:../edit-ins-student.php?status=LOCK&sid='.$_GET['sid']);
     exit();
 }

 if($lock=='-1'){
     $sid=$_GET['sid'];
     $type=getStudentFeeType($sid,$conn);//check if late student if yes proceed otherwise send lock
     if($type!="Late"){
         header('location:../edit-ins-student.php?status=LOCK&sid='.$_GET['sid']);
         exit();
     }
 }
$name=$_POST['name'];
$fname=$_POST['fname'];
$cnic=$_POST['cnic'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];
$religion=$_POST['religion'];
$contact=$_POST['contact'];
$address=$_POST['address'];
$email=$_POST['email'];
// $stype=$_POST['student-type'];

$subcat=getStudentSubCat($_GET['sid'],$conn);

$dobIsValid=isValidDOB($dob,$subcat);
if(!$dobIsValid){
    header('location:../edit-ins-student.php?status=DOB&sid='.$_GET['sid']);
    exit();
}


$student_cnic=getStudentCNIC($_GET['sid'],$conn);
$student_name=getStudentName($_GET['sid'],$conn);

if(($student_name!=$_POST['name']) || ($student_cnic!=$_POST['cnic'] )){
   
    $exists = stdExists($cnic,$name,$conn);
    if($exists){
        makeStrictLog($_SESSION['inst_code'],"Edit Student","Student CNIC Update","ALREADY EXISTS",$cnic,$conn);
        header('location:../edit-ins-student.php?status=ALREADY_EXISTS&sid='.$_GET['sid']);
        exit();
    }

        $sql = "UPDATE `Student` SET 
        student_address='".$address."',
        student_b_form='".$cnic."',
        student_contact_number='".$contact."',
        student_email='".$email."',
        student_date_of_birth='".$dob."',
        student_father_name='".$fname."',
        student_name='".$name."',
        student_gender_gender_id='".$gender."',
        student_religion_religion_id='".$religion."' WHERE student_id='".$_GET['sid']."';";
        
        mysqli_query($conn,$sql);

       makeStrictLog($_SESSION['inst_code'],"Edit Student","Student Edit","Updated",$cnic,$conn);

}else{// Name or CNIC Not Changed

if (!empty($_FILES['file-input']['name'])) {

    $id1 = uniqid();
    $newnum = uniqid().$id1;

//__________________________IMAGE UPLOAD_____________________________

$ppname="";

$fileinfo = @getimagesize($_FILES["file-input"]["tmp_name"]);
$width = $fileinfo[0];
$height = $fileinfo[1];

$allowed_image_extension = array(
    "jpg",
    "JPG",
    "JPEG",
    "PNG",
    "png",
    "jpeg"
);

$isUploaded = false;

$file_extension = pathinfo($_FILES["file-input"]["name"], PATHINFO_EXTENSION);
if (!file_exists($_FILES["file-input"]["tmp_name"])) {
    header('location:../edit-ins-student.php?status=BAD_IMAGE');
    exit();
} else if (!in_array($file_extension, $allowed_image_extension)) {
    header('location:../edit-ins-student.php?status=BAD_IMAGE_EXTENSION');
    exit();
} else if ($_FILES["file-input"]["size"] > 5000000) {
    header('location:../edit-ins-student.php?status=BAD_IMAGE_SIZE');
    exit();
} else {
  
    $maxWidth = 800;
    $maxHeight = 800;

    if (!file_exists('../uploads-new/'.$_SESSION['inst_code'])) {
        mkdir('../uploads-new/'.$_SESSION['inst_code']);
    }

    $target = "../uploads-new/" . $_SESSION['inst_code'] . "/" . $newnum . "." . $file_extension;
    $ppname = $newnum . "." . $file_extension;

    if (!file_exists('../uploads-new/' . $_SESSION['inst_id'])) {
        mkdir('../uploads-new/'.$_SESSION['inst_id']);
    }
    $sourceImage = imagecreatefromstring(file_get_contents($_FILES["file-input"]["tmp_name"]));

    $aspectRatio = $width / $height;
    if ($width > $maxWidth || $height > $maxHeight) {
        if ($width / $maxWidth > $height / $maxHeight) {
            $newWidth = $maxWidth;
            $newHeight = $maxWidth / $aspectRatio;
        } else {
            $newHeight = $maxHeight;
            $newWidth = $maxHeight * $aspectRatio;
        }
    } else {
        $newWidth = $width;
        $newHeight = $height;
    }

    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
  
    if ($file_extension === "png" || $file_extension === "PNG") {
        imagealphablending($resizedImage, false);
        imagesavealpha($resizedImage, true);
        $transparent = imagecolorallocatealpha($resizedImage, 255, 255, 255, 127);
        imagefilledrectangle($resizedImage, 0, 0, $newWidth, $newHeight, $transparent);
    }

    imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if ($file_extension === "jpg" || $file_extension === "JPG" || $file_extension === "jpeg" || $file_extension === "JPEG") {
        imagejpeg($resizedImage, $target, 90);
    } else if ($file_extension === "png" || $file_extension === "PNG") {
        imagepng($resizedImage, $target, 9); 
    }

    imagedestroy($sourceImage);
    imagedestroy($resizedImage);

    $isUploaded = true;
    makeStrictLog($_SESSION['inst_code'],"Edit Student","Student Edit Picture","Updated",$cnic,$conn);
}

if($isUploaded==false){
    makeStrictLog($_SESSION['inst_code'],"Edit Student","Student Edit Picture","Not Updated",$cnic,$conn);
    header('location:../edit-ins-student.php?status=BAD_IMAGE&sid='.$_GET['sid']);
        exit();
}
//__________________________IMAGE UPLOAD_____________________________


$prevIMG = getStudentImage($_GET['sid'],$conn);
unlink("../uploads-new/".$_SESSION['inst_code']."/".$prevIMG);

$sql = "UPDATE `Student` SET 
student_address='".$address."',
student_contact_number='".$contact."',
student_email='".$email."',
student_date_of_birth='".$dob."',
student_father_name='".$fname."',
student_gender_gender_id='".$gender."',
student_religion_religion_id='".$religion."',student_img='".$ppname."' WHERE student_id='".$_GET['sid']."';";



}else{

    $sql = "UPDATE `Student` SET 
student_address='".$address."',
student_contact_number='".$contact."',
student_email='".$email."',
student_date_of_birth='".$dob."',
student_father_name='".$fname."',
student_gender_gender_id='".$gender."',
student_religion_religion_id='".$religion."' WHERE student_id='".$_GET['sid']."';";

}


mysqli_query($conn,$sql);
makeStrictLog($_SESSION['inst_code'],"Edit Student","Student Edit","Updated",$cnic,$conn);
}


header('location:../edit-ins-student.php?status=UPDATED&sid='.$_GET['sid']);
exit();

}else{ 
    makeStrictLog($_SESSION['inst_code'],"Edit Student","Session Expired","Not Updated",$cnic,$conn);
    header('location:../login.html?status=SESSION_EXPIRED');
    exit();

}
ob_end_flush();
?>