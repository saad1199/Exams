<?php
session_start();
if(!isset($_SESSION['_____AUTHENTICATED'])){
    header('location: ../main.html');
  }
header('Content-Type: application/json; charset=utf-8');
$uid = $_SESSION['_____USER_____ID'];
$subId =  $_SESSION['_____SUB_____ID'];
$sid= $_GET['stdId'];
$marks= $_GET['marks'];
$token = $_GET['token'];

$session_token=null;

include 'dbutils.php';

$conn = OpenCon();

if(isset($_SESSION['_____USER_____KEY'])){
    $session_token = $_SESSION['_____USER_____KEY'];
}

$grantAccess=false;
$live_key = getUserAPIToken($uid,$conn); //db token

if($live_key==$session_token&&$live_key==$token&&$session_token==$token&&$_SESSION['_____AUTHENTICATED']==true){
    $grantAccess= true;
}
if($grantAccess){

    $isAlreadyExists=isMarkingRecordExists($sid,$subId,$conn);

    if($isAlreadyExists){

        try{
            $sql = "UPDATE Marking SET marking_marks='".$marks."' WHERE isFinal=0 AND marking_student_id='".$sid."' AND marking_sub_id='".$subId."';";
            mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
            $str = " MARKS UPDATED-[".$sid."] [".$subId."] [".$marks."] ENTERED BY [".$uid."]";
                setMSLog($str,$_SESSION['_____MARKINGCENTER_____ID']);

        }catch(Exception $e){

            $sql = "UPDATE Marking SET marking_marks='".$marks."' WHERE isFinal=0 AND marking_student_id='".$sid."' AND marking_sub_id='".$subId."';";
            mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
            $str = " MARKS UPDATED-[".$sid."] [".$subId."] [".$marks."] ENTERED BY [".$uid."]";
                setMSLog($str,$_SESSION['_____MARKINGCENTER_____ID']);
        }
        

    echo json_encode("true");
    }else{
        try{
            $sql = "INSERT INTO Marking (marking_marks,marking_student_id,marking_sub_id,marking_entered_by) VALUES ('".$marks."','".$sid."','".$subId."','".$uid."');";
            mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
    
            $str = " MARKS INSERTED-[".$sid."] [".$subId."] [".$marks."] ENTERED BY [".$uid."]";
            setMSLog($str,$_SESSION['_____MARKINGCENTER_____ID']);

            
        }catch(Exception $e){

        
        $sql = "INSERT INTO Marking (marking_marks,marking_student_id,marking_sub_id,marking_entered_by) VALUES ('".$marks."','".$sid."','".$subId."','".$uid."');";
        mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));

        $str = " MARKS INSERTED-[".$sid."] [".$subId."] [".$marks."] ENTERED BY [".$uid."]";
        setMSLog($str,$_SESSION['_____MARKINGCENTER_____ID']);
    }

    echo json_encode("true");
    }

}else {
    echo "Unauthorize Access";
}
?>

