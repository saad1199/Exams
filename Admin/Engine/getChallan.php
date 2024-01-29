<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
$code = $_SESSION['inst_code'];
$challan_id= $_GET['code'];

$token = $_GET['token'];
$session_token=null;

include 'dbutils.php';
$conn = OpenCon();

if(isset($_SESSION['session_token'])){
    $session_token = $_SESSION['session_token'];
}
$grantAccess=false;
$live_key = getKey($code,$conn); //db token

if($live_key==$session_token&&$live_key==$token&&$session_token==$token){
    $grantAccess= true;
}
if($grantAccess){
    
    $emis = getChallanIdentifier($challan_id,$conn);
    if($emis==NULL){
        $sql = "SELECT * FROM `BankChallan`,RefFeeType WHERE RefFeeType.fee_type_id=BankChallan.challan_fee_type_fee_type_id AND  BankChallan.challan_id='".$challan_id."';";
  
    }else{
        $sql = "SELECT * FROM `BankChallan` WHERE  BankChallan.challan_id='".$challan_id."';";
  
    }
    

    mysqli_set_charset( $conn, 'utf8');
    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
    //create an array
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
       // echo $row;
    }
    echo json_encode($emparray);
    mysqli_close($conn);
}else {
    echo "Unauthorize Access";
}
?>

