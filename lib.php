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

  function phone_format($no){
      // exit();
      require 'koneksi.php';
      $no = str_replace(" ","",$no);
      $no = str_replace("-","",$no);
      $no = str_replace("(","",$no);
      $no = str_replace(")","",$no);
      $no = str_replace(".","",$no);

      // $no = 085655009393
      $_1_dst = substr(trim($no), 1); // 856....
      $_1_1 = substr(trim($no), 1, 1); // 8

      // ---
      $res=[];
        $res['number']=$no;
        $res['country']='unknown';
      // var_dump($res);

      if($_1_1=='8'){ // indonesia : 08xxx -> +62xxx
        $res=[
          'number'=>'+62'.$_1_dst,
          'country'=>'Indonesia'
        ];
      }else{ // negara lain : 0236xx -> +236xx
        $s='SELECT nama,param2 FROM parameter WHERE param1="nomor"';
        $e=mysqli_query($conn,$s);
        $n=mysqli_num_rows($e);

        if($n>0){
          // $arr=[];
          while ($r=mysqli_fetch_assoc($e)) {
            $code=substr($r['nama'],1); //  1 / 20 / 880 / ....
            $pos= strpos($_1_dst,$code); // posisi : 0 / 1 / 2 / ....
            // $arr[]=[$code,$pos];
            if(is_numeric($pos) && $pos==0){ // jika ada di awal posisi
                $res=[
                  'number'=>'+'.$_1_dst,
                  'country'=>$r['param2']
                ];
                break;
            }
          }
        }
      }
      return $res;
  }

  function pr($par){
    echo "<pre>";
      print_r($par);
    echo"</pre>";
    exit();
  }
