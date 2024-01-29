<?php
session_start();
$code = $_SESSION['inst_code'];
$challan_number = $_GET['challan_number'];

$session_token = null;

include 'dbutils.php';
$conn = OpenCon();
if (isset($_SESSION['session_token'])) {
  $session_token = $_SESSION['session_token'];
}
$grantAccess = false;
$live_key = getKey($code, $conn); //db token
if ($live_key == $session_token) {
  $grantAccess = true; 
}
if ($grantAccess) {

  $emis = getChallanIdentifier($challan_number, $conn);
  //$chid = getChallanId($emis, $conn);
  $isExist=isChallanExists($challan_number, $conn);

  $chamm = getChallanAmountById($challan_number, $conn);

  

  if ($emis == NULL) {
    $sql = "UPDATE BankChallan SET BankChallan.isPaid='1' WHERE BankChallan.challan_id='" . $challan_number . "' AND BankChallan.isPaid='0';";

    if (mysqli_query($conn, $sql)) {
      setStudentLockByChallan($challan_number, $conn);
      header('location:../pages/challanUpdate.php?status=OK_S');
      exit();
    } else {
      mysqli_close($conn);
      echo "ERROR TYPE 2";
    }
  } else {

    if ($isExist) {
     
      $sqld = "UPDATE BankChallan SET BankChallan.isPaid=1 WHERE BankChallan.challan_id='" . $challan_number . "' AND BankChallan.isPaid=0;";

      if (mysqli_query($conn, $sqld)) {
       
       $InschallanTypeId=getChallanTypeId($challan_number,$conn);

       

        $studentQuery = "SELECT Student.student_id, BankChallan.challan_id , StudentRegistration.fee_type_id
        FROM Student
        INNER JOIN StudentRegistration ON Student.student_id = StudentRegistration.student_student_id
        INNER JOIN BankChallan ON StudentRegistration.reg_challan_detail_challan_id = BankChallan.challan_id
        INNER JOIN RefFeeType ON RefFeeType.fee_type_id = BankChallan.challan_fee_type_fee_type_id
        WHERE Student.student_institute_inst_id = '$emis' AND BankChallan.isPaid = 0";

        $studentResult = $conn->query($studentQuery);

        if ($studentResult->num_rows > 0) {
          while ($row = $studentResult->fetch_assoc()) {
            $studentId = $row['student_id'];
            $challanId = $row['challan_id'];
            $studentFeeTypeId = $row['fee_type_id'];

             if($InschallanTypeId == 1 && $studentFeeTypeId == 1) {
              
              $updateQuery = "UPDATE BankChallan SET isPaid = 1, BankChallan.challan_fee_type_fee_type_id=1 WHERE challan_id = '$challanId'";
             
            }else if($InschallanTypeId == 1 && $studentFeeTypeId == 2) {
              
              //$updateQuery = "UPDATE BankChallan SET isPaid = 1, BankChallan.challan_fee_type_fee_type_id=1 WHERE challan_id = '$challanId'";
          
            }
            else if($InschallanTypeId == 2 && $studentFeeTypeId == 1) {
              
              $updateQuery = "UPDATE BankChallan SET isPaid = 1, BankChallan.challan_fee_type_fee_type_id=2 WHERE challan_id = '$challanId'";
          
            }else if($InschallanTypeId == 2 && $studentFeeTypeId == 2) {
              
              $updateQuery = "UPDATE BankChallan SET isPaid = 1, BankChallan.challan_fee_type_fee_type_id=2 WHERE challan_id = '$challanId'";
          
            }else if($InschallanTypeId == 2 && $studentFeeTypeId == 3) {
              
              //$updateQuery = "UPDATE BankChallan SET isPaid = 1, BankChallan.challan_fee_type_fee_type_id=2 WHERE challan_id = '$challanId'";
          
            }else if($InschallanTypeId == 3 && $studentFeeTypeId == 2) {
              
              $updateQuery = "UPDATE BankChallan SET isPaid = 1, BankChallan.challan_fee_type_fee_type_id=3 WHERE challan_id = '$challanId'";
          
            }else if($InschallanTypeId == 3 && $studentFeeTypeId == 1) {
              
              $updateQuery = "UPDATE BankChallan SET isPaid = 1, BankChallan.challan_fee_type_fee_type_id=3 WHERE challan_id = '$challanId'";
          
            }else if($InschallanTypeId == 3 && $studentFeeTypeId == 3) {
              
              $updateQuery = "UPDATE BankChallan SET isPaid = 1, BankChallan.challan_fee_type_fee_type_id=3 WHERE challan_id = '$challanId'";
          
            }
            else if($InschallanTypeId == 1 && $studentFeeTypeId == 3) {
              
              //$updateQuery = "UPDATE BankChallan SET isPaid = 1, BankChallan.challan_fee_type_fee_type_id=3 WHERE challan_id = '$challanId'";
          
            }
           
            $conn->query($updateQuery);
          }
        }

        header('location:../pages/challanUpdate.php?status=OK_INSSTD_CHALLAN');
          
      } else {
        mysqli_close($conn);
        echo "ERROR TYPE 1";
      }
    }
  }

} else {
  echo "Unauthorize Access";
}
?>