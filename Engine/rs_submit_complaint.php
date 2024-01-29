<?php
ob_start();
session_start();
if (isset($_POST['submit-complain']) && isset($_SESSION['inst_code'])) {

    include 'dbutils.php';
    $conn = OpenCon();
$complain_desc = $_POST['complain-text'];
$complain_phone = $_POST['complain-phone'];
$complain_name = $_POST['complain-name'];
 $complain_desc =$complain_desc.' - Complainant Name : '.$complain_name.' - Institute Phone : '.$complain_phone;

$sql = "INSERT INTO `Complaints` (
complain_desc,
complain_inst_id
) VALUES (
'" . $complain_desc . "',
'" . $_SESSION['inst_code'] . "'
);";

            $isExecuted = mysqli_query($conn, $sql);

            if (!$isExecuted) {
                header('location:../complainStatus.php?status=RETRY');
                exit();
            }
            header('location:../complainStatus.php?status=OK');
            exit(); 
} else {
    header('location:../login.html?status=SESSION_EXPIRED');
    exit();
}
ob_end_flush();
?>
