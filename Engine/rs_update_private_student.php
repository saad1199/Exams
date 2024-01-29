<?php
ob_start();
session_start();

if (isset($_POST['edit-private-submit'])) {
    include 'dbutils.php';
    $conn = OpenCon();
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $cnic = $_POST['cnic'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $email = $_POST['email'];
 
    $lock = getStudentLockStatus($_SESSION['std_code'], $conn);

    if ($lock == '1') {
        makeStrictLog($_SESSION['std_code'], "Edit PRIVATE Student", "Student Edit", "LOCKED", $cnic, $conn);
        header('location:../edit-private-student.php?status=LOCK');
        exit();
    }
    $subcat = getStudentSubCat($_SESSION['std_code'], $conn);
    $dobIsValid = isValidDOB($dob, $subcat);
    if (!$dobIsValid) {
        header('location:../edit-private-student.php?status=DOB');
        exit();
    }


    if (($_SESSION['std_name'] != $_POST['name']) || ($_SESSION['std_cnic'] != $_POST['cnic'])) {


        $exists = stdExists($cnic, $name, $conn);
        if ($exists) {
            makeStrictLog($_SESSION['std_code'], "Edit PRIVATE Student", "Student CNIC Edit", "ALREADY EXISTS", $cnic, $conn);
            header('location:../edit-private-student.php?status=ALREADY_EXISTS');
            exit();
        }

        try {
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
                header('location:../edit-private-student.php?status=BAD_IMAGE');
                exit();
            } else if (!in_array($file_extension, $allowed_image_extension)) {
                header('location:../edit-private-student.php?status=BAD_IMAGE_EXTENSION');
                exit();
            } else if ($_FILES["file-input"]["size"] > 5000000) {
                header('location:../edit-private-student.php?status=BAD_IMAGE_SIZE');
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
                makeStrictLog($_SESSION['std_code'], "Edit PRIVATE Student", "Student Profile Picture Edit", "Updated", $cnic, $conn);
            }
            if ($isUploaded == false) {
                makeStrictLog($_SESSION['std_code'], "Edit PRIVATE Student", "Student Profile Picture Edit", "Not Updated", $cnic, $conn);
                header('location:../edit-private-student.php?status=BAD_IMAGE_UNK');
                exit();
            }

            //__________________________IMAGE UPLOAD_____________________________
        } catch (Error $e) {
            makeStrictLog($_SESSION['std_code'], "Edit PRIVATE Student", "Student Profile Picture Edit", "ERROR Updating", $cnic, $conn);
            header('location:../edit-private-student.php?status=BAD_SELECT_IMAGE');
            exit();
        }



        $sql = "UPDATE `Student` SET 
    student_address='" . $address . "',
    student_b_form='" . $cnic . "',
    student_contact_number='" . $contact . "',
    student_email='" . $email . "',
    student_date_of_birth='" . $dob . "',
    student_father_name='" . $fname . "',
    student_name='" . $name . "',
    student_gender_gender_id='" . $gender . "',
    student_religion_religion_id='" . $religion . "',
    student_img='" . $ppname . "' 
    WHERE student_id='" . $_SESSION['std_code'] . "';";

        mysqli_query($conn, $sql);

        $target = "../uploads/" . $_SESSION['std_cnic'] . "-" . $_SESSION['std_name'] . ".jpg";
        $target2 = "../uploads/" . $_SESSION['std_cnic'] . "-" . $_SESSION['std_name'] . ".jpeg";

        if (file_exists($target))
            unlink($target);

        if (file_exists($target2))
            unlink($target2);

        $_SESSION['std_name'] = $name;
        $_SESSION['std_cnic'] = $cnic;
    } else {

        if (!empty($_FILES['file-input']['name'])) {

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
                header('location:../edit-private-student.php?status=BAD_IMAGE');
                exit();
            } else if (!in_array($file_extension, $allowed_image_extension)) {
                header('location:../edit-private-student.php?status=BAD_IMAGE_EXTENSION');
                exit();
            } else if ($_FILES["file-input"]["size"] > 5000000) {
                header('location:../edit-private-student.php?status=BAD_IMAGE_SIZE');
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
                header('location:../edit-private-student.php?status=BAD_IMAGE_UNK');
                exit();
            }
            //__________________________IMAGE UPLOAD_____________________________
        }

        $sql = "UPDATE `Student` SET 
    student_address='" . $address . "',
    student_contact_number='" . $contact . "',
    student_email='" . $email . "',
    student_date_of_birth='" . $dob . "',
    student_father_name='" . $fname . "',
    student_gender_gender_id='" . $gender . "',
    student_religion_religion_id='" . $religion . "',
    student_img='" . $ppname . "' WHERE student_id='" . $_SESSION['std_code'] . "';";

        mysqli_query($conn, $sql);
    }
    makeStrictLog($_SESSION['std_code'],"Edit PRIVATE Student","Student Edit","SUCCESS",$cnic,$conn);
    header('location:../edit-private-student.php?status=UPDATED');
    exit();
} else {
    header('location:../login.html?status=SESSION_EXPIRED');
    exit();
}
ob_end_flush();
?>