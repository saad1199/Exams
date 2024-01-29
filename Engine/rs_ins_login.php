<?php
ob_start();
include 'dbutils.php';
$username="";
$password="";

$conn = OpenCon();

if(!isset($_POST['ins_login_submit'])){

    header('location:../login.php');
}

if(!isset($_POST['ins_login_user']) && isset($_POST['ins_login_pass']) ){
    header('location:../login.html');
}

$username=$_POST['loginUsername'];
$password=$_POST['loginPassword'];


$conn = OpenCon();


 
$sql = "SELECT * FROM InsCredentials where icred_login_name='".$username."' AND icred_login_special='".$password."' AND institute_inst_id !=0;";

if ($result = $conn -> query($sql)) {
		$row = $result -> fetch_row();
		
		if(empty($row[0]) || $row[5]=='0'){ //send error
            header('location:../login.html?status=BAD');
            exit();
		}
		else{
		    
			$key= generateRandomString();
            updateInstKey($row[5],$key,$conn);
		    session_start();
		    $_SESSION['session_token'] = $key;
			$_SESSION['inst_code'] = $row[5]; 
            $_SESSION['role']=$row[6];
		
            CloseCon($conn);
			setLog("INSTITUTE - [".$_SESSION['inst_code']."] Logged IN - IP ADDRESS- ".get_client_ip(),$_SESSION['inst_code']);
			
			
if($_SESSION['role']==2){ //ADMIN
    header('location:../Admin/pages/dashboard.php');
    exit();


}else{ //Normal

    if($_SESSION['inst_code']=='0'){
        header('location:../login.html?status=BAD');
        exit();
    }
    
    if($_SESSION['inst_code']=='9262449'){
        header('location:../Admin/pages/editStudent.php');
        exit();
    }
    
    if($_SESSION['inst_code']=='11111'){
        header('location:../register.php');
        exit();
    }
                header('location:../index.php');
                exit();
}

        }	
}else{
	header('location:../login.html');
	exit();
	}

    


?>