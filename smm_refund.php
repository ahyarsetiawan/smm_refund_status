<?php
// Script Auto Refund Order Pulsa
// By -> Pengetik Source
// Thx to Ahmad Rahbani, Ahyar Dwi Setiawan
// Build With Love
// 12/20/2017 8:59 AM 
// For Auto Refund
require("../mainconfig.php");

$check_orders = mysqli_query($db, "SELECT * FROM orders_pulsa WHERE status = 'Error' AND refund = '0'");
while($data_orders = mysqli_fetch_assoc($check_orders)) {
 $user = $data_orders['user'];
 $oid  = $data_orders['oid'];
 $price = $data_orders['price'];
 
  $update_user = mysqli_query($db, "UPDATE users set balance = balance+$price WHERE username = '$user'");
  $update_user = mysqli_query($db, "UPDATE orders_pulsa set refund = '1' WHERE oid = '$oid'");
  
  if($update_user == TRUE) {
  $hasil = json_encode(array("oid" => $oid, "data" => array("price" => $price, "status" => "Error", "refund" => "yes")));
  $hasil = json_decode($hasil);
  } else {
  $hasil = json_encode(array("oid" => $oid, "data" => array("price" => $price, "status" => "Error", "refund" => "not")));
  $hasil = json_decode($hasil); 
}
  print '<pre> '.print_r($hasil, true).' </pre>';
}