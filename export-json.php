<?php

include_once("config/database.php");

//first get json data
$json_data = file_get_contents("rexx_jsondata.json");
//print_r($json_data);exit;

//convert jsin data to array
$rexxdata = json_decode($json_data, true);

$total = 0;
$query_err = array();

//loop each record and insert into table
foreach($rexxdata as $val){
    //print_r($val);exit;

    //add data into table
    $particiant_qry = "INSERT INTO `rexx_bookings` (participation_id, employee_name, employee_email, event_id, event_name, participation_fee, event_date, pversion) 
            VALUES ('".$val['participation_id']."', '".$val['employee_name']. "', '".$val['employee_mail']."', '".$val['event_id']."', 
            '".$val['event_name']."', '".$val['participation_fee']."', '".$val['event_date']."', '". $val['version']."')";
            
    //if run query then continue
    if($conn->query($particiant_qry)){
        $total++;
    }else{
        $query_err[] = 'Error in Query : ' . mysql_error();
    }
}

//display total records stored in table
echo "Total booking record(s) have been added from json are : <strong>". $total . "</strong><hr>";

//if any error while insert then show  
if(!empty($query_err)){
    print_r($query_err);
}
?>