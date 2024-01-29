<?php
ob_start();
session_start();
if (isset($_POST['reg-std-submit']) && isset($_SESSION['inst_code'])) {

    include 'dbutils.php';
    $conn = OpenCon();

    $lock = getInstituteLockStatus($_SESSION['inst_code'], $conn);

    if ($lock == '1') {
        header('location:../registration.php?status=LOCK');
        exit();
        //setInstituteUnlock($_SESSION['inst_code'],$conn);
    }

    if ($_SESSION['inst_code'] == '0' || $_SESSION['inst_code'] == '' || $_SESSION['inst_code'] == NULL) {
        header('location:../registration.php?status=BAD');
        exit();
    }

    if (!isset($_POST['fee-type'])) {
        header('location:../registration.php?status=SEL_FEE');
        exit();
    }

    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $cnic = $_POST['cnic'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    // $studenttype=$_POST['student-type'];
    $feetype = $_POST['fee-type'];
    $subcat = $_POST['subcat'];
    $center = $_POST['centers'];
    $email = $_POST['email'];


    if ($center == null || $center == "") {
        header('location:../registration.php?status=RETRY');
        exit();
    }
    $dobIsValid = isValidDOB($dob, $subcat);
    if (!$dobIsValid) {
        header('location:../registration.php?status=DOB');
        exit();
    }

    $exists = stdExists($cnic, $name, $conn);

    $id1 = uniqid();
    $newnum = uniqid() . $id1;

    if ($exists) {
        header('location:../registration.php?status=ALREADY_EXISTS');
        exit();
    } else {

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

            if (!file_exists('../uploads-new/' . $_SESSION['inst_code'])) {
                mkdir('../uploads-new/' . $_SESSION['inst_code']);
            }

            $target = "../uploads-new/" . $_SESSION['inst_code'] . "/" . $newnum . "." . $file_extension;
            $ppname = $newnum . "." . $file_extension;

            if (!file_exists('../uploads-new/' . $_SESSION['inst_code'])) {
                mkdir('../uploads-new/' . $_SESSION['inst_codei']);
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

        try {

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


            $sql = "INSERT INTO `Student` (
student_address,
student_b_form,
student_contact_number,
student_email,
student_date_of_birth,
student_father_name,
student_name,
student_gender_gender_id,
student_institute_inst_id,
student_religion_religion_id,
student_img
) VALUES (
'" . $address . "',
'" . $cnic . "',
'" . $contact . "',
'" . $email . "',
'" . $dob . "',
'" . $fname . "',
'" . $name . "',
" . $gender . ",
" . $_SESSION['inst_code'] . ",
'" . $religion . "',
'" . $ppname . "'
);";

            $isExecuted = mysqli_query($conn, $sql);

            if (!$isExecuted) {
                header('location:../registration.php?status=RETRY');
                exit();
            }

            $id = getStudentId($conn, $name, $cnic);
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
            " . $subcat . ",
            '" . $center . "',
            " . $random_challan . ",
            1,
            " . $id . ",
            $feetype
            );";
            $isExecuted = mysqli_query($conn, $sqlr);

            if (!$isExecuted) {
                $sqld = 'DELETE FROM Student WHERE student_id=' . $id;
                mysqli_query($conn, $sqld);
                header('location:../registration.php?status=RETRY');
                exit();
            }
            header('location:../registration.php?status=REGISTERED');
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
            $sqld = 'DELETE FROM Student WHERE student_id=' . $id;
            mysqli_query($conn, $sqld);
            header('location:../registration.php?status=BAD');
            exit();
        }
    }
} else {
    header('location:../login.html?status=SESSION_EXPIRED');
    exit();
}
ob_end_flush();
?>
