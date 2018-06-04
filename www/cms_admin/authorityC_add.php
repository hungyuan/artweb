<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
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
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="300" class="list_title">新增權限種類</td>
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
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">種類名稱</td>
          	    	<td width="532"><input name="a_title" type="text" class="table_data" id="a_title" value="" size="50" /></td>
          	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">權限管理</td>
          	    	<td width="532"><label>
          	        <select name="a_1" class="table_data" id="a_1">
          	          <option value="1">允許</option>
          	          <option value="0">不允許</option>
       	            </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
               
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">首頁banner</td>
                  <td><select name="a_2" class="table_data" id="a_2">
                    <option value="1">允許</option>
                    <option value="0">不允許</option>
                  </select></td>
                  <td bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
               
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Approach</td>
          	    	<td width="532"><label>
          	        <select name="a_3" class="table_data" id="a_3">
          	          <option value="1">允許</option>
          	          <option value="0">不允許</option>
       	            </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Projects</td>
          	    	<td width="532"><label>
          	        <select name="a_4" class="table_data" id="a_4">
          	          <option value="1">允許</option>
          	          <option value="0">不允許</option>
       	            </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Journal</td>
          	    	<td width="532"><label>
          	        <select name="a_5" class="table_data" id="a_5">
          	          <option value="1">允許</option>
          	          <option value="0">不允許</option>
       	            </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Brand School</td>
          	    	<td width="532"><label>
          	        <select name="a_6" class="table_data" id="a_6">
          	          <option value="1">允許</option>
          	          <option value="0">不允許</option>
       	            </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Contact Us</td>
          	    	<td width="532"><label>
          	        <select name="a_7" class="table_data" id="a_7">
          	          <option value="1">允許</option>
          	          <option value="0">不允許</option>
       	            </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Year</td>
          	    	<td width="532"><label>
          	        <select name="a_8" class="table_data" id="a_8">
          	          <option value="1">允許</option>
          	          <option value="0">不允許</option>
       	            </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Footer</td>
          	    	<td width="532"><label>
          	        <select name="a_9" class="table_data" id="a_9">
          	          <option value="1">允許</option>
          	          <option value="0">不允許</option>
       	            </select></label></td>
          	     	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">keywords</td>
          	    	<td width="532"><label>
          	        <select name="a_10" class="table_data" id="a_10">
          	          <option value="1">允許</option>
          	          <option value="0">不允許</option>
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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
 
  $insertSQL = sprintf("INSERT INTO a_set (a_title, a_1, a_2, a_3, a_4, a_5, a_6, a_7, a_8, a_9, a_10, a_11, a_12, a_13, a_14, a_15, a_16) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
                       GetSQLValueString($_POST['a_16'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
	
  $insertGoTo = "authorityC_list.php";
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

