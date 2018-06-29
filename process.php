<?php
require 'koneksi.php';
require 'lib.php';

$out=[];
if(!isset($_POST)){ // error
  $out=['status'=>'invalid_request'];
} else { // tidak error
  if($_POST['mode']=='phonecheck'){ // check nomor
    $phone = phone_format($_POST['number']);
    // var_dump($phone);exit();
    $out=[
      'status'=>'checkphone',
      'number'=>$phone['number'],
      'country'=>$phone['country'],
    ];
  } elseif ($_POST['mode']=='phonelist'){ // check semua
   //  $s = 'SELECT * FROM pengguna order by no_wa DESC ';
  	// $e = mysqli_query($conn,$s);
   //  $arr=[];
   //  while ($r=mysqli_fetch_assoc($e)) {
   //    $arr[]=[
   //      'id'=>$r['id'],
   //      'username'=>$r['username'],
   //      'no_wa_old'=>$r['no_wa'],
   //      'no_wa_new'=>phone_format($r['no_wa'])=='0'?'not Indonesia':phone_format($r['no_wa']),
   //    ];
   //  }
   //  $out=[
   //    'status'=>'phonelist',
   //    'data'=>$arr
   //  ];
  } elseif ($_POST['mode']=='phonesave'){ // create / update
    // sql here ......
    $out=[
      'status'=>true,
    ];
  }
}
echo json_encode($out);
?>
