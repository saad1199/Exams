<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
$code = $_SESSION['inst_code'];
$token = $_GET['token'];

$session_token = null;

include 'dbutils.php';
$conn = OpenCon();


if (isset($_SESSION['session_token'])) {
    $session_token = $_SESSION['session_token'];
}
$grantAccess = false;
$live_key = getKey($code, $conn); //db token

if ($live_key == $session_token && $live_key == $token) {
    $grantAccess = true;
}


if ($grantAccess) {

    $sql = "SELECT SUM(RefFeeType.fee_type_amount) As total FROM Student,BankChallan,StudentRegistration,RefFeeType where Student.student_id= StudentRegistration.student_student_id AND StudentRegistration.reg_challan_detail_challan_id = BankChallan.challan_id AND RefFeeType.fee_type_id=BankChallan.challan_fee_type_fee_type_id AND Student.student_institute_inst_id='" . $code . "';";
    mysqli_set_charset($conn, 'utf8');
    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));

    //create an array
    $emparray = array();
    while ($row = mysqli_fetch_assoc($result)) {

        $emparray[] = $row;

    }
    echo json_encode($emparray);


    mysqli_close($conn);
} else {
    echo "Unauthorize Access";
}
?>