<?php
session_start();
if (isset($_POST['gen-challan-submit'])) {
    include 'dbutils.php';
    $conn = OpenCon();

    $lock = getInstituteLockStatus($_SESSION['inst_code'], $conn);

       if ($lock == '-1' || $lock=='1') {
           
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
        
        if(checkLengthInt($code)==3){
            $amt=1000;
        }else{
            $pamt=getPastInstituteAmount($code,$conn); 
            
            $amt=getInstituteAmount($code,$conn);
        }
        try {
        
           $cid= getInstituteChallanId($code,$conn);
           if($cid==false){
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
                challan_difference
             ) VALUES (
                 '".$random_challan."',
                 '".$amt."',
                 '0',
                 NULL,
                 '".$code."',
                 '".$pamt."'
                 );";
         mysqli_query($conn,$sqlc);
           }else{
            //update
            $sqlc = "UPDATE `BankChallan` SET 
                challan_total_amount='".$amt."',
                challan_difference='".$pamt."',
                isPaid=0,
                challan_fee_type_fee_type_id=NULL 
                WHERE challan_id=".$cid;
                mysqli_query($conn,$sqlc);

                if($amt==$pamt){
                    setInstituteLock($code,$conn);
                }
           }
        header('location:../generate-challan.php?status=CHALLAN_OK&name='.$instName.''); exit();
        }catch(Exception $e){header('location:../index.php?status='.$e->getMessage()); exit(); }
        }else{
        echo "Unauthorized Access";
        }


    } else {
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
        
        if(checkLengthInt($code)==3){
            $amt=1000;
        }else{
            $amt=getDoubleFeeForAll($code,$conn);
        }
        
        try {
        
           $cid= getInstituteChallanId($code,$conn);
           if($cid==false){
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
                challan_identifier
             ) VALUES (
                 '".$random_challan."',
                 '".$amt."',
                 '0',
                 NULL,
                 '".$code."'
                 );";
         mysqli_query($conn,$sqlc);

           }else{
            //update
            $sqlc = "UPDATE `BankChallan` SET 
                challan_total_amount='".$amt."',
                isPaid=0,
                challan_fee_type_fee_type_id=NULL 
                WHERE challan_id=".$cid;
                mysqli_query($conn,$sqlc);
        
           }
        header('location:../generate-challan.php?status=CHALLAN_OK&name='.$instName.''); exit();
        }catch(Exception $e){header('location:../index.php?status='.$e->getMessage()); exit(); }
        }else{
        echo "Unauthorized Access";
        }
    }
} else {
    header('location:../login.html?status=SESSION_EXPIRED');
    exit();
}
