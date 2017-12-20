<?php
/* Script by Pengetik Source & YarzCode
/* Thanks to Ahmad Rahbani & Ahyar Dwi Setiawan
/* Build With Love 
*/
 
// Status
// 1 : Pending
// 2 : Gagal / Error
// 3 : Refund
// 4 : Success
require("../mainconfig.php");
 
$a = mysqli_query($db, "SELECT * FROM tablename WHERE status = 'Pending'");
while($b = mysqli_fetch_assoc($a)) {
       $order_id = "yarzc0de";
            $api_link = "this api link";
            $api_header = array(
                                'If need header',
                             );
            $api_postdata = "your postdata";
                             
           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $api_link);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
           curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
           curl_setopt($ch, CURLOPT_HTTPHEADER, $api_header); // if need header
           curl_setopt($ch, CURLOPT_POST, 1);
           curl_setopt($ch, CURLOPT_POSTFIELDS, $api_postdata);
           $result = curl_exec($ch);    
           $json_result = json_decode($result, true);
 
            if($status == "1") { // if status == 1 Update to pending
             $sets = "Pending";
            } else if($status == "2") { // if status == 2 Update to Error
             $sets = "Error"; 
            } else if($status == "3") { // if status == 3 Update to Error
             $sets = "Error";
            } else if($status == "4") { // if status == 4 Update to Success
             $sets = "Success";
           }    
           $update = mysqli_query($db, "UPDATE tablename set status = '$sets'  WHERE orderid = '$oid'");
           if($update == TRUE) {
               $array = array("oid" => $oid,
                              "status" => $sets,
                              "update" => "ok");
           } else {
               $array = array("oid" => $oid,
                              "status" => $sets,
                              "update" => "error");
           }
           
           $array = json_encode($array);
           $array = json_decode($array);
           
           print '<pre> '.print_r($array, true).' </pre>'; // print
           // done...
}