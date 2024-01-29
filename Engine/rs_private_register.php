<?php
ob_start();
session_start();
if (isset($_POST['private-reg-submit'])) {
    include 'dbutils.php';
    $conn = OpenCon();
    //__________________________IMAGE UPLOAD_____________________________

    $id1 = uniqid();
    $newnum = uniqid() . $id1;


    $ppname = "";

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
        header('location:../registration.php?status=BAD_IMAGE');
        exit();
    } else if (!in_array($file_extension, $allowed_image_extension)) {
        header('location:../registration.php?status=BAD_IMAGE_EXTENSION');
        exit();
    } else if ($_FILES["file-input"]["size"] > 5000000) {
        header('location:../registration.php?status=BAD_IMAGE_SIZE');
        exit();
    } else {

        $maxWidth = 800;
        $maxHeight = 800;

        if (!file_exists('../uploads-new/000')) {
            mkdir('../uploads-new/000');
        }

        $target = "../uploads-new/000/" . $newnum . "." . $file_extension;
        $ppname = $newnum . "." . $file_extension;

        if (!file_exists('../uploads-new/000')) {
            mkdir('../uploads-new/000');
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
        } elseif ($file_extension === "png" || $file_extension === "PNG") {
            imagepng($resizedImage, $target, 9);
        }

        imagedestroy($sourceImage);
        imagedestroy($resizedImage);

        $isUploaded = true;
    }
    if ($isUploaded == false) {
        header('location:../registration.php?status=BAD_IMAGE_UNK');
        exit();
    }
    //__________________________IMAGE UPLOAD_____________________________

    try {
        $fname = $_POST['fname'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $religion = $_POST['religion'];
        $studenttype = '2';
        $feetype = $_POST['fee-type'];
        $subcat = $_POST['subcat'];
        $center = $_POST['centers'];
        $email = $_POST['email'];

        $dobIsValid = isValidDOB($dob, $subcat);
        if (!$dobIsValid) {
            header('location:../private-registration.php?status=DOB');
            exit();
        }

        $random_challan = time();

        while (isChallanExists($random_challan, $conn)) {
            $random_challan = time();
        }

        $sqlc = "INSERT INTO `BankChallan` (
       challan_id,
       challan_total_amount,
       isPaid, 
       challan_fee_type_fee_type_id
    ) VALUES (
        '" . $random_challan . "',
        '0',
        '0',
        '" . $feetype . "'
        );";

        mysqli_query($conn, $sqlc);
        $sql = "UPDATE `Student` SET student_email='" . $email . "', student_date_of_birth='" . $dob . "', student_father_name='" . $fname . "', student_gender_gender_id='" . $gender . "',student_religion_religion_id='" . $religion . "',student_img='" . $ppname . "' WHERE student_id = '" . $_SESSION['std_code'] . "';";

        mysqli_query($conn, $sql);

        $id = $_SESSION['std_code'];
        //$random = time();

        //$stds = getCenterStudents($center,$conn);
        $cls = getClass($subcat, $conn);
        //$centerRoll=$stds+100;
        //$rollno=$cls."".$center."".$centerRoll;


        $rollno = $cls . "" . $center . "100";
        $nexRoll = $rollno;


        $isav = false;

        $limit = getCenterLimit($center, $conn);
        for ($i = 0; $i < $limit; $i++) { 
            $isVacc = isRollVaccant($nexRoll, $conn);
            if ($isVacc) {
                $isav = true;
                break;
            }
            $nexRoll++;
        }


        if ($isav == false) {
            $sqld = 'DELETE FROM Student WHERE student_id=' . $id;
            mysqli_query($conn, $sqld);
            header('location:../registration.php?status=NA');
            exit();
        }

        updateCenter($center, $conn);

        $sqlr = "INSERT INTO `StudentRegistration` (
        reg_roll_no,
        reg_student_subjectCat_sub_cat_id,
        reg_allocated_center_inst_id,
        reg_challan_detail_challan_id,
        reg_student_type_std_type_id,
        student_student_id,
        fee_type_id
        ) VALUES (
            '" . $nexRoll . "',
            '" . $subcat . "',
           '" . $center . "',
            '" . $random_challan . "',
            '" . $studenttype . "',
            '" . $id . "',
            '".$feetype."'
            );";
        mysqli_query($conn, $sqlr);
        $_SESSION['std_rollno'] = $rollno;

        header('location:../private-registration.php?status=REGISTERED');
    } catch (Exception $e) {
        header('location:../private-registration.php?status=BAD');
    }
} else {
    header('location:../login.html?status=SESSION_EXPIRED');
}
ob_end_flush();
?>