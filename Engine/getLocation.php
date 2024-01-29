<?php
session_start();
//if latitude and longitude are submitted
if(!isset($_GET['latitude']) && !isset($_GET['longitude'])){
echo "Unset";
}else{
    //send request and receive json data by latitude and longitude
    $url = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyABqScXDXRNIq54JSLgqA195r7uczA2aDQ&latlng='.trim($_GET['latitude']).','.trim($_GET['longitude']).'&sensor=false';
    echo "HELLO";
    exit();
    $json = @file_get_contents($url);
    $data = json_decode($json);
    $status = $data->status;
    
    //if request status is successful
    if($status == "OK"){
        //get address from json data
        $location = $data->results[0]->formatted_address;
    }else{
        $location =  'Nan';
        
    }
    
    //return address to ajax 
    echo $location;
}
?>

