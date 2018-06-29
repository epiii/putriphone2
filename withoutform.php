<?php
require 'lib.php';

// case :
  // $no = '07111111111'; // 10  - india - +91
  // $no = '09333333333'; // 10  - india - +91
  // $no = '08101010101'; // 10  - indo - +62
  // $no = '0111111111'; // 9  - malay - +60
  // $no = '01222222222'; // 10  - mesir - +20
  // $no = '081111111111'; // 11  - indo - +62
  // $no = '082222222222'; // 11  - indo - +62
  // $no = '012222222222'; // 11  - china - +86
  // $no = '056666666666'; // 11  - turki - +90
  $no = '0222222222222'; // 12  - selandia - +64

// input
  echo 'no. (before) : '.$no;

// output
  echo '<br />--------------';
  echo '<br />no. (after) : '.getNumber($no);
  echo '<br />prefix (local) : '.getPrefixLocal($no);
  echo '<br />prefix (international) : '.getPrefixInter($no);
  echo '<br />country : '.getCountry($no);
?>
