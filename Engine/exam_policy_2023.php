<?php

//Fetch Student Result 

//Get Failed Courses of each Category [CAT-1] and [CAT-2]
//Get Aggregate Result [AGR]

//Check if failed more than 1 course from [CAT-1] / If more than 1 (FAILED)->  do not check Promotion Policy
//Check if failed more than 2 courses from [CAT-2] / If more than 2 (FAILED)-> do not check Promotion Policy

function point1(){


    //Failure in any one subject of either category but securing 20% marks 
    //in that subject 
    //with an overall aggregate 40% -> [AGR]>=40%

        //if [FAILED_COURSE_CAT-1] + [FAILED_COURSE_CAT-2] == 1

    $isSatisfied=false;
}

function point2(){

     
    //Failure in two subjects, one from each category but securing 
    //20% marks in each
    //failing subject with an overall aggregate 40% -> [AGR]>=40%

    //if [FAILED_COURSE_CAT-1] == 1 AND [FAILED_COURSE_CAT-2] == 1
    
    $isSatisfied=false;
}

function point3(){


    //Failure in two subject of Category-II 
    //but securing 20% marks in each failing subject
    //with an overall aggregate 40%.
    
        //if [FAILED_COURSE_CAT-2] == 2 && [FAILED_COURSE_CAT-1] == 0

    $isSatisfied=false;
}



//Controller 

//-> Based on isSatified generate decision

//Return if Promoted / Passed / Failed

//Copy Result in result table with final status


?>