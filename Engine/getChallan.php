<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

$code = "";
include 'dbutils.php';
$conn = OpenCon();

$sql = "";
if (isset($_SESSION['inst_code'])) {

    $code = getInstituteChallanId($_SESSION['inst_code'], $conn);
    $sql = "SELECT * FROM BankChallan where challan_id = '" . $code . "';";
    makeStrictLog($_SESSION['inst_code'],"GENERATE CHALLAN","INST CHALLAN GENERATION","Generated",$code,$conn);
}

if (isset($_SESSION['std_code'])) {
  
    $code = getStudentChallanId($_SESSION['std_code'], $conn);
    $status = getStudentLockStatus($_SESSION['std_code'], $conn);

	if ($status!=1) {
		updateStudentChallan($code, $conn);
	} 
            $sql = "SELECT * FROM RefFeeType,BankChallan where RefFeeType.fee_type_id=BankChallan.challan_fee_type_fee_type_id AND challan_id = '" . $code . "';";
            makeStrictLog($_SESSION['std_code'],"GENERATE CHALLAN","STUDENT CHALLAN GENERATION","Generated",$code,$conn);
        }

mysqli_set_charset($conn, 'utf8');
$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));

$emparray = array();
while ($row = mysqli_fetch_assoc($result)) {
    $emparray[] = $row;
}

echo json_encode($emparray);
mysqli_close($conn);

?>