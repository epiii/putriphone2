<?php
// require 'koneksi.php';
// function phone_format_id($nohp) {
//   $nohp = str_replace(" ","",$nohp);
//   $nohp = str_replace("(","",$nohp);
//   $nohp = str_replace(")","",$nohp);
//   $nohp = str_replace(".","",$nohp);
//
//   if(!preg_match('/[^+0-9]/',trim($nohp))){
//     if(substr(trim($nohp), 0, 3)=='+62'){ // +62xxxx
//       $hp = trim($nohp);
//       } elseif(substr(trim($nohp), 0, 1)=='0'){ // 08xxxx
//       $hp = '+62'.substr(trim($nohp), 1);
//     } else {
//       $hp = 0;
//     }
//   } return $hp;
// }

function pr($par){
  echo "<pre>";
    print_r($par);
  echo"</pre>";
  exit();
}

function phone_format2($no){
    require 'koneksi.php';
    $no = str_replace(" ","",$no);
    $no = str_replace("-","",$no);
    $no = str_replace("(","",$no);
    $no = str_replace(")","",$no);
    $no = str_replace(".","",$no);

    // full = 085655009393
    $_1startNo = substr(trim($no), 1); // 85655009393
    $_1digitNo = substr($no,1,1); // 8
    $_2digitNo = substr($no,1,2); // 85

    $res=[];
    $res['number']=$no;
    // $res['country']='unknown';

    $s='SELECT nama,param2,param3 FROM parameter WHERE param1="nomor" ORDER BY  CHAR_LENGTH(param3) DESC';
    $e=mysqli_query($conn,$s);
    $n=mysqli_num_rows($e);

    if($n>0){ // data exist
      // loop from table : parameter
      while ($r=mysqli_fetch_assoc($e)) {
        if(strpos($r['param3'],',')!=false){// exist (,) / more than 1 digit (ex : india : 7,8,90,dst..)
          $param3s=explode(',',$r['param3']);
          foreach ($param3s as $param3) {
            if($param3==$_1digitNo || $param3==$_2digitNo){
              $prefix = $r['nama']; // +91
              $country = $r['param2']; // india
              break;
            }
          } // end of foreach
        }else{ // not contain (,) / only 1 digit (ex : indonesia : 8)
          if($param3==$_1digitNo){
            $prefix = $r['nama']; // +62
            $country = $r['param2']; // indonesia
            break;
          }
        } // end of else
      } // end of while

      // store value to array
      $res=[
        'number'=>$prefix.$_1startNo,
        'country'=>is_null($country)?'unknown':$country,
      ];
    } // end of if
    return $res;
}

function getCountry($no){
  $country = phone_format2($no);
  return $country['country'];
}

function getNumber($no){
  $number = phone_format2($no);
  return $number['number'];
}
