<?php require_once('../Connections/connect2data.php'); ?><?php require_once('../sstart.php'); ?>

<?php $editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
 $menu_is="authority";?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>無標題文件</title>

<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->


<!-- InstanceEndEditable -->
<?php require_once('head.php');?>
<?php require_once('web_count.php');?>
</head>
<body>
<table width="1280" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td rowspan="2" align="left">
          <?php require_once('cmsHeader.php'); ?>
        </td>
        <td width="100" align="right" valign="middle">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="5" align="left"><span class="color_white"><a href="<?php echo $logoutAction ?>">&nbsp;&nbsp;<img src="image/logout.gif" width="48" height="16" /></a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td align="left" class="color_white">&nbsp;</td>
              <td>&nbsp;</td>
              <td align="left" class="color_white">&nbsp;</td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td colspan="5" align="left" class="table_data">&nbsp;&nbsp;<a href="../index.php" target="_blank">觀看首頁</a></td>
              </tr>
            </table>
        </td>
      </tr>
    </table>
<?php require_once('top.php'); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><!-- InstanceBeginEditable name="編輯區域" -->
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
mysql_select_db($database_connect2data, $connect2data);
$query_RecLevel = "SELECT * FROM a_set ORDER BY a_id ASC";
$RecLevel = mysql_query($query_RecLevel, $connect2data) or die(mysql_error());
$row_RecLevel = mysql_fetch_assoc($RecLevel);
$totalRows_RecLevel = mysql_num_rows($RecLevel);
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="300" class="list_title">新增管理員</td>
            <td width="724">&nbsp;</td>
        </tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><img src="image/spacer.gif" width="1" height="1"></td>
        </tr>
    </table>
    <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
   			<td><table width="100%" border="0" cellspacing="3" cellpadding="5">
            	<tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">管理員帳號</td>
          	    	<td width="532"><input name="user_name" type="text" class="table_data" id="user_name" value="" size="50" /></td>
          	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">管理員密碼</td>
          	    	<td width="532"><input name="user_password" type="password" class="table_data" id="user_password" value="" size="50" /></td>
          	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">管理種類</td>
          	    	<td width="532"><label>
          	    	  <select name="user_level" class="table_data" id="user_level">
          	    	    <?php
do {  
?>
          	    	    <option value="<?php echo $row_RecLevel['a_id']?>"><?php echo $row_RecLevel['a_title']?></option>
          	    	    <?php
} while ($row_RecLevel = mysql_fetch_assoc($RecLevel));
  $rows = mysql_num_rows($RecLevel);
  if($rows > 0) {
      mysql_data_seek($RecLevel, 0);
	  $row_RecLevel = mysql_fetch_assoc($RecLevel);
  }
?>
        	    	    </select>
          	    	</label></td>
          	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">帳號是否有效</td>
          	    	<td width="532"><label>
          	        <select name="user_active" class="table_data" id="user_active">
          	          <option value="1">有效</option>
          	          <option value="0">無效</option>
       	            </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
			</table>
            </td>
		</tr>
        <tr>
        	<td>&nbsp;</td>
        </tr>
        <tr>
         	<td align="center"><input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" /></td>
        </tr>
	</table>
    <input type="hidden" name="MM_insert" value="form1" />
    </form>
    <table width="100%" height="1" border="0" align="center" cellpadding="0" cellspacing="0" class="buttom_dot_line">
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
	<!-- InstanceEndEditable --></td>
  </tr>
</table></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>

<?php
mysql_free_result($RecLevel);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
 
  $insertSQL = sprintf("INSERT INTO admin (user_name, user_password, user_level, user_active) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['user_name'], "text"),
                       GetSQLValueString($_POST['user_password'], "text"),
					   GetSQLValueString($_POST['user_level'], "int"),
                       GetSQLValueString($_POST['user_active'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
	
  $insertGoTo = "authority_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  
  if($image_result[0][0]==1 || $file_type_wrong==1)
  {	
  		echo "<script type=\"text/javascript\">call_alert('".$insertGoTo."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $insertGoTo));
  }
  
}
?>

