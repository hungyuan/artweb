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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_RecAuthority = "-1";
if (isset($_GET['user_id'])) {
  $colname_RecAuthority = $_GET['user_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecAuthority = sprintf("SELECT * FROM `admin` WHERE user_id = %s", GetSQLValueString($colname_RecAuthority, "int"));
$RecAuthority = mysql_query($query_RecAuthority, $connect2data) or die(mysql_error());
$row_RecAuthority = mysql_fetch_assoc($RecAuthority);
$totalRows_RecAuthority = mysql_num_rows($RecAuthority);

mysql_select_db($database_connect2data, $connect2data);
$query_RecLevel = "SELECT * FROM a_set ORDER BY a_id ASC";
$RecLevel = mysql_query($query_RecLevel, $connect2data) or die(mysql_error());
$row_RecLevel = mysql_fetch_assoc($RecLevel);
$totalRows_RecLevel = mysql_num_rows($RecLevel);

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
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="300" class="list_title">修改管理員</td>
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
   			<td>
            <table width="100%" border="0" cellspacing="3" cellpadding="5">
            	<tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">管理員帳號</td>
          	    	<td width="532"><input name="user_name" type="text" class="table_data" id="user_name" value="<?php echo $row_RecAuthority['user_name']; ?>" size="50" />
          	    	  <input name="user_id" type="hidden" id="user_id" value="<?php echo $row_RecAuthority['user_id']; ?>" /></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">管理員密碼</td>
          	    	<td width="532"><input name="user_password" type="password" class="table_data" id="user_password" value="<?php echo $row_RecAuthority['user_password']; ?>" size="50" /></td>
          	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr><tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">管理種類</td>
          	    	<td width="532"><label>
          	    	  <select name="user_level" class="table_data" id="user_level">
          	    	    <?php
do {  
?>
          	    	    <option value="<?php echo $row_RecLevel['a_id']?>"<?php if (!(strcmp($row_RecLevel['a_id'], $row_RecAuthority['user_level']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecLevel['a_title']?></option>
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
          	          <option value="1" <?php if (!(strcmp(1, $row_RecAuthority['user_active']))) {echo "selected=\"selected\"";} ?>>有效</option>
          	          <option value="0" <?php if (!(strcmp(0, $row_RecAuthority['user_active']))) {echo "selected=\"selected\"";} ?>>無效</option>
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
    <input type="hidden" name="MM_update" value="form1" />
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
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE admin SET user_name=%s, user_password=%s, user_level=%s, user_active=%s WHERE user_id=%s",
                       GetSQLValueString($_POST['user_name'], "text"),
					   GetSQLValueString($_POST['user_password'], "text"),
                       GetSQLValueString($_POST['user_level'], "int"),
                       GetSQLValueString($_POST['user_active'], "int"),
                       GetSQLValueString($_POST['user_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

  $updateGoTo = "authority_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum_RecAuthority=".$_SESSION["ToPage"];
  }
  
  
  if($image_result[0][0]==1 || $file_type_wrong==1)
  {
		echo "<script type=\"text/javascript\">call_alert('".$updateGoTo."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $updateGoTo));
  }
}
?>
<?php
mysql_free_result($RecAuthority);

mysql_free_result($RecLevel);
?>
