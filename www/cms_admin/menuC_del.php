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

if(!1){
	header("Location: menuC_list.php");
}

$colname_RecmenuC = "-1";
if (isset($_GET['c_id'])) {
  $colname_RecmenuC = $_GET['c_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecmenuC = sprintf("SELECT * FROM class_set WHERE c_id = %s", GetSQLValueString($colname_RecmenuC, "int"));
$RecmenuC = mysql_query($query_RecmenuC, $connect2data) or die(mysql_error());
$row_RecmenuC = mysql_fetch_assoc($RecmenuC);
$totalRows_RecmenuC = mysql_num_rows($RecmenuC);

$menu_is="menu";?>
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
            <?php require_once('cmsHeader.php');?>
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
              <td width="30%" class="list_title">刪除</td>
              <td width="70%"><span class="no_data">確定刪除以下內容?</span></td>
            </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><img src="image/spacer.gif" width="1" height="1"></td>
            </tr>
          </table>
          <form action="" method="POST" enctype="multipart/form-data" name="form1" id="form1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>
                  <table width="100%" border="0" cellspacing="3" cellpadding="5">
                   <tr>
                     <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">名稱</td>
                     <td width="532" class="table_data"><?php echo $row_RecmenuC['c_title']; ?>
                      <input name="c_id" type="hidden" id="c_id" value="<?php echo $row_RecmenuC['c_id']; ?>" />
                      <input name="delsure" type="hidden" id="delsure" value="1" /></td>
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
if ((isset($_REQUEST['c_id'])) && ($_REQUEST['c_id'] != "") && (isset($_REQUEST['delsure']))) {

      //----------刪除圖片資料到資料庫begin(在主資料前)-----
   $sql="SELECT file_link1 FROM file_set WHERE file_type='image' AND file_d_id='".$_REQUEST['c_id']."'";
   $result = mysql_query($sql)or die("無法送出".mysql_error( ));
   while ( $row = mysql_fetch_array($result))
   {
        //echo "../".$row[0]."<BR>";
     if ( (isset($row[0])) && file_exists("../".$row[0]) ) {
          unlink("../".$row[0]);//刪除檔案
        }
      }

      $sql="SELECT file_link2 FROM file_set WHERE file_type='image' AND file_d_id='".$_REQUEST['c_id']."'";
      $result = mysql_query($sql)or die("無法送出".mysql_error( ));
      while ( $row = mysql_fetch_array($result))
      {
        //echo "../".$row[0]."<BR>";
        if ( (isset($row[0])) && file_exists("../".$row[0]) ) {
          unlink("../".$row[0]);//刪除檔案
        }
      }

      $sql="SELECT file_link3 FROM file_set WHERE file_type='image' AND file_d_id='".$_REQUEST['c_id']."'";
      $result = mysql_query($sql)or die("無法送出".mysql_error( ));
      while ( $row = mysql_fetch_array($result))
      {
        //echo "../".$row[0]."<BR>";
        if ( (isset($row[0])) && file_exists("../".$row[0]) ) {
          unlink("../".$row[0]);//刪除檔案
        }
      }

      $sql="SELECT file_link4 FROM file_set WHERE file_type='image' AND file_d_id='".$_REQUEST['c_id']."'";
      $result = mysql_query($sql)or die("無法送出".mysql_error( ));
      while ( $row = mysql_fetch_array($result))
      {
        //echo "../".$row[0]."<BR>";
        if ( (isset($row[0])) && file_exists("../".$row[0]) ) {
          unlink("../".$row[0]);//刪除檔案
        }
      }

     $deleteSQL = sprintf("DELETE FROM file_set WHERE file_type='image' AND file_d_id=%s",
       GetSQLValueString($_REQUEST['c_id'], "int"));

     mysql_select_db($database_connect2data, $connect2data);
     $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

      //----------刪除圖片資料到資料庫end(在主資料前)-----


 $deleteSQL = sprintf("DELETE FROM class_set WHERE c_id=%s",
   GetSQLValueString($_REQUEST['c_id'], "int"));

 mysql_select_db($database_connect2data, $connect2data);
 $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

 $deleteGoTo = "menuC_list.php?delchangeSort=1";

 if (isset($_SERVER['QUERY_STRING'])) {
  $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
  $deleteGoTo .= $_SERVER['QUERY_STRING']."&pageNum=".$_SESSION["ToPage"];
}
header(sprintf("Location: %s", $deleteGoTo));
}
?>
<?php
mysql_free_result($RecmenuC);
?>
