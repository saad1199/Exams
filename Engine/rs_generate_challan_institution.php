<?php
session_start();

if (isset($_POST['gen-challan-submit'])) {
    include 'dbutils.php';
    $conn = OpenCon();

        $code = $_SESSION['inst_code'];
        $token = $_GET['token'];
        $session_token=null;
        
        if(isset($_SESSION['session_token'])){
            $session_token = $_SESSION['session_token'];
           
        }
        $grantAccess=false;
        $instName="";
        $live_key = getKey($code,$conn); //db token
        
        if($live_key==$session_token&&$live_key==$token){
            $grantAccess= true;
        }
        if($grantAccess){
            $instName=getInstituteName($code,$conn);
            $id="";
        














            try {
        
               
     
     
                 $activeId= getActiveFeeAmountId($conn);
                 
                 $studentQuery = "SELECT Student.student_id, BankChallan.challan_id 
                 FROM Student
                 INNER JOIN StudentRegistration ON Student.student_id = StudentRegistration.student_student_id
                 INNER JOIN BankChallan ON StudentRegistration.reg_challan_detail_challan_id = BankChallan.challan_id
                 INNER JOIN RefFeeType ON RefFeeType.fee_type_id = BankChallan.challan_fee_type_fee_type_id
                 WHERE Student.student_institute_inst_id = '$code' AND BankChallan.isPaid = 0";
         
                 $studentResult = $conn->query($studentQuery);
         
     
                 if ($studentResult->num_rows > 0) {
                   while ($row = $studentResult->fetch_assoc()) {
                     $studentId = $row['student_id'];
                     $challanId = $row['challan_id'];
                
                      $updateQuery = "UPDATE BankChallan SET challan_fee_type_fee_type_id = '".$activeId."' WHERE challan_id = '$challanId' AND isPaid=0";
                     $conn->query($updateQuery);
                   }
                 }
         
                 $shouldgenerate = true;
                 if(checkLengthInt($code)==3){
                     $amt=0;
                       if(getInstituteChallanId($code,$conn)!=null){
                        $shouldgenerate = false;
                       }
                     
                 }else{
                     $amt=getInstituteAmount($code,$conn);
                     $paidAmt = getPaidChallanAmount($code,$conn);

                         $amt-=$paidAmt;
                         if($amt<=0){
                             $amt=0;
                             $shouldgenerate = false;
                         }
                 }
     
     if($shouldgenerate){
        $random_challan =time();
        while(isChallanExists($random_challan,$conn)){
            $random_challan =time();
        }
        //add new
        $sqlc = "INSERT INTO `BankChallan` (
            challan_id,
            challan_total_amount,
            isPaid,
            challan_fee_type_fee_type_id,
            challan_identifier,
            isActive
         ) VALUES (
           '".$random_challan."',
        '".$amt."',
        '0',
        '".$activeId."',
        '".$code."',
        '1'
        );";
             mysqli_query($conn,$sqlc);
             makeStrictLog($code,"Challan Generate","Challan Generation","Generated of AMT : ".$amt."",$random_challan,$conn);
           
     }
                
                    }catch(Exception $e){
                        echo $e->getMessage();
                    }     

























        header('location:../generate-challan.php?status=CHALLAN_OK&name='.$instName.''); 
        exit();
        
        
       
        }else{
        echo "Unauthorized Access";
        }
 //   }
} else {
    header('location:../login.html?status=SESSION_EXPIRED');
    exit();
}
