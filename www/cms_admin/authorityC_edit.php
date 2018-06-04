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

$colname_RecAuthorityC = "-1";
if (isset($_GET['a_id'])) {
  $colname_RecAuthorityC = $_GET['a_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecAuthorityC = sprintf("SELECT * FROM a_set WHERE a_id = %s", GetSQLValueString($colname_RecAuthorityC, "int"));
$RecAuthorityC = mysql_query($query_RecAuthorityC, $connect2data) or die(mysql_error());
$row_RecAuthorityC = mysql_fetch_assoc($RecAuthorityC);
$totalRows_RecAuthorityC = mysql_num_rows($RecAuthorityC);

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
            <td width="300" class="list_title">修改權限種類</td>
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
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">種類名稱</td>
          	    	<td width="532"><input name="a_title" type="text" class="table_data" id="a_title" value="<?php echo $row_RecAuthorityC['a_title']; ?>" size="50" />
          	    	  <input name="a_id" type="hidden" id="a_id" value="<?php echo $row_RecAuthorityC['a_id']; ?>" /></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">權限管理</td>
                  <td width="532"><label>
          	        <select name="a_1" class="table_data" id="a_1" title="<?php echo $row_RecAuthorityC['a_1']; ?>">
          	          <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC['a_1']))) {echo "selected=\"selected\"";} ?>>允許</option>
<option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC['a_1']))) {echo "selected=\"selected\"";} ?>>不允許</option>
       	            </select>
          	    	</label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
               
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">首頁banner</td>
                  <td><select name="a_2" class="table_data" id="a_2" title="<?php echo $row_RecAuthorityC['a_1']; ?>">
                    <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC['a_2']))) {echo "selected=\"selected\"";} ?>>允許</option>
                    <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC['a_2']))) {echo "selected=\"selected\"";} ?>>不允許</option>
                  </select></td>
                  <td bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
                
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Approach</td>
                  <td width="532"><label>
                    <select name="a_3" class="table_data" id="a_3">
                      <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC['a_3']))) {echo "selected=\"selected\"";} ?>>允許</option>
                      <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC['a_3']))) {echo "selected=\"selected\"";} ?>>不允許</option>
                    </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Projects</td>
                  <td width="532"><label>
                    <select name="a_4" class="table_data" id="a_4">
                      <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC['a_4']))) {echo "selected=\"selected\"";} ?>>允許</option>
                      <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC['a_4']))) {echo "selected=\"selected\"";} ?>>不允許</option>
                    </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Journal</td>
                  <td width="532"><label>
                    <select name="a_5" class="table_data" id="a_5">
                      <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC['a_5']))) {echo "selected=\"selected\"";} ?>>允許</option>
                      <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC['a_5']))) {echo "selected=\"selected\"";} ?>>不允許</option>
                    </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr> 
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Brand School</td>
                  <td width="532"><label>
                    <select name="a_6" class="table_data" id="a_6">
                      <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC['a_6']))) {echo "selected=\"selected\"";} ?>>允許</option>
                      <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC['a_6']))) {echo "selected=\"selected\"";} ?>>不允許</option>
                    </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Contact Us</td>
                  <td width="532"><label>
                    <select name="a_7" class="table_data" id="a_7">
                      <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC['a_7']))) {echo "selected=\"selected\"";} ?>>允許</option>
                      <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC['a_7']))) {echo "selected=\"selected\"";} ?>>不允許</option>
                    </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Year</td>
                  <td width="532"><label>
                    <select name="a_8" class="table_data" id="a_8">
                      <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC['a_8']))) {echo "selected=\"selected\"";} ?>>允許</option>
                      <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC['a_8']))) {echo "selected=\"selected\"";} ?>>不允許</option>
                    </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Footer</td>
                  <td width="532"><label>
                    <select name="a_9" class="table_data" id="a_9">
                      <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC['a_9']))) {echo "selected=\"selected\"";} ?>>允許</option>
                      <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC['a_9']))) {echo "selected=\"selected\"";} ?>>不允許</option>
                    </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">keywords</td>
                  <td width="532"><label>
                    <select name="a_10" class="table_data" id="a_10">
                      <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC['a_10']))) {echo "selected=\"selected\"";} ?>>允許</option>
                      <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC['a_10']))) {echo "selected=\"selected\"";} ?>>不允許</option>
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
  $updateSQL = sprintf("UPDATE a_set SET a_title=%s, a_1=%s, a_2=%s, a_3=%s, a_4=%s, a_5=%s, a_6=%s, a_7=%s, a_8=%s, a_9=%s, a_10=%s, a_11=%s, a_12=%s, a_13=%s, a_14=%s, a_15=%s, a_16=%s WHERE a_id=%s",
                       GetSQLValueString($_POST['a_title'], "text"),
                       GetSQLValueString($_POST['a_1'], "int"),
                       GetSQLValueString($_POST['a_2'], "int"),
                       GetSQLValueString($_POST['a_3'], "int"),
                       GetSQLValueString($_POST['a_4'], "int"),
                       GetSQLValueString($_POST['a_5'], "int"),
                       GetSQLValueString($_POST['a_6'], "int"),
                       GetSQLValueString($_POST['a_7'], "int"),
                       GetSQLValueString($_POST['a_8'], "int"),
                       GetSQLValueString($_POST['a_9'], "int"),
                       GetSQLValueString($_POST['a_10'], "int"),
                       GetSQLValueString($_POST['a_11'], "int"),
                       GetSQLValueString($_POST['a_12'], "int"),
                       GetSQLValueString($_POST['a_13'], "int"),
                       GetSQLValueString($_POST['a_14'], "int"),
                       GetSQLValueString($_POST['a_15'], "int"),
                       GetSQLValueString($_POST['a_16'], "int"),
                       GetSQLValueString($_POST['a_id'], "int"));
					   //echo $updateSQL;

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

  $updateGoTo = "authorityC_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum_RecAuthorityC=".$_SESSION["ToPage"];
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
mysql_free_result($RecAuthorityC);
?>
