<?php
function moneyFormat($data,$n=0) {
$data1=number_format(substr($data,0,strrpos($data,".")==0?strlen($data):strrpos($data,".")));
$data2=substr( strrchr( $data, "." ), 1 );
if($data2==0) $data3="";
  else {
   if(strlen($data2)>$n) $data3=substr($data2,0,$n);
     else $data3=$data2;
  $data3=".".$data3;
  }
return $data1;
}
?>