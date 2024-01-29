<?php
ob_start();
include 'dbutils.php';

$username="";
$childusername="";
$password="";

if(!isset($_POST['private_login_submit'])){
    header('location:index.php');
}
if(!isset($_POST['ins_login_user']) && isset($_POST['ins_login_pass']) ){

    header('location:../private-login.html?status=BAD');
}
$username=$_POST['loginUsername'];
$childusername=$_POST['childUsername'];
$password=$_POST['loginPassword'];
$conn = OpenCon();
 
$sql = "SELECT * FROM Student where student_b_form='".$username."' AND student_login_special='".$password."' AND student_name='".$childusername."';";

if ($result = $conn -> query($sql)) {
		$row = $result -> fetch_row();
		if(empty($row[0])){ //send error
          
            header('location:../private-login.html?status=BAD');

		}
		else{
			$key= generateRandomString();
            updateStdKey($row[0],$key,$conn);
		    session_start();
			$red=-1;
			$sqlr = "SELECT * FROM StudentRegistration where student_student_id='".$row[0]."';";
        		if ($results = $conn -> query($sqlr)) {
						$rows = $results -> fetch_row();
						if(empty($rows[0])){ 
							$red=1;
						}else{
							$red=0;
							$_SESSION['std_rollno'] = $rows[0];
							$_SESSION['center']=$rows[2];
							$_SESSION['subcat']=$rows[4];

						}
				}
				
				$_SESSION['session_token'] = $key;
				$_SESSION['std_code'] = $row[0];
				$_SESSION['std_cnic'] = $row[4];
				$_SESSION['std_name'] = $row[10];
				$_SESSION['std_contact'] = $row[5];
				$_SESSION['std_address'] = $row[3];


            CloseCon($conn);
			setLog("STUDENT - [".$_SESSION['std_code']."] Logged IN - IP ADDRESS- ".get_client_ip(),$_SESSION['std_code']);
			if($red==1){
				header('location:../private-registration.php');
				exit();
			}else if ($red==0){
				header('location:../edit-private-student.php');
				exit();
			}
           
         
        }	
}else{
	header('location:../private-login.html?status=BAD');
	exit();
	}

    


?>