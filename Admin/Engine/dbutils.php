<?php
ob_start();
if(!isset($_SESSION['inst_code'])){
    header('location:exams.fde.gov.pk');
}

    function generateRandomString($length = 255) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

    function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

    function OpenCon(){
 $dbhost = "localhost";
//$dbuser = "root";
//$dbpass = "";
//$db = "edb_new";
//$dbuser = "fdegov_testuser";
//$dbpass = "testuser///123";

	$dbuser = "fdegov_dba";
	$dbpass ="makvas-vivFaq-6josfu";
$db = "fdegov_examination";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 return $conn;
 }
 
    function CloseCon($conn){
 $conn -> close();
 }

    function getSubjectFromID($sub_id,$conn){
$sql="SELECT sub_detail FROM `degree_subjects` WHERE `sub_id`='".$sub_id."';";
if ($result = $conn -> query($sql)) {
		$row = $result -> fetch_row();
		if($row[0]){
			return $row[0];
		}else{
			return "";
		}		
}	
}

    function stdExists($cnic,$name,$conn){
$sql = "SELECT student_id FROM Student WHERE student_b_form='".$cnic."' AND student_name='".$name."';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  return true;
} else {
  return false;
}
}

function checkStudentExistanceInInstitute($id,$inst,$conn){
	$sql = "SELECT student_id FROM Student WHERE student_id='".$id."' AND student_institute_inst_id='".$inst."';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	  return true;
	} else {
	  return false;
	}
	}

	




	function checkIfAlreadySentRequest($id,$conn){
		$sql = "SELECT del_req_std FROM DeleteRequests WHERE del_req_std='".$id."';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	  return true;
	} else {
	  return false;
	}
	}
	





			function checkInstituteExists($code,$conn){
				$sql = "SELECT inst_name FROM Institute where inst_id='".$code."';";
				if ($result = $conn -> query($sql)) {
						$row = $result -> fetch_row();
						if($row[0]){
							return true;
						}else{
							return false;
						}		
				}	
				}	








    function isValidDOB($dob,$class){
// 	$eight= "2010-09-30";
// 	$five="2013-09-30";
// 	if($class=="20"||$class=="22"){
// 		if($dob>=$eight){
// return true;
// 		}
// 	}else if ($class=="5" || $class=="21"){
// 		if($dob>=$five){
// return true;
// 		}
// 	}
// 	return false;
return true;
}

    function setLog($str,$code){
date_default_timezone_set('Asia/Karachi');
// $fname="../logs/LOG-INST-".$code.".txt";
$fname="../logs/logins-log.txt";
$old="";
$t=date("h:i:sa");
$d=date("Y-m-d");
$fd=" [".$d." ".$t."] ".$str;
if(file_exists($fname)){
$old=file_get_contents($fname);
$old=$old."\n";
}
$old=$old.$fd;
file_put_contents($fname,$old);
}

    function getMarksPercentage($total_marks,$obtained_marks){
	try{
	return ($obtained_marks/$total_marks)*100;	
	}catch(Exception $e){
		return 0;
	} 
}

    function getKey($code,$conn){

$sql="SELECT * FROM `InsCredentials` WHERE `institute_inst_id`='".$code."';";

if ($result = $conn -> query($sql)) {
		
		$row = $result -> fetch_row();
		if($row[1]){
			return $row[1];
		}else{
			return "";
		}
			
}	
}

    function getStudentCNIC($sid,$conn){
	$sql="SELECT student_b_form FROM `Student` WHERE `student_id`='".$sid."';";
	if ($result = $conn -> query($sql)) {
			$row = $result -> fetch_row();
			if($row[0]){
				return $row[0];
			}else{
				return "";
			}		
	}	
	}


	function getCenterName($emis,$conn){
		$sql="SELECT pins_name FROM `proposedInstitute` WHERE `pins_id`='".$emis."';";
		if ($result = $conn -> query($sql)) {
				$row = $result -> fetch_row();
				if($row[0]){
					return $row[0];
				}else{
					return "";
				}		
		}	
		}

    function checkLengthInt($value){		
  $length=0;
  while($value!=0) {
   $value = intval($value/10);
   $length++;
  }
  return $length;
	}
	
	function getInstituteAmount($code,$conn){
		$sql = "SELECT SUM(RefFeeType.fee_type_amount) As total FROM Student,BankChallan,StudentRegistration,RefFeeType where Student.student_id= StudentRegistration.student_student_id AND StudentRegistration.reg_challan_detail_challan_id = BankChallan.challan_id AND RefFeeType.fee_type_id=BankChallan.challan_fee_type_fee_type_id AND Student.student_institute_inst_id='".$code."';";
		if ($result = $conn -> query($sql)) {
				$row = $result -> fetch_row();
				if($row[0]){
					return $row[0];
				}else{
					return "0";
				}		
		}	
		}

	function getStudentSubCat($sid,$conn){
			$sql = "SELECT reg_student_subjectCat_sub_cat_id FROM StudentRegistration where student_student_id='".$sid."';";
			if ($result = $conn -> query($sql)) {
					$row = $result -> fetch_row();
					if($row[0]){
						return $row[0];
					}else{
						return "0";
					}		
			}	
		}

		function getChallanId($code,$conn){
			$sql = "SELECT BankChallan.challan_id from BankChallan where BankChallan.challan_identifier='".$code."';";
	
			if ($result = $conn -> query($sql)) {
					$row = $result -> fetch_row();
					if($row[0]){
						return $row[0];
					}else{
						return NULL;
					}		
			}	
			}

			function getChallanAmount($code,$conn){
				$sql = "SELECT BankChallan.challan_total_amount from BankChallan where BankChallan.challan_identifier='".$code."';";
		
				if ($result = $conn -> query($sql)) {
						$row = $result -> fetch_row();
						if($row[0]){
							return $row[0];
						}else{
							return NULL;
						}		
				}	
				}
				function getChallanTypeId($id, $conn)
				{
					$sql = "SELECT challan_fee_type_fee_type_id  FROM BankChallan WHERE challan_id='" . $id . "';";
					if ($result = $conn->query($sql)) {
						$row = $result->fetch_row();
						if ($row[0]) {
							return $row[0];
						} else {
							return "";
						}
					}
				}
				function getChallanAmountById($code,$conn){
					$sql = "SELECT BankChallan.challan_total_amount from BankChallan where BankChallan.challan_id='".$code."';";
			
					if ($result = $conn -> query($sql)) {
							$row = $result -> fetch_row();
							if($row[0]){
								return $row[0];
							}else{
								return NULL;
							}		
					}	
					}
	
				function getChallanIdentifier($code,$conn){
					$sql = "SELECT BankChallan.challan_identifier from BankChallan where BankChallan.challan_id='".$code."';";
					if ($result = $conn -> query($sql)) {
							$row = $result -> fetch_row();
							if($row[0]){
								return $row[0];
							}else{
								return NULL;
							}		
					}	
					}



	function getInstituteName($code,$conn){
			$sql = "SELECT inst_name FROM Institute where inst_id='".$code."';";
			if ($result = $conn -> query($sql)) {
					$row = $result -> fetch_row();
					if($row[0]){
						return $row[0];
					}else{
						return NULL;
					}		
			}	
			}

	function getStudentChallanId($sid,$conn){

			$sql="SELECT reg_challan_detail_challan_id  FROM StudentRegistration WHERE student_student_id='".$sid."';";
			
			if ($result = $conn -> query($sql)) {
					$row = $result -> fetch_row();
					if($row[0]){
						return $row[0];
					}else{
						return false;
					}		
			}	
			}

	function getInstituteChallanId($id,$conn){
				$sql="SELECT challan_id  FROM BankChallan WHERE challan_identifier='".$id."';";
				if ($result = $conn -> query($sql)) {
						$row = $result -> fetch_row();
						if($row[0]){
							return $row[0];
						}else{
							return "";
						}		
				}	
	}



	function isChallanExists($cid,$conn){
		$sql="SELECT *  FROM BankChallan WHERE challan_id='".$cid."';";
		if ($result = $conn -> query($sql)) {
				$row = $result -> fetch_row();
				if($row[0]){
					return true;
				}else{
					return false;
				}		
		}	
}



function isRollVaccant($roll,$conn){
	$sql="SELECT *  FROM StudentRegistration WHERE reg_roll_no='".$roll."';";
	if ($result = $conn -> query($sql)) {
			$row = $result -> fetch_row();
			if($row[0]){
				return false;
			}else{
				return true;
			}		
	}	
}




	function getStudentName($sid,$conn){

		$sql="SELECT student_name FROM `Student` WHERE `student_id`='".$sid."';";
		
		if ($result = $conn -> query($sql)) {
				
				$row = $result -> fetch_row();
				if($row[0]){
					return $row[0];
				}else{
					return "";
				}		
		}	
		}

    function getCenterStudents($code,$conn){

	$sql="SELECT * FROM `proposedInstitute` WHERE `pins_id`='".$code."';";
	
	if ($result = $conn -> query($sql)) {
			
			$row = $result -> fetch_row();
			if($row[0]){
				return $row[2];
			}else{
				return "";
			}				
	}	
}


function checkCenterCount($cid,$subcat,$conn){

	$class=getClass($subcat,$conn);
	$sql="SELECT COUNT(*) FROM StudentRegistration,SubjectCategory where SubjectCategory.sub_cat_id=StudentRegistration.reg_student_subjectCat_sub_cat_id AND SubjectCategory.class='".$class."' AND StudentRegistration.reg_allocated_center_inst_id='".$cid."'";
	if ($result = $conn -> query($sql)) {
		$row = $result -> fetch_row();
		if($row[0]<300){
			return true;
		}
		return false;			
}	
}




	
	function getClass($catid,$conn){

		$sql="SELECT * FROM `SubjectCategory` WHERE `sub_cat_id`='".$catid."';";
		
		if ($result = $conn -> query($sql)) {
				
				$row = $result -> fetch_row();
				if($row[0]){
					return $row[1];
				}else{
					return "";
				}
					
		}	
		}
	
    function updateCenter($code,$conn){
	$sql="UPDATE `proposedInstitute` SET pins_reg_std=pins_reg_std+1 WHERE `pins_id`='".$code."';";
	mysqli_query($conn,$sql);
	}

	function updateCenterMinus($code,$conn){
		$sql="UPDATE `proposedInstitute` SET pins_reg_std=pins_reg_std-1 WHERE `pins_id`='".$code."';";
		mysqli_query($conn,$sql);
		}
	
    function getInstKey($emis,$conn){
$emis=$_SESSION['emis'];
$sql="SELECT * FROM `InstituteCredentials` WHERE `inst_cred_emis`='".$emis."';";


if ($result = $conn -> query($sql)) {
		$row = $result -> fetch_row();
		if($row[0]){
			return $row[3];
		}else{
			return "";
		}	
}	
}

    function getStudentKey($sid,$conn){
	$sql="SELECT * FROM `Student` WHERE `student_id`='".$sid."';";
	if ($result = $conn -> query($sql)) {
			$row = $result -> fetch_row();
			if($row[0]){
				return $row[1];
			}else{
				return "";
			}
	}	
	}

    function getInstName($emis,$conn){
$sql="SELECT inst_name FROM `institution` WHERE `emis_id`='".$emis."';";

if ($result = $conn -> query($sql)) {
		
		$row = $result -> fetch_row();
		if($row[0]){
			return $row[0];
		}else{
			return "";
		}
			
}	
}

    function updateLastUpdated ($cnic,$conn){
	date_default_timezone_set('Asia/Karachi');
$date=date('Y-m-d H:i:s');
$sql="UPDATE `credentials` SET `last_updated`='".$date."' WHERE `username`='".$cnic."';";
	mysqli_query($conn,$sql);
	
}

function getStudentId($conn,$name,$cnic){
$sql = "SELECT student_id FROM Student WHERE student_b_form='".$cnic."' AND student_name='".$name."';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    return $row['student_id'];  }
} else {
  echo "No Result";
}
}

    function changeInstitutePass($conn,$emis,$old,$new){
	$sql = "SELECT icred_login_special FROM InsCredentials WHERE institute_inst_id='".$emis."';";
	$result = $conn->query($sql);
	$current="";
	if ($result->num_rows > 0) {
	  while($row = $result->fetch_assoc()) {
		$current=$row['icred_login_special'];  
	}
if($old==$current){
	$sql = "UPDATE InsCredentials SET `icred_login_special`= '".$new."' WHERE institute_inst_id='".$emis."';";
	mysqli_query($conn,$sql);	
	return true;
}
	} else {
	  return false;
	}
	
	}

	function changeStudentPass($conn,$code,$old,$new){
		$sql = "SELECT student_login_special FROM Student WHERE student_id='".$code."';";
		$result = $conn->query($sql);
		$current="";
		if ($result->num_rows > 0) {
		  while($row = $result->fetch_assoc()) {
			$current=$row['icred_login_special'];  
		}
	if($old==$current){
		$sql = "UPDATE Student SET `student_login_special`= '".$new."' WHERE student_id='".$code."';";
		mysqli_query($conn,$sql);	
		return true;
	}
		} else {
		  return false;
		}
		
		}

    function getInstituteId($conn,$seccode){
	$sql = "SELECT inst_id FROM Institute WHERE inst_code_sec='".$seccode."';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
		return $row['inst_id'];  }
	} else {
	  echo "No Result";
	}
	
	}

	function getInstituteLockStatus($seccode,$conn){
		$sql = "SELECT isRegistered FROM Institute WHERE inst_id='".$seccode."';";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
			return $row['isRegistered'];  
		  }
		} else {
		  echo "No Result";
		}
		}

	function setStudentLock ($code,$conn){
			$sql = "UPDATE StudentRegistration SET `isSubmit`= '1' WHERE `student_student_id`='".$code."';";
				mysqli_query($conn,$sql);	
	}
	function setStudentLockByChallan($challan,$conn){
		$sql = "UPDATE StudentRegistration SET `isSubmit`= '1' WHERE `reg_challan_detail_challan_id`='".$challan."';";
			mysqli_query($conn,$sql);	
}
	function getStudentLockStatus($stdcode,$conn){
		$sql = "SELECT isSubmit FROM StudentRegistration WHERE student_student_id='".$stdcode."';";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
			return $row['isSubmit'];  
		  }
		} else {
		  echo "No Result";
		}
		}



	function setInstituteLock ($code,$conn){
		$sql = "UPDATE Institute SET `isRegistered`= '1' WHERE `inst_id`='".$code."';";
			mysqli_query($conn,$sql);	
}

function setInstituteUnlock ($code,$conn){
	$sql = "UPDATE Institute SET `isRegistered`= '-1' WHERE `inst_id`='".$code."';";
		mysqli_query($conn,$sql);	
}

function setInstituteUnlockSuper ($code,$conn){
$sql = "UPDATE Institute SET `isRegistered`= '0' WHERE `inst_id`='".$code."';";
	mysqli_query($conn,$sql);	
}





		
    function updateInstKey ($code,$key,$conn){
	date_default_timezone_set('Asia/Karachi');
$date=date('Y-m-d H:i:s');
$sql = "UPDATE InsCredentials SET `api_token`= '".$key."',`last_login`='".$date."' WHERE `institute_inst_id`='".$code."';";
	mysqli_query($conn,$sql);	
}

    function updateStdKey ($sid,$key,$conn){
	date_default_timezone_set('Asia/Karachi');
	$date=date('Y-m-d H:i:s');
	$sql = "UPDATE Student SET `api_token`= '".$key."',`last_login`='".$date."' WHERE `student_id`='".$sid."';";
		mysqli_query($conn,$sql);	
	}

    function updateKey ($cnic,$key,$conn){
	date_default_timezone_set('Asia/Karachi');
$date=date('Y-m-d H:i:s');
$sql="UPDATE `credentials` SET `api_token`='".$key."',`last_login`='".$date."' WHERE `username`='".$cnic."';";
	mysqli_query($conn,$sql);
	
}

function getStudentCenterId($sid,$conn){
	$sql = "SELECT reg_allocated_center_inst_id FROM Student,StudentRegistration WHERE Student.student_id=StudentRegistration.student_student_id AND Student.student_id='".$sid."';";
$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
		return $row['reg_allocated_center_inst_id'];  }
	} else {
	  echo "No Result";
	}
}

function getStudentClass($sid,$conn){
	$sql = "SELECT class FROM Student,StudentRegistration,SubjectCategory WHERE SubjectCategory.sub_cat_id=StudentRegistration.reg_student_subjectCat_sub_cat_id AND Student.student_id=StudentRegistration.student_student_id AND Student.student_id='".$sid."';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    return $row['class'];  }
} else {
  echo "No Result";
}
}

function getCenterLimit($code,$conn){

	$sql="SELECT pins_max_std FROM `proposedInstitute` WHERE `pins_id`='".$code."';";
	
	if ($result = $conn -> query($sql)) {
			
			$row = $result -> fetch_row();
			if($row[0]){
				return $row[0];
			}else{
				return null;
			}				
	}	
}



function getStudentImage($sid,$conn){
	$sql="SELECT student_img FROM `Student` WHERE `student_id`='".$sid."';";
	if ($result = $conn -> query($sql)) {
			$row = $result -> fetch_row();
			if($row[0]){
				return $row[0];
			}else{
				return "";
			}		
	}	
	}


	function getStudentInstitute($sid,$conn){
		$sql="SELECT student_institute_inst_id FROM `Student` WHERE `student_id`='".$sid."';";
		if ($result = $conn -> query($sql)) {
				$row = $result -> fetch_row();
				if($row[0]){
					if($row[0]==null){
						return "000";
					}else{
						return $row[0];
					}
					
				}else{
					return "";
				}		
		}	
		}
	


?>