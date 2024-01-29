<?php
session_start();
include 'dbutils.php';
$conn=OpenCon();
echo "Starting Service...";
try{
    $directory = '../uploads';
    if (!is_dir($directory)) {
        exit('Invalid diretory path');
    }
    $files = array();
    
    echo "Analyzing Pictures...";
    foreach (scandir($directory) as $file) {
        if ($file !== '.' && $file !== '..') {
            $files[] = $file;
        }
    }


echo "Starting Deletion...";
    foreach ($files as $file) {
        //echo $file;
        $splitted = explode("-",$file);
        if(!($splitted[0]=="") && !($splitted[1]=="") && !($splitted[2]=="")){
        
        
        
        $cnic = $splitted[0]."-".$splitted[1]."-".$splitted[2];
        $ext = explode(".",$splitted[3]);
        $name=$ext[0];
        $exten=$ext[1];
        $isEx = stdExists($cnic,$name,$conn);

if(!$isEx){

    $jpgfname=$cnic."-".$name.".".$exten;
        unlink("../uploads/".$jpgfname);
        echo "<br>REMOVED : ".$jpgfname;
    
}
    }
    }
    //var_dump($files);
}catch(Error $e){
    echo $e->getMessage();
    }




$sql = "SELECT * FROM Student;";
		$result = $conn->query($sql);
		$current="";
		if ($result->num_rows > 0) {
		  while($row = $result->fetch_assoc()) {

            $cnic=$row['student_b_form'];  
            $name=$row['student_name'];  

               
$path="../uploads/".$cnic."-".$name.".jpg";
$path_jpeg = "../uploads/".$cnic."-".$name.".jpeg";


if(file_exists($path)){
        if(file_exists($path_jpeg)){
          echo "both";
        $jpg = filectime($path);
          $jpeg = filectime($path_jpeg);
          if($jpg>$jpeg){
            
            unlink($path_jpeg);
            echo "<br>REMOVED : ".$path_jpeg;

      }else{
             unlink($path);
             echo "<br>REMOVED : ".$path;
      }
        //both
    }else{
         //only jpg
    }
}
else if(file_exists($path_jpeg)){
    
        if(file_exists($path)){
            $jpg = filectime($path);
          $jpeg = filectime($path_jpeg);
          if($jpg>$jpeg){
            
            unlink($path_jpeg);
            echo "<br>REMOVED : ".$path_jpeg;

      }else{
             unlink($path);
             echo "<br>REMOVED : ".$path;
      }
            //both
        }else{
               //only jpeg
        }
}else{
 
}

          }
        }
 

?>