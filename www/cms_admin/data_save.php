<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
  $d_title		= isset($_POST['d_title']) ? $_POST['d_title'] : NULL;
  $d_content	= isset($_POST['d_content']) ? $_POST['d_content'] : NULL;
  $d_class2		= isset($_POST['d_class2']) ? $_POST['d_class2'] : NULL;
  $d_class3		= isset($_POST['d_class3']) ? $_POST['d_class3'] : NULL;
  $d_class4		= isset($_POST['d_class4']) ? $_POST['d_class4'] : NULL;
  $d_class5		= isset($_POST['d_class5']) ? $_POST['d_class5'] : NULL;
  $d_class6		= isset($_POST['d_class6']) ? $_POST['d_class6'] : NULL;
  $d_price1 	= ($_POST['d_price1']=='') ? 0 : $_POST['d_price1'] ;
  $d_price2		= isset($_POST['d_price2']) ? $_POST['d_price2'] : NULL;
  $d_inventory	= isset($_POST['d_inventory']) ? $_POST['d_inventory'] : NULL;
  $d_sale		= isset($_POST['d_sale']) ? $_POST['d_sale'] : NULL;
  $d_new_product= isset($_POST['d_new_product']) ? $_POST['d_new_product'] : NULL;
  
 if(isset($_POST['select1'])){
 	$d_class2 = $_POST['select1'];
 }
  
  if(isset($_POST['d_date']) && $_POST['d_date']!=''){
	  if(is_time($_POST['d_date'])){
		  $d_date = $_POST['d_date']; 
	  }else{
		  $d_date = date("Y-m-d H:i:s");  
	  }
  }else{
	  $d_date = date("Y-m-d H:i:s");
  }
  
  $updateSQL = sprintf("UPDATE data_set SET d_title=%s, d_content=%s, d_class2=%s, d_class3=%s, d_class4=%s, d_class5=%s, d_class6=%s, d_price1=%s, d_price2=%s, d_inventory=%s, d_sale=%s, d_new_product=%s, d_date=%s, d_active=%s WHERE d_id=%s",
                       GetSQLValueString($d_title, "text"),
                       GetSQLValueString($d_content, "text"),
                       GetSQLValueString($d_class2, "text"),
                       GetSQLValueString($d_class3, "text"),
                       GetSQLValueString($d_class4, "text"),
                       GetSQLValueString($d_class5, "text"),
                       GetSQLValueString($d_class6, "text"),
                       GetSQLValueString($d_price1, "int"),
                       GetSQLValueString($d_price2, "int"),
                       GetSQLValueString($d_inventory, "int"),
                       GetSQLValueString($d_sale, "int"),
                       GetSQLValueString($d_new_product, "int"),
                       GetSQLValueString($d_date, "date"),
                       GetSQLValueString($_POST['d_active'], "int"),
                       GetSQLValueString($_POST['d_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

  /*$updateGoTo = "bannersHome_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum=".$_SESSION["ToPage"];
  }*/
  
}

//$date = "2012-1-07 20:46:09";

/*if (preg_match('/\\A(?:^((\\d{2}(([02468][048])|([13579][26]))[\\-\\/\\s]?((((0?[13578])|(1[02]))[\\-\\/\\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\\-\\/\\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\\-\\/\\s]?((0?[1-9])|([1-2][0-9])))))|(\\d{2}(([02468][1235679])|([13579][01345789]))[\\-\\/\\s]?((((0?[13578])|(1[02]))[\\-\\/\\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\\-\\/\\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\\-\\/\\s]?((0?[1-9])|(1[0-9])|(2[0-8]))))))(\\s(((0?[0-9])|(1[0-9])|(2[0-3]))\\:([0-5][0-9])((\\s)|(\\:([0-5][0-9])))?))?$)\\z/', $date)) {
	// date is valid
} else {
	// date is invalid
}*/


//echo is_time("2012-2-31 0:6:0");
function is_time($date)
{
//$pattern = '/[\d]{4}-[\d]{1,2}-[\d]{1,2}\s[\d]{1,2}:[\d]{1,2}:[\d]{1,2}/';
//$pattern = '/[\d]{4}-[\d]{2}-[\d]{2}\s[\d]{2}:[\d]{1,2}:[\d]{1,2}/';
$pattern = '/\\A(?:^((\\d{2}(([02468][048])|([13579][26]))[\\-\\/\\s]?((((0?[13578])|(1[02]))[\\-\\/\\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\\-\\/\\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\\-\\/\\s]?((0?[1-9])|([1-2][0-9])))))|(\\d{2}(([02468][1235679])|([13579][01345789]))[\\-\\/\\s]?((((0?[13578])|(1[02]))[\\-\\/\\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\\-\\/\\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\\-\\/\\s]?((0?[1-9])|(1[0-9])|(2[0-8]))))))(\\s(((0?[0-9])|(1[0-9])|(2[0-3]))\\:([0-5][0-9])((\\s)|(\\:([0-5][0-9])))?))?$)\\z/';

return preg_match($pattern, $date);
}
?>