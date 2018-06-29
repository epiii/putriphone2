<?php
require 'koneksi.php';
require 'lib.php';

$out=[];
if(!isset($_POST)){ // error
  $out=['status'=>'invalid_request'];
} else { // tidak error
  if($_POST['mode']=='phonecheck'){ // check nomor
    $out=[
      'status'=>'checkphone',
      'number'=>getNumber($_POST['number']),
      'country'=>getCountry($_POST['number']),
    ];
  } elseif ($_POST['mode']=='phonesave'){ // create / update
    // sql here ......
    $out=[
      'status'=>true,
    ];
  }
}
echo json_encode($out);
?>
