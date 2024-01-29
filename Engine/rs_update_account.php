<?php
session_start();

$code = $_SESSION['inst_code'];
$session_token=null;
include 'dbutils.php';
$conn = OpenCon();

if (isset($_POST['update-profile-submit'])) {

    if(isset($_SESSION['session_token'])){
        $session_token = $_SESSION['session_token'];
    }
    $grantAccess=false;
    $live_key = getKey($code,$conn); //db token
    if($live_key==$session_token){
        $grantAccess= true;
    }
    if($grantAccess){
      
    // Your database connection code here

    // Retrieve form data
    $instEmail = $_POST['inst_email'];
    $instAddress = $_POST['inst_address'];
    $instPhone = $_POST['inst_phone'];
    $instSector = $_POST['inst_sector'];

    $isWater = '0';
    $isBuilding = '0';
    $isElectricity = '0';
    $isToilet = '0';
    $isWall = '0';



    if(isset($_POST['is-water'])){
        $isWater = '1';
    }
    if(isset($_POST['is-building'])){
        $isBuilding = '1';
    }
    
    if(isset($_POST['is-electric'])){
        $isElectricity = '1';
    }
    
    if(isset($_POST['is-toilet'])){
        $isToilet ='1';
    }
    
    if(isset($_POST['is-wall'])){
        $isWall ='1';
    }


  

    $instConstruction= $_POST['inst_construction'];
    $instCondition= $_POST['inst_condition'];
    $instOwnership= $_POST['inst_ownership'];
    $instClassrooms= $_POST['inst_classrooms'];
   

    // You should sanitize and validate the data before updating the database
    // ...

    // Update records in the Institute table
    $updateQuery = "UPDATE Institute SET inst_email='$instEmail', inst_address='$instAddress', inst_contact='$instPhone' , inst_sector='$instSector', 
   
    isWater='".$isWater."',
    isBuilding='".$isBuilding."',
    isElectricity='".$isElectricity."',
    ownership='".$instOwnership."',
    isToilet='".$isToilet."',
    isBoundaryWall='".$isWall."',
    construction='".$instConstruction."',
    building_condition='".$instCondition."',
    classrooms='".$instClassrooms."'

   

    WHERE inst_id='{$_SESSION['inst_code']}'";



    // Execute the update query
    // Your database execution code here

    // Check if the update was successful
    if ($conn->query($updateQuery)==TRUE) {
        header("Location: ../index.php?status=PROFILE_UPDATED");
        exit();
    } else {
        // Redirect to the profile update page with an error message
        header("Location: ../index.php?status=PROFILE_UPDATE_FAILED");
        exit();
    }
    
    }else {
        echo "Unauthorize Access";
    }

} else {
    // Redirect to the profile update page with an error message
    header("Location: ../index.php?status=INVALID_REQUEST");
    exit();
}

?>

