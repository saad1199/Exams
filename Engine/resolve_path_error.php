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
$instid="000";
        if (!file_exists('../uploads-new/'.$instid)) {
            mkdir('../uploads-new/'.$instid);
        }
    }else{
        if (!file_exists('../uploads-new/'.$instid)) {
            mkdir('../uploads-new/'.$instid);
        }
    }   
}catch(Exception $e){
    $instid="000";
    if (!file_exists('../uploads-new/'.$instid)) {
        mkdir('../uploads-new/'.$instid);
    }
}
        $picnamejpg = '../uploads/' . $cnic . '-' . $name . '.jpg';
        $picnamejpeg = '../uploads/' . $cnic . '-' . $name . '.jpeg';

        if (file_exists($picnamejpg)) {
            if (file_exists($picnamejpeg)) {
                
                $jpg = filectime($picnamejpg);
                $jpeg = filectime($picnamejpeg);

                if ($jpg > $jpeg) { // jpg latest

                    $newfile='../uploads-new/'.$instid.'/'.$newnum.'.jpg';
                    $newfname=$newnum.'.jpg';
                    if (!copy($picnamejpg, $newfile)) {
                        echo "failed to copy"."<br>";
                    }else{
                        echo "Copied with name ".$newfile."<br>";
                        //unlink("../uploads/".$picnamejpg);
                        //echo "<br>REMOVED : ".$picnamejpg;
                    }
                } else { //jpeg latest
                    
                    $newfile='../uploads-new/'.$instid.'/'.$newnum.'.jpeg';
                    $newfname=$newnum.'.jpeg';
                    if (!copy($picnamejpeg, $newfile)) {
                        echo "failed to copy"."<br>";
                    }else{
                        echo "Copied with name ".$newfile."<br>";
                       //unlink("../uploads/".$picnamejpeg);
                       // echo "<br>REMOVED : ".$picnamejpeg;
                    }
                }
                //both
            } else {
                    
                    $newfile='../uploads-new/'.$instid.'/'.$newnum.'.jpg';
                    $newfname=$newnum.'.jpg';
                    if (!copy($picnamejpg, $newfile)) {
                        echo "failed to copy"."<br>";
                    }else{
                        echo "Copied with name ".$newfile."<br>";
                        //unlink("../uploads/".$picnamejpg);
                        //echo "<br>REMOVED : ".$picnamejpg;
                    }

            }
        }else if (file_exists($picnamejpeg)) {

            if (file_exists($picnamejpg)) {

                $jpg = filectime($picnamejpg);
                $jpeg = filectime($picnamejpeg);

                if ($jpeg > $jpg) { // jpg latest

                    $newfile='../uploads-new/'.$instid.'/'.$newnum.'.jpeg';
                    $newfname=$newnum.'.jpeg';
                    if (!copy($picnamejpeg, $newfile)) {
                        echo "failed to copy"."<br>";
                    }else{
                        echo "Copied with name ".$newfile."<br>";
                        //unlink("../uploads/".$picnamejpeg);
                        //echo "<br>REMOVED : ".$picnamejpeg;
                    }
                    
                } else { //jpg latest
                    $newfile='../uploads-new/'.$instid.'/'.$newnum.'.jpg';
                    $newfname=$newnum.'.jpg';
                    if (!copy($picnamejpg, $newfile)) {
                        echo "failed to copy"."<br>";
                    }else{
                        echo "Copied with name ".$newfile."<br>";
                        //unlink("../uploads/".$picnamejpg);
                        //echo "<br>REMOVED : ".$picnamejpg;
                    }    
                }
        
            }else{
                $newfile='../uploads-new/'.$instid.'/'.$newnum.'.jpeg';
                $newfname=$newnum.'.jpeg';
                if (!copy($picnamejpeg, $newfile)) {
                    echo "failed to copy"."<br>";
                }else{
                    echo "Copied with name ".$newfile."<br>";
                   // unlink("../uploads/".$picnamejpeg);
                   // echo "<br>REMOVED : ".$picnamejpeg;
                }
            }
        }
    $sqlx = "UPDATE `Student` SET student_img = '".$newfname."' WHERE student_id='".$id."';";
    mysqli_set_charset($conn, 'utf8');
    if(mysqli_query($conn, $sqlx)){
        echo "updated id"."<br>";
    }else{
        echo "can't updated id"."<br>";
    }
  

    }//while



}catch(Exception $e){
    echo $e->getMessage();
}
