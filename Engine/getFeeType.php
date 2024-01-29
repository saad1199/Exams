<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
$code = $_SESSION['inst_code'];
$token = $_GET['token'];

$session_token=null;

include 'dbutils.php';
$conn = OpenCon();


if(isset($_SESSION['session_token'])){
    $session_token = $_SESSION['session_token'];
}

$grantAccess=false;

if($session_token==$token){
    $grantAccess= true;		
}

if($grantAccess){
    
    $sql="SELECT * FROM `RefFeeType` WHERE isActive=1;";
    mysqli_set_charset( $conn, 'utf8');
    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
    
    //create an array
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        
        $emparray[] = $row;
        
    }
    echo json_encode($emparray);
    
    
    mysqli_close($conn);
}else {
    echo "Unauthorize Access";
}
?>

