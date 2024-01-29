<?php
set_time_limit(0);
session_start();

include 'Engine/dbutils.php';

$conn = OpenCon();


function execute($conn){

   $sqlx = "SELECT * FROM Student,StudentRegistration where Student.student_id=StudentRegistration.student_student_id ;";
   
   $resultx = mysqli_query($conn, $sqlx);
  
   $count=1;
   while ($rowx = mysqli_fetch_assoc($resultx)) {
   
            $rollno = $count;
            $updateStudentx = "UPDATE StudentRegistration SET reg_roll_no='".$rollno."',isNewRoll=0 WHERE student_student_id='".$rowx['student_student_id']."';";
            mysqli_query($conn, $updateStudentx);
            echo $rowx['student_id'].'-'.$rollno.' UPDATED <br>' ;

            $count++;
        echo '░' ;
   }
   echo '<br><br>' ;

}



function execute_eighth($conn){

    $sqlIns = "SELECT * from proposedInstitute;";
    
    $insResult = mysqli_query($conn, $sqlIns);
    
    while ($rowIns = mysqli_fetch_assoc($insResult)) {
    
       $centerId=$rowIns['pins_id'];
    
       echo 'PROCESSING CENTER '.$rowIns['pins_name'].'<br>Progress';
    
       $sqlx = "SELECT * FROM Student,StudentRegistration,SubjectCategory,BankChallan where SubjectCategory.sub_cat_id=StudentRegistration.reg_student_subjectCat_sub_cat_id  
       AND Student.student_id=StudentRegistration.student_student_id AND 
       SubjectCategory.class='8'  AND StudentRegistration.reg_challan_detail_challan_id=BankChallan.challan_id AND StudentRegistration.reg_allocated_center_inst_id='".$centerId."' AND BankChallan.isPaid=1;";
       
       $resultx = mysqli_query($conn, $sqlx);
       $class='8';
    
       while ($rowx = mysqli_fetch_assoc($resultx)) {
       
            if($rowx['isNewRoll']==0){
             
                $rollno = $class . "" . $centerId ."0". "100";
                $nexRoll = $rollno;
                
                $isav = false;
                $limit = getCenterLimit($centerId, $conn);
            
                for ($i = 0; $i < $limit; $i++) {
    
                    $isVacc = isRollVaccant($nexRoll, $conn);
                    
                    if ($isVacc) {
                        $isav = true;
                        break;
                    }
                    $nexRoll++;
                   
                }
    
                $updateStudentx = "UPDATE StudentRegistration SET reg_roll_no='".$nexRoll."', isNewRoll=1 WHERE student_student_id='".$rowx['student_student_id']."';";
                mysqli_query($conn, $updateStudentx);
                echo $rowx['student_id'].'-'.$nexRoll.' UPDATED <br>' ;
    
            }
            echo '░' ;
       }
       echo '<br><br>' ;
    }
    }


execute($conn);

