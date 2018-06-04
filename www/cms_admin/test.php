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


mysql_select_db($database_connect2data, $connect2data);
$query_RecinternationalT = "SELECT * FROM terms AS T WHERE T.slug='work' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecinternationalT = mysql_query($query_RecinternationalT, $connect2data) or die(mysql_error());
$row_RecinternationalT = mysql_fetch_assoc($RecinternationalT);
$totalRows_RecinternationalT = mysql_num_rows($RecinternationalT);


$G_selected1 = '';
$SDSQL = '';
if(isset($_GET['selected1']) && $_GET['selected1']!=''){
	
	if($_GET['selected1']!=0){
		$_SESSION['selected_internationalT'] = $G_selected1 = $_GET['selected1'];
		$SDSQL = " AND T.term_id='$G_selected1'";	
	}else{
		$_SESSION['selected_internationalT'] = $G_selected1 = $_GET['selected1'];
		$SDSQL = '';
	}
	
}



 ?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<select name="select1" id="select1">
<option value="0" <?php if (!(strcmp(0, $G_selected1))) {echo "selected=\"selected\"";} ?>>ALL</option>

<?php
do {  
?>
<option value="<?php echo $row_RecinternationalT['term_id']?>"<?php if (!(strcmp($row_RecinternationalT['term_id'], $G_selected1))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecinternationalT['name']?><?php //echo $row_RecinternationalT['term_id']?></option>
<?php
} while ($row_RecinternationalT = mysql_fetch_assoc($RecinternationalT));
  $rows = mysql_num_rows($RecinternationalT);
  if($rows > 0) {
      mysql_data_seek($RecinternationalT, 0);
	  $row_RecinternationalT = mysql_fetch_assoc($RecinternationalT);
  }
?>
</select>

</body>
</html>