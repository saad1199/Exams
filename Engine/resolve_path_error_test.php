<?php
session_start();
include 'dbutils.php';
$conn = OpenCon();

echo "Starting Service...";
try {

    $sql = "SELECT * FROM `Student`;";

    mysqli_set_charset($conn, 'utf8');
    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
    //create an array
    
    while ($row = mysqli_fetch_assoc($result)) {

        $name = $row['student_name'];
        $cnic = $row['student_b_form'];
        $id=$row['student_id'];
       
        $id1 = uniqid();
        $newnum = uniqid().$id1;
        $newfname="";
try{
    $instid = $row['student_institute_inst_id'];
//boolean found
    if(is_null($row['student_institute_inst_id'])){
        echo 'IN PRIVATE';
        $instid="private";
        if (!file_exists('../uploads/'.$instid)) {
            mkdir('../uploads/'.$instid);
        }
        echo 'PRIVATE'.$inst;
    }else{
        echo 'IN REGULAR';
        if (!file_exists('../uploads/'.$instid)) {
            mkdir('../uploads/'.$instid);
        }
        echo "MADE DIR";
    }   
}catch(Exception $e){
    echo "in exception";
    $instid="private";
    if (!file_exists('../uploads/'.$instid)) {
        mkdir('../uploads/'.$instid);
    }
}
  

    }//while



}catch(Exception $e){
    echo $e->getMessage();
}
