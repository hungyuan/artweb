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

$compareToday_RecToday = date("Y-m-d");

mysql_select_db($database_connect2data, $connect2data);
$query_RecToday = sprintf("SELECT * FROM webcount WHERE count_time LIKE %s", GetSQLValueString($compareToday_RecToday . "%", "text"));
$RecToday = mysql_query($query_RecToday, $connect2data) or die(mysql_error());
$row_RecToday = mysql_fetch_assoc($RecToday);
$totalRows_RecToday = mysql_num_rows($RecToday);

mysql_select_db($database_connect2data, $connect2data);
$query_RecTotal = "SELECT * FROM webcount";
$RecTotal = mysql_query($query_RecTotal, $connect2data) or die(mysql_error());
$row_RecTotal = mysql_fetch_assoc($RecTotal);
$totalRows_RecTotal = mysql_num_rows($RecTotal);
?>
<?php
mysql_free_result($RecToday);

mysql_free_result($RecTotal);
?>