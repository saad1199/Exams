<?php
session_start();

if(!isset($_GET['sid'])){
    header('location:../index.php');
    exit();

}
if(isset($_POST['edit-ins-submit'])){

include 'dbutils.php';
$conn = OpenCon();

$lock=getInstituteLockStatus($_SESSION['inst_code'],$conn);

if($lock=='1'){
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

       

}else{// Name or CNIC Not Changed

if (!empty($_FILES['file-input']['name'])) {

    $id1 = uniqid();
    $newnum = uniqid().$id1;


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
    header('location:../edit-ins-student.php?status=BAD_SELECT_IMAGE&sid='.$_GET['sid']);
    exit();
}   
else if (! in_array($file_extension, $allowed_image_extension)) {
    header('location:../edit-ins-student.php?status=BAD_IMAGE_EXTENSION&sid='.$_GET['sid']);
        exit();
}   
else if (($_FILES["file-input"]["size"] > 500000)) {
    header('location:../edit-ins-student.php?status=BAD_IMAGE_SIZE&sid='.$_GET['sid']);
    exit();
}  
else if ($width > "800" || $height > "800") {
    header('location:../edit-ins-student.php?status=BAD_IMAGE_DIMENSIONS&sid='.$_GET['sid']);
    exit();
} else {
    $target="../uploads-new/".$_SESSION['inst_code']."/".$newnum.".".$file_extension;

    if (!file_exists('../uploads-new/'.$_SESSION['inst_code'])) {
            mkdir('../uploads-new/'.$_SESSION['inst_code']);
    }

    if (move_uploaded_file($_FILES["file-input"]["tmp_name"], $target)) {
        $isUploaded=true;
    } else {
        header('location:../edit-ins-student.php?status=BAD_IMAGE&sid='.$_GET['sid']);
        exit();
    }
}
if($isUploaded==false){
    header('location:../edit-ins-student.php?status=BAD_IMAGE&sid='.$_GET['sid']);
        exit();
}
//__________________________IMAGE UPLOAD_____________________________
}
$sql = "UPDATE `Student` SET 
student_address='".$address."',
student_contact_number='".$contact."',
student_email='".$email."',
student_date_of_birth='".$dob."',
student_father_name='".$fname."',
student_gender_gender_id='".$gender."',
student_religion_religion_id='".$religion."',student_img='".$newnum."' WHERE student_id='".$_GET['sid']."';";

mysqli_query($conn,$sql);

}


header('location:../edit-ins-student.php?status=UPDATED&sid='.$_GET['sid']);
exit();

}else{ 
    header('location:../login.html?status=SESSION_EXPIRED');
    exit();

}
?>