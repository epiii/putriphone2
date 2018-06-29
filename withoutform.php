<?php
require 'lib.php';

// case :
  // $no = '07111111111'; // 10 digit  - india - +91 // ambiguous indo 10 vs india 10
  // $no = '08111111111'; // 10 digit  - india - +91 // ambiguous indo 10 vs india 10
  // $no = '09333333333'; // 10 digit  - india - +91 // ambiguous indo 10 vs india 10
  // $no = '0809090909'; // 9 digit  - indo - +62
  // $no = '08101010101'; // 10 digit  - indo - +62 // ambiguous indo 10 vs india 10
  // $no = '081010101010'; // 11 digit  - indo - +62
  // $no = '0111111111'; // 9 digit  - malay - +60
  // $no = '01222222222'; // 10 digit  - mesir - +20
  // $no = '081111111111'; // 11 digit  - indo - +62
  // $no = '082222222222'; // 11 digit  - indo - +62
  // $no = '012222222222'; // 11 digit  - china - +86
  $no = '056666666666'; // 11 digit  - turki - +90
  // $no = '0222222222222'; // 12 digit  - selandia - +64

// input
  echo 'no. (before) : '.$no;

// output
  echo '<br />--------------';
  echo '<br />digit : '.getDigit($no);
  echo '<br />no. (after) : '.getNumber($no);
  echo '<br />prefix (local) : '.getPrefixLocal($no);
  echo '<br />prefix (international) : '.getPrefixInter($no);
  echo '<br />country : '.getCountry($no);
?>
