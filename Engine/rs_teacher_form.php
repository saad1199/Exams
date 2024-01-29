<?php
session_start();

$code = $_SESSION['inst_code'];
$session_token=null;

include 'dbutils.php';
$conn = OpenCon();

if(isset($_SESSION['session_token'])){
    $session_token = $_SESSION['session_token'];
}

$grantAccess=false;
$live_key = getKey($code,$conn); //db token

if($live_key==$session_token){
    
  
        
    if(getInstituteType($conn,$code)=="FDE"){
                     $grantAccess = true;
              }
            
            

}
if($grantAccess){ 

    $teacher_name = $_POST['name'];
    $teacher_designation = $_POST['desg'];
    $cnic = $_POST['cnic'];
    $vendor_no = $_POST['vendor'];
    $agpr_personal_no = $_POST['agpr'];
    $iban_no = $_POST['iban'];
    $bank_name = $_POST['bankname'];
    $bank_branch_code = $_POST['branchcode'];
    $teacher_status = $_POST['teacher_status'];
    $ddo_code = $_POST['ddocode'];
    $teacher_subject = $_POST['teacher_subject'];
    $contact_no = $_POST['teachercontact'];

    // Insert data into the table
    $sql = "INSERT INTO teacherData 
            (teacher_name, teacher_designation, cnic, vendor_no, agpr_personal_no, iban_no, bank_name, bank_branch_code, teacher_status, ddo_code, teacher_subject, contact_no,teacher_inst_id)
            VALUES 
            ('$teacher_name', '$teacher_designation', '$cnic', '$vendor_no', '$agpr_personal_no', '$iban_no', '$bank_name', '$bank_branch_code', '$teacher_status', '$ddo_code', '$teacher_subject', '$contact_no','$code')";

    if ($conn->query($sql) === TRUE) {
        echo "1";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}else {
    echo "Unauthorize Access";
}
?>

