<?php

// debug value of "variable"
function pr($par){
  echo "<pre>";
    print_r($par);
  echo"</pre>";
  exit();
}

// convert "format" of phone number
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

    $s='SELECT nama,param2,param3,param4
        FROM parameter
        WHERE
          param1="nomor" AND
          param4 LIKE "%'.strlen($_1startNo).'%"
        ORDER BY
          CHAR_LENGTH(param3) DESC';
    $e=mysqli_query($conn,$s);
    $n=mysqli_num_rows($e);

    if($n>0){ // data is exist
      // loop from table : parameter
      $arr=[];
      while ($r=mysqli_fetch_assoc($e)) {
        if(strpos($r['param3'],',')==false){// exist (,) / more than 1 digit (ex : india : 7,8,90,dst..)
          if($r['param3']==$_1digitNo){
            $digit = $r['param4']; // +62
            $prefixInter = $r['nama']; // +62
            $prefixLocal = $r['param3']; // 08
            $country = $r['param2']; // indonesia
            break ; // break from "while" loop
          }
        } else { // not contain (,) / only 1 digit (ex : indonesia : 8)
          $param3s=explode(',',$r['param3']);
          foreach ($param3s as $param3) {
            if($param3==$_1digitNo || $param3==$_2digitNo){
              $digit = $r['param4']; // +62
              $prefixInter = $r['nama']; // +62
              $prefixLocal = $r['param3']; // 7,8,90,...
              $country = $r['param2']; // india
              break 2; // break from "foreach & while" loop
            } // end of if
          } // end of foreach
        } // end of else
      } // end of while

      // store value to array
      $res=[
        'digit'=>$digit,
        'prefixLocal'=>$prefixLocal,
        'prefixInter'=>$prefixInter,
        'number'=>$prefixInter.$_1startNo,
        'country'=>$country,
      ];
    } // end of 'if'
    return $res;
 } // end of function

 function getDigit($no){
   $ret = phone_format2($no);
   return is_null($ret['digit'])?'unknown':$ret['digit'];
 }

 function getNumber($no){
   $ret = phone_format2($no);
   return is_null($ret['number'])?'unknown':$ret['number'];
 }

function getCountry($no){
  $ret = phone_format2($no);
  return is_null($ret['country'])?'unknown':$ret['country'];
}

function getPrefixInter($no){
  $ret = phone_format2($no);
  return is_null($ret['prefixInter'])?'unknown':$ret['prefixInter'];
}

function getPrefixLocal($no){
  $ret = phone_format2($no);
  return is_null($ret['prefixLocal'])?'unknown':'0'.$ret['prefixLocal'];
}
