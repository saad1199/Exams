<style>
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  text-align:center;
 
}
</style>
<?php 
session_start();

if(isset($_GET['ref'])){
  if($_GET['ref']!="fde-gov-pk"){
    exit();
  }
}else{
  exit();
}

include "Engine/dbutils.php";
$conn = OpenCon();



    function generateKey($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



$sql = "SELECT * from MarkingCenter;";

$result=mysqli_query($conn,$sql);



while($row=mysqli_fetch_assoc($result)){

    $centerName=$row['markingCenter_name'];
    $class =$row['class'];
    
    $sql2="SELECT * from MarkingCenter_Subject WHERE marking_center_id='".$row['markingCenter_id']."';";

    $resultx=mysqli_query($conn,$sql2);
    while($rowx=mysqli_fetch_assoc($resultx)){
      echo '<br><br><div style="text-align:center;"><h1>Federal Directorate of Education Islamabad</h1><p>If you found guilty of misusing this key or sharing marks, <strong>LEGAL PROCEEDINGS</strong> shall be initiated against you.<br>  In case of queries call FDE IT-Section 051-9262449</p></div>';
      echo '<div style="width:100%;"><table style="width:100%;"><thead><th style="width:30%;">Scan</th><th style="width:20%;">Center</th><th style="width:10%;">Subject</th style="width:10%;"><th style="width:30%;">KEY</th></thead><tbody>';
        echo "<tr>";
       
        //$password=$key; //32 BIT Key
        //$encrypted_string=generateKey();
     

        //$sqlu="UPDATE MarkingCenter_Subject SET marking_key='".$encrypted_string."' WHERE mc_s_id='".$rowx['mc_s_id']."';";

        //mysqli_query($conn,$sqlu);
      

         echo'<td><img src="https://chart.googleapis.com/chart?cht=qr&chl='.$encrypted_string.'&chs=105x105&chld=L|0" class=""/></td>';
        echo '<td>'.$centerName.'</td>';
        echo '<td>'.getSubjectFromID($rowx['sub_id'],$conn).' / Class '.$class.'th </td>';
         echo '<td style="word-wrap: break-word;"><h4>'.$rowx['marking_key'].'</h4></td>';
         echo "</tr>";
       
        
         echo '</tbody></table><h1 style="font-size:7px; font-style:italic;">System Designed and Developed by Saad Sadiq (Asst. Programmer IT-Section FDE)</h1></div>';


 
        }


}




?>