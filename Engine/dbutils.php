<?php
function generateRandomString($length = 255)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}
function get_client_ip()
{
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if (getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if (getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if (getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if (getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if (getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}

function OpenCon()
{
	$dbhost = "localhost";
	//$dbuser = "root";
	//$dbpass = "";
	//$db = "edb_new";
	//$dbuser = "fdegov_testuser";
	//$dbpass = "testuser///123";
	$db = "fdegov_examination";
	
	$dbuser = "fdegov_dba";
	$dbpass ="makvas-vivFaq-6josfu";
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);
	return $conn;
}

function CloseCon($conn)
{
	$conn->close();
}

function getPaidChallanAmount($emis,$conn)
{
	$sql = "SELECT SUM(`challan_total_amount`) as total FROM `BankChallan` WHERE `isPaid`=1 AND `challan_identifier`='".$emis."';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "0";
		}
	}
}




function getActiveFeeAmountId($conn)
{
	$sql = "SELECT RefFeeType.fee_type_id FROM RefFeeType where RefFeeType.isActive=1;";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "0";
		}
	}
}


function getStudentMarks($roll, $sub_id, $conn)
{

	$sql = "SELECT marking_marks FROM `Marking` WHERE marking_student_id='" . $roll . "' AND `marking_sub_id`='" . $sub_id . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "";
		}
	}
}

function makeStrictLog($code_id,$logPage,$logAction,$logStatus,$logSpecific,$conn){
	
	$sql = "INSERT INTO StrictLogs (log_page,log_action,log_status,log_specific,log_code) VALUES
	 ('".$logPage."',
	 '".$logAction."',
	 '".$logStatus."',
	 '".$logSpecific."',
	 '".$code_id."');";
	mysqli_query($conn, $sql);
}

function getSubjectFromID($sub_id, $conn)
{
	$sql = "SELECT sub_name FROM `RefSubject` WHERE `sub_id`='" . $sub_id . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "";
		}
	}
}

function stdExists($cnic, $name, $conn)
{
	$sql = "SELECT student_id FROM Student WHERE student_b_form='" . $cnic . "' AND student_name='" . $name . "';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		return true;
	} else {
		return false;
	}
}


function checkIfFifthStudentAlreadyCompiled($roll, $conn)
{
	$sql = "SELECT res_f_student_id FROM ResultFifth WHERE res_f_student_id='" . $roll . "';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		return true;
	} else {
		return false;
	}
}

function checkIfFifthStudentAlreadyNotCompiled($roll, $conn)
{
	$sql = "SELECT fc_student_id FROM FailedCompilation WHERE fc_student_id='" . $roll . "';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		return true;
	} else {
		return false;
	}
}

function checkIfMarksFinal($roll, $conn)
{
	$sql = "SELECT isFinal FROM Marking WHERE marking_sub_id='" . $_SESSION['_____SUB_____ID'] . "' AND marking_student_id='" . $roll . "' AND isFinal=1;";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		return true;
	} else {
		return false;
	}
}


function checkIfTrueSubject($roll, $conn)
{

	$sql = "SELECT sub_cat_subjects_sub_id FROM SubjectCategory_RefSubject,RefSubject WHERE RefSubject.sub_id=SubjectCategory_RefSubject.sub_cat_subjects_sub_id AND SubjectCategory_RefSubject.SubjectCategory_sub_cat_id=(SELECT StudentRegistration.reg_student_subjectCat_sub_cat_id from StudentRegistration WHERE StudentRegistration.reg_roll_no='" . $roll . "') AND sub_cat_subjects_sub_id='" . $_SESSION['_____SUB_____ID'] . "';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		return true;
	} else {
		return false;
	}
}


function checkStudentExistanceInInstitute($id, $inst, $conn)
{
	$sql = "SELECT student_id FROM Student WHERE student_id='" . $id . "' AND student_institute_inst_id='" . $inst . "';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		return true;
	} else {
		return false;
	}
}






function checkIfAlreadySentRequest($id, $conn)
{
	$sql = "SELECT del_req_std FROM DeleteRequests WHERE del_req_std='" . $id . "' AND isDeleted=0;";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		return true;
	} else {
		return false;
	}
}


function checkInstituteExists($code, $conn)
{
	$sql = "SELECT inst_name FROM Institute where inst_id='" . $code . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return true;
		} else {
			return false;
		}
	}
}



function isValidDOB($dob, $class)
{
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

function setResultLog($str)
{
	date_default_timezone_set('Asia/Karachi');
	$fname = "../logs/compilation_x.txt";

	if (!file_exists($fname)) {
		touch($fname);
		chmod($fname, 0777);
	}
	$old = "";
	$t = date("h:i:sa");
	$d = date("Y-m-d");
	$fd = " [" . $d . " " . $t . "] " . $str;
	if (file_exists($fname)) {
		$old = file_get_contents($fname);
		$old = $old . "\n";
	}
	$old = $old . $fd;
	file_put_contents($fname, $old);
}



function setMSLog($str, $center)
{
	date_default_timezone_set('Asia/Karachi');
	$fname = "../logs/" . $center . ".txt";
	$old = "";
	$t = date("h:i:sa");
	$d = date("Y-m-d");
	$fd = " [" . $d . " " . $t . "] " . $str;
	if (file_exists($fname)) {
		$old = file_get_contents($fname);
		$old = $old . "\n";
	}
	$old = $old . $fd;
	file_put_contents($fname, $old);
}


function setLog($str, $code)
{
	date_default_timezone_set('Asia/Karachi');

	$fname = "../logs/logins-log.txt";
	$old = "";
	$t = date("h:i:sa");
	$d = date("Y-m-d");
	$fd = " [" . $d . " " . $t . "] " . $str;
	if (file_exists($fname)) {
		$old = file_get_contents($fname);
		$old = $old . "\n";
	}
	$old = $old . $fd;
	file_put_contents($fname, $old);

}

function setUserLog($str)
{

	date_default_timezone_set('Asia/Karachi');
	$fname = "../logs/user.txt";

	if (!file_exists($fname)) {
		fopen($fname, 'w') or die("Can't create file");
	}

	$old = "";
	$t = date("h:i:sa");
	$d = date("Y-m-d");
	$fd = " [" . $d . " " . $t . "] " . $str;

	if (file_exists($fname)) {
		$old = file_get_contents($fname);
		$old = $old . "\n";
	}
	$old = $old . $fd;
	file_put_contents($fname, $old);


}

function setActivityLog($str)
{
	date_default_timezone_set('Asia/Karachi');

	$fname = "../logs/activity.txt";
	if (!file_exists($fname)) {
		fopen($fname, 'w') or die("Can't create file");
	}
	$old = "";
	$t = date("h:i:sa");
	$d = date("Y-m-d");
	$fd = " [" . $d . " " . $t . "] " . $str;

	if (file_exists($fname)) {
		$old = file_get_contents($fname);
		$old = $old . "\n";
	}
	$old = $old . $fd;
	file_put_contents($fname, $old);

}

function setChangeLog($str, $code)
{
	date_default_timezone_set('Asia/Karachi');

	$fname = "../logs/center-change-log.txt";
	$old = "";
	$t = date("h:i:sa");
	$d = date("Y-m-d");
	$fd = " [" . $d . " " . $t . "] " . " [" . $code . "] " . $str;
	if (file_exists($fname)) {
		$old = file_get_contents($fname);
		$old = $old . "\n";
	}
	$old = $old . $fd;
	file_put_contents($fname, $old);

}







function getMarksPercentage($total_marks, $obtained_marks)
{
	try {
		return ($obtained_marks / $total_marks) * 100;
	} catch (Exception $e) {
		return 0;
	}
}

function getKey($code, $conn)
{
	$sql = "SELECT * FROM `InsCredentials` WHERE `institute_inst_id`='" . $code . "';";
	if ($result = $conn->query($sql)) {

		$row = $result->fetch_row();
		if ($row[1]) {
			return $row[1];
		} else {
			return "";
		}

	}
}




function getMarkingKey($code, $conn)
{
	$sql = "SELECT marking_key FROM `MarkingCenter` WHERE `markingCenter_id`='" . $code . "';";
	if ($result = $conn->query($sql)) {

		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "";
		}

	}
}

function getMarks($code, $conn)
{
	$subId = $_SESSION['_____SUB_____ID'];
	$sql = "SELECT marking_marks FROM `Marking` WHERE `marking_student_id`='" . $code . "' AND `marking_sub_id`='" . $subId . "';";
	if ($result = $conn->query($sql)) {

		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "";
		}

	}
}


function getUserAPIToken($code, $conn)
{
	$sql = "SELECT api_token FROM `User` WHERE `user_id`='" . $code . "';";
	if ($result = $conn->query($sql)) {

		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "";
		}

	}
}


function getStudentCNIC($sid, $conn)
{
	$sql = "SELECT student_b_form FROM `Student` WHERE `student_id`='" . $sid . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "";
		}
	}
}

function checkLengthInt($value)
{
	$length = 0;
	while ($value != 0) {
		$value = intval($value / 10);
		$length++;
	}
	return $length;
}


function getStudentFeeType($sid, $conn)
{
	$sql = "SELECT RefFeeType.fee_type_det FROM StudentRegistration,BankChallan,RefFeeType where RefFeeType.fee_type_id=BankChallan.challan_fee_type_fee_type_id AND StudentRegistration.reg_challan_detail_challan_id=BankChallan.challan_id AND StudentRegistration.student_student_id='" . $sid . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "0";
		}
	}
}


function getLateFeeAmount($conn)
{
	$sql = "SELECT RefFeeType.fee_type_amount FROM RefFeeType where RefFeeType.fee_type_det='Late';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "0";
		}
	}
}

function getDoubleFeeAmount($conn)
{
	$sql = "SELECT RefFeeType.fee_type_amount FROM RefFeeType where RefFeeType.fee_type_det='Double';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "0";
		}
	}
}

function getActiveFeeAmount($conn)
{
	$sql = "SELECT RefFeeType.fee_type_amount FROM RefFeeType where RefFeeType.isActive=1;";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "0";
		}
	}
}

function getActiveFeeType($conn)
{
	$sql = "SELECT RefFeeType.fee_type_id FROM RefFeeType where RefFeeType.isActive=1;";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "0";
		}
	}
}


function getLateFeeForAll($code, $conn)
{
	$sql = "SELECT * FROM Student,StudentRegistration,RefStudentType,RefReligion,RefGender,SubjectCategory WHERE Student.student_id=StudentRegistration.student_student_id AND StudentRegistration.reg_student_type_std_type_id = RefStudentType.std_type_id AND Student.student_gender_gender_id = RefGender.gender_id AND Student.student_religion_religion_id = RefReligion.religion_id AND StudentRegistration.reg_student_subjectCat_sub_cat_id=SubjectCategory.sub_cat_id AND Student.student_institute_inst_id = '" . $code . "' ORDER BY StudentRegistration.reg_roll_no;";
	mysqli_set_charset($conn, 'utf8');
	$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
	$amount = 0;
	$multiplier = getLateFeeAmount($conn);
	while ($row = mysqli_fetch_assoc($result)) {
		$amount += $multiplier;
	}
	return $amount;
}



function getDoubleFeeForAll($code, $conn)
{
	$sql = "SELECT * FROM Student,StudentRegistration,RefStudentType,RefReligion,RefGender,SubjectCategory WHERE Student.student_id=StudentRegistration.student_student_id AND StudentRegistration.reg_student_type_std_type_id = RefStudentType.std_type_id AND Student.student_gender_gender_id = RefGender.gender_id AND Student.student_religion_religion_id = RefReligion.religion_id AND StudentRegistration.reg_student_subjectCat_sub_cat_id=SubjectCategory.sub_cat_id AND Student.student_institute_inst_id = '" . $code . "' ORDER BY StudentRegistration.reg_roll_no;";
	mysqli_set_charset($conn, 'utf8');
	$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
	$amount = 0;
	$multiplier = getActiveFeeAmount($conn);
	while ($row = mysqli_fetch_assoc($result)) {
		$amount += $multiplier;
	}
	return $amount;
}


function getInstituteAmount($code, $conn)
{

	$sql = "SELECT SUM(RefFeeType.fee_type_amount) AS `total` from Student,StudentRegistration,BankChallan,RefFeeType WHERE Student.student_id=StudentRegistration.student_student_id AND StudentRegistration.reg_challan_detail_challan_id=BankChallan.challan_id AND RefFeeType.fee_type_id=BankChallan.challan_fee_type_fee_type_id AND Student.student_institute_inst_id='" . $code . "';";

	//$normal=getPastInstituteAmount($code,$conn);

	//$late=getStudentLateInstituteAmount($code,$conn);
	//$double=getStudentDoubleInstituteAmount($code,$conn);  
	//$diff = getChallanDifferenceByInstitute($code,$conn);
	//$sql = "SELECT COUNT(RefFeeType.fee_type_amount) As total FROM Student,BankChallan,StudentRegistration,RefFeeType where Student.student_id= StudentRegistration.student_student_id AND StudentRegistration.reg_challan_detail_challan_id = BankChallan.challan_id AND RefFeeType.fee_type_id=BankChallan.challan_fee_type_fee_type_id AND Student.student_institute_inst_id='".$code."';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		}
	}
	// if ($result = $conn -> query($sql)) {
	// 		$row = $result -> fetch_row();
	// 		if($row[0]){
	// 	    $sqlc = "SELECT RefFeeType.fee_type_amount from RefFeeType where RefFeeType.isActive=1;";
	// if ($resultc = $conn -> query($sqlc)) {
	// 		$rowc = $resultc -> fetch_row();
	// 		return (($rowc[0]*$row[0])-$diff);
	// }else{
	//     return 0;
	// }
	// 		}else{
	// 			return 0;
	// 		}		
	// }
	return null;
}


function updateStudentChallan($cid, $conn)
{
	
		$sqlc = "SELECT * from RefFeeType where RefFeeType.isActive=1;";
		if ($resultc = $conn->query($sqlc)) {
			$rowc = mysqli_fetch_assoc($resultc);
			$sql = "UPDATE `BankChallan` SET 
                challan_total_amount='" . $rowc['fee_type_amount'] . "',
                isPaid=0,
                challan_fee_type_fee_type_id='" . $rowc['fee_type_id'] . "' 
                WHERE challan_id=" . $cid;
			mysqli_query($conn, $sql);
			return true;
		} else {
			return false;
	}
}




function getPastInstituteAmount($code, $conn)
{
	$sql = "SELECT SUM(RefFeeType.fee_type_amount) As total FROM Student,BankChallan,StudentRegistration,RefFeeType where Student.student_id= StudentRegistration.student_student_id AND StudentRegistration.reg_challan_detail_challan_id = BankChallan.challan_id AND RefFeeType.fee_type_id=BankChallan.challan_fee_type_fee_type_id AND RefFeeType.fee_type_id=1 AND Student.student_institute_inst_id='" . $code . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "0";
		}
	}
}




function getStudentLateInstituteAmount($code, $conn)
{
	$sql = "SELECT SUM(RefFeeType.fee_type_amount) As total FROM Student,BankChallan,StudentRegistration,RefFeeType where Student.student_id= StudentRegistration.student_student_id AND StudentRegistration.reg_challan_detail_challan_id = BankChallan.challan_id AND RefFeeType.fee_type_id=BankChallan.challan_fee_type_fee_type_id AND RefFeeType.fee_type_id=2 AND Student.student_institute_inst_id='" . $code . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "0";
		}
	}
}


function getStudentDoubleInstituteAmount($code, $conn)
{
	$sql = "SELECT SUM(RefFeeType.fee_type_amount) As total FROM Student,BankChallan,StudentRegistration,RefFeeType where Student.student_id= StudentRegistration.student_student_id AND StudentRegistration.reg_challan_detail_challan_id = BankChallan.challan_id AND RefFeeType.fee_type_id=BankChallan.challan_fee_type_fee_type_id AND RefFeeType.fee_type_id=3 AND Student.student_institute_inst_id='" . $code . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "0";
		}
	}
}

function getChallanCurrentAmount($code, $conn)
{
	$sql = "SELECT challan_total_amount  FROM BankChallan WHERE challan_id='" . $code . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		return $row[0];
	} else {
		return -1;
	}
}

function getInstituteChallanNumber($conn,$emis){
	if(checkLengthInt($emis)==3){
		$sql = "SELECT BankChallan.challan_id FROM BankChallan WHERE BankChallan.challan_identifier='".$emis."' ORDER BY challan_updated_date DESC;";
	}else{
		$sql = "SELECT BankChallan.challan_id FROM BankChallan WHERE BankChallan.challan_identifier='".$emis."' AND challan_total_amount!=0 ORDER BY challan_updated_date DESC;";
	}
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "-";
		}
	}
}

function getChallanCurrentAmountByInstitute($code, $conn)
{
	$sql = "SELECT challan_total_amount  FROM BankChallan WHERE challan_identifier='" . $code . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		return $row[0];
	} else {
		return 0;
	}
}




function getChallanDifferenceByInstitute($code, $conn)
{
	$sql = "SELECT challan_difference  FROM BankChallan WHERE challan_identifier='" . $code . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		return $row[0];
	} else {
		return 0;
	}
}




function getStudentSubCat($sid, $conn)
{
	$sql = "SELECT reg_student_subjectCat_sub_cat_id FROM StudentRegistration where student_student_id='" . $sid . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "0";
		}
	}
}




function getInstituteName($code, $conn)
{
	$sql = "SELECT inst_name FROM Institute where inst_id='" . $code . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return NULL;
		}
	}
}

function getStudentChallanId($sid, $conn)
{

	$sql = "SELECT reg_challan_detail_challan_id  FROM StudentRegistration WHERE student_student_id='" . $sid . "';";

	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return false;
		}
	}
}
 


function getInstituteChallanId($id, $conn)
{
	$sql = "SELECT challan_id  FROM BankChallan WHERE challan_identifier='" . $id . "' ORDER BY challan_updated_date DESC;";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "";
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

function getChallanIsPaid($id, $conn)
{
	$sql = "SELECT isPaid  FROM BankChallan WHERE challan_id='" . $id . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "";
		}
	}
}


function isChallanExists($cid, $conn)
{
	$sql = "SELECT * FROM BankChallan WHERE challan_id='" . $cid . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return true;
		} else {
			return false;
		}
	}
}


function isMarkingRecordExists($sid, $subid, $conn)
{
	$sql = "SELECT *  FROM Marking WHERE marking_student_id='" . $sid . "' AND marking_sub_id='" . $subid . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return true;
		} else {
			return false;
		}
	}
}

function getStudentMarksBySubject($sid, $subid, $conn)
{
	$sql = "SELECT marking_marks  FROM Marking WHERE marking_student_id='" . $sid . "' AND marking_sub_id='" . $subid . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return -1;
		}
	}
}


function getClassFromCenterID($cid, $conn)
{
	$sql = "SELECT class FROM MarkingCenter WHERE markingCenter_id='" . $cid . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return -1;
		}
	}
}

function isRollVaccant($roll, $conn)
{
	$sql = "SELECT *  FROM StudentRegistration WHERE reg_roll_no='" . $roll . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return false;
		} else {
			return true;
		}
	}
}




function getStudentName($sid, $conn)
{

	$sql = "SELECT student_name FROM `Student` WHERE `student_id`='" . $sid . "';";

	if ($result = $conn->query($sql)) {

		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "";
		}
	}
}

function getCenterStudents($code, $conn)
{

	$sql = "SELECT * FROM `proposedInstitute` WHERE `pins_id`='" . $code . "';";

	if ($result = $conn->query($sql)) {

		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[2];
		} else {
			return "";
		}
	}
}


function getStudentCenterId($sid, $conn)
{
	$sql = "SELECT reg_allocated_center_inst_id FROM Student,StudentRegistration WHERE Student.student_id=StudentRegistration.student_student_id AND Student.student_id='" . $sid . "';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			return $row['reg_allocated_center_inst_id'];
		}
	} else {
		echo "No Result";
	}
}

function getStudentClass($sid, $conn)
{
	$sql = "SELECT class FROM Student,StudentRegistration,SubjectCategory WHERE SubjectCategory.sub_cat_id=StudentRegistration.reg_student_subjectCat_sub_cat_id AND Student.student_id=StudentRegistration.student_student_id AND Student.student_id='" . $sid . "';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			return $row['class'];
		}
	} else {
		echo "No Result";
	}
}

function getCenterLimit($code, $conn)
{

	$sql = "SELECT pins_max_std FROM `proposedInstitute` WHERE `pins_id`='" . $code . "';";

	if ($result = $conn->query($sql)) {

		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return null;
		}
	}
}

function checkCenterCount($cid, $subcat, $conn)
{

	$class = getClass($subcat, $conn);
	$sql = "SELECT COUNT(*) FROM StudentRegistration,SubjectCategory where SubjectCategory.sub_cat_id=StudentRegistration.reg_student_subjectCat_sub_cat_id AND SubjectCategory.class='" . $class . "' AND StudentRegistration.reg_allocated_center_inst_id='" . $cid . "'";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0] < 300) {
			return true;
		}
		return false;
	}
}





function getClass($catid, $conn)
{

	$sql = "SELECT * FROM `SubjectCategory` WHERE `sub_cat_id`='" . $catid . "';";

	if ($result = $conn->query($sql)) {

		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[1];
		} else {
			return "";
		}

	}
}

function updateCenter($code, $conn)
{
	$sql = "UPDATE `proposedInstitute` SET pins_reg_std=pins_reg_std+1 WHERE `pins_id`='" . $code . "';";
	mysqli_query($conn, $sql);
}

function updateCenterMinus($code, $conn)
{
	$sql = "UPDATE `proposedInstitute` SET pins_reg_std=pins_reg_std-1 WHERE `pins_id`='" . $code . "';";
	mysqli_query($conn, $sql);
}

function getInstKey($emis, $conn)
{
	$emis = $_SESSION['emis'];
	$sql = "SELECT * FROM `InstituteCredentials` WHERE `inst_cred_emis`='" . $emis . "';";


	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[3];
		} else {
			return "";
		}
	}
}

function getStudentKey($sid, $conn)
{
	$sql = "SELECT * FROM `Student` WHERE `student_id`='" . $sid . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[1];
		} else {
			return "";
		}
	}
}

function getInstName($emis, $conn)
{
	$sql = "SELECT inst_name FROM `institution` WHERE `emis_id`='" . $emis . "';";

	if ($result = $conn->query($sql)) {

		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "";
		}

	}
}

function updateLastUpdated($cnic, $conn)
{
	date_default_timezone_set('Asia/Karachi');
	$date = date('Y-m-d H:i:s');
	$sql = "UPDATE `credentials` SET `last_updated`='" . $date . "' WHERE `username`='" . $cnic . "';";
	mysqli_query($conn, $sql);

}

function getStudentId($conn, $name, $cnic)
{
	$sql = "SELECT student_id FROM Student WHERE student_b_form='" . $cnic . "' AND student_name='" . $name . "';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			return $row['student_id'];
		}
	} else {
		echo "No Result";
	}
}

function changeInstitutePass($conn, $emis, $old, $new)
{
	$sql = "SELECT icred_login_special FROM InsCredentials WHERE institute_inst_id='" . $emis . "';";
	$result = $conn->query($sql);
	$current = "";
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$current = $row['icred_login_special'];
		}
		if ($old == $current) {
			$sql = "UPDATE InsCredentials SET `icred_login_special`= '" . $new . "' WHERE institute_inst_id='" . $emis . "';";
			mysqli_query($conn, $sql);
			return true;
		}
	} else {
		return false;
	}

}

function changeStudentPass($conn, $code, $old, $new)
{
	$sql = "SELECT student_login_special FROM Student WHERE student_id='" . $code . "';";
	$result = $conn->query($sql);
	$current = "";
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$current = $row['icred_login_special'];
		}
		if ($old == $current) {
			$sql = "UPDATE Student SET `student_login_special`= '" . $new . "' WHERE student_id='" . $code . "';";
			mysqli_query($conn, $sql);
			return true;
		}
	} else {
		return false;
	}

}

function getInstituteId($conn, $seccode)
{
	$sql = "SELECT inst_id FROM Institute WHERE inst_code_sec='" . $seccode . "';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			return $row['inst_id'];
		}
	} else {
		echo "No Result";
	}

}

function getInstituteLockStatus($seccode, $conn)
{
	$sql = "SELECT isRegistered FROM Institute WHERE inst_id='" . $seccode . "';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			return $row['isRegistered'];
		}
	} else {
		echo "No Result";
	}
}

function setStudentLock($code, $conn)
{
	
	$sql = "UPDATE StudentRegistration SET `isSubmit`= '1' WHERE `student_student_id`='" . $code . "';";
	mysqli_query($conn, $sql);
}

function getStudentLockStatus($stdcode, $conn)
{
	$sql = "SELECT BankChallan.isPaid FROM `BankChallan`,StudentRegistration WHERE BankChallan.challan_id=StudentRegistration.reg_challan_detail_challan_id AND StudentRegistration.student_student_id='".$stdcode."';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			return $row['isPaid'];
		}
	} else {
		echo "No Result";
	}
}

function setInstituteLock($code, $conn)
{
	$sql = "UPDATE Institute SET `isRegistered`= '1' WHERE `inst_id`='" . $code . "';";
	mysqli_query($conn, $sql);
}

function setInstituteUnlock($code, $conn)
{
	$sql = "UPDATE Institute SET `isRegistered`= '-1' WHERE `inst_id`='" . $code . "';";
	mysqli_query($conn, $sql);
}

function setInstituteUnlockSuper($code, $conn)
{
	$sql = "UPDATE Institute SET `isRegistered`= '0' WHERE `inst_id`='" . $code . "';";
	mysqli_query($conn, $sql);
}



function updateInstKey($code, $key, $conn)
{
	date_default_timezone_set('Asia/Karachi');
	$date = date('Y-m-d H:i:s');
	$sql = "UPDATE InsCredentials SET `api_token`= '" . $key . "',`last_login`='" . $date . "' WHERE `institute_inst_id`='" . $code . "';";
	mysqli_query($conn, $sql);
}


function updateUserKey($code, $key, $conn)
{
	date_default_timezone_set('Asia/Karachi');
	$date = date('Y-m-d H:i:s');
	$sql = "UPDATE User SET `api_token`= '" . $key . "',`last_login`='" . $date . "' WHERE `user_id`='" . $code . "';";
	mysqli_query($conn, $sql);
}



function updateStdKey($sid, $key, $conn)
{
	date_default_timezone_set('Asia/Karachi');
	$date = date('Y-m-d H:i:s');
	$sql = "UPDATE Student SET `api_token`= '" . $key . "',`last_login`='" . $date . "' WHERE `student_id`='" . $sid . "';";
	mysqli_query($conn, $sql);
}

function updateKey($cnic, $key, $conn)
{
	date_default_timezone_set('Asia/Karachi');
	$date = date('Y-m-d H:i:s');
	$sql = "UPDATE `credentials` SET `api_token`='" . $key . "',`last_login`='" . $date . "' WHERE `username`='" . $cnic . "';";
	mysqli_query($conn, $sql);

}


function getStudentImage($sid, $conn)
{
	$sql = "SELECT student_img FROM `Student` WHERE `student_id`='" . $sid . "';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "";
		}
	}
}

function getTeacherCount($conn,$code)
{
	$sql = "SELECT COUNT(*) as count FROM teacherData where teacher_inst_id='".$code."';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			return $row[0];
		} else {
			return "0";
		}
	}
}

function isInstituteUpdated($conn,$code)
{

	$sql = "SELECT * FROM Institute where inst_id='".$code."' AND inst_sector IS NOT NULL;";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			
				return true;
			
			
		} else {
			return false;
		}
	}
}



function getInstituteType($conn,$code)
{

	$sql = "SELECT icred_login_name FROM InsCredentials where institute_inst_id='".$code."';";
	if ($result = $conn->query($sql)) {
		$row = $result->fetch_row();
		if ($row[0]) {
			if (strpos($row[0], "@fde") !== false) {
				return "FDE";
			}else{
				return "PRIVATE";
			}
		} else {
			return "0";
		}
	}
}


?>