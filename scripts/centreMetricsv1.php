<?php




//php script per centre

//variables

//centres
//dates
//same queries as before

//generate an array of centres
//x=1

//get array of centre ids from centre table

//get an array of dates in correct format since 9/2008 until present

function generateDates ($startDate, $interval='P3M'){

$date1  = new DateTime($startDate); 
$date2  = new DateTime();
//echo date('Y-m-d', $date2);
$output = [];
//echo $time   = date('Y-m-d', $date2);
$time = $date1;
$time = $time->add(new DateInterval($interval));
$last = $date2;

$x=0;
do {
    $month = $time->format('Y-m-d');
    //$total = date('t', $time);

    $output[$x] = $month;

    $time = $time->add(new DateInterval('P3M'));
    $x++;
    
} while ($time < $last);

return ($output);

}

$startDate = '2008-09-01';

$dates = generateDates($startDate);

print_r($dates);

foreach ($dates as $key=>$value){

    //first attempt

    if (($key - 1) < 0){

        $q = "SELECT COUNT(`_k_lesion`) FROM `Lesion` as a 
        INNER JOIN `Procedure` as b on a.`_k_procedure` = b.`_k_procedure`
        INNER JOIN `Patient` as c on b.`_k_patient` = c.`_k_patient` 
        WHERE c.`Institution` = 1 
        AND b.`ProcedureDate` > '$startDate' 
        AND b.`ProcedureDate` < '$value';";

        echo $q . '<br>';

    }else{

    //generate a request

        $q = "SELECT COUNT(`_k_lesion`) FROM `Lesion` as a 
        INNER JOIN `Procedure` as b on a.`_k_procedure` = b.`_k_procedure`
        INNER JOIN `Patient` as c on b.`_k_patient` = c.`_k_patient` 
        WHERE c.`Institution` = 1 
        AND b.`ProcedureDate` > '{$dates[$key-1]}' 
        AND b.`ProcedureDate` < '$value';";

        echo $q . '<br>';
    }

}

/*
foreach ($centres as $key=>$value) {

    //check the number of cases for a defined time
    
} 
*/

//SELECT a.`_k_lesion`, b.`ProcedureDate` FROM `Lesion` as a INNER JOIN `Procedure` as b on a.`_k_procedure` = b.`_k_procedure` WHERE b.`Institution` = 1 AND b.`ProcedureDate` > '2018-12-01' AND b.`ProcedureDate` < '2019-03-01'