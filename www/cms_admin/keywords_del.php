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

$colname_Reckeywords = "-1";
if (isset($_GET['d_id'])) {
  $colname_Reckeywords = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_Reckeywords = sprintf("SELECT * FROM data_set WHERE d_id = %s", GetSQLValueString($colname_Reckeywords, "int"));
$Reckeywords = mysql_query($query_Reckeywords, $connect2data) or die(mysql_error());
$row_Reckeywords = mysql_fetch_assoc($Reckeywords);
$totalRows = mysql_num_rows($Reckeywords);

$colname_RecImage = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecImage = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image'" , GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

mysql_select_db($database_connect2data, $connect2data);
$query_RecCover = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'keywordsCover'" , GetSQLValueString($colname_RecImage, "int"));
$RecCover = mysql_query($query_RecCover, $connect2data) or die(mysql_error());
$row_RecCover = mysql_fetch_assoc($RecCover);
$totalRows_RecCover = mysql_num_rows($RecCover);

$colname_RecFile = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecFile = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecFile = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'file'", GetSQLValueString($colname_RecFile, "int"));
$RecFile = mysql_query($query_RecFile, $connect2data) or die(mysql_error());
$row_RecFile = mysql_fetch_assoc($RecFile);
$totalRows_RecFile = mysql_num_rows($RecFile);

$menu_is="keywords";?>
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
              <td width="30%" class="list_title">刪除</td>
              <td width="70%"><span class="no_data">您確定要刪除這筆資料?</span></td>
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
                     <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
                     <td width="532" class="table_data"><?php echo $row_Reckeywords['d_title']; ?>
                      <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_Reckeywords['d_id']; ?>" />
                      <input name="delsure" type="hidden" id="delsure" value="1" /></td>
                      <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                    </tr>

                    <tr>
                     <td align="center" bgcolor="#e5ecf6" class="table_col_title">內容</td>
                     <td class="table_data"><?php echo $row_Reckeywords['d_content']; ?></td>
                     <td bgcolor="#e5ecf6">&nbsp;</td>
                   </tr>
                   <tr>
                     <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">日期</td>
                     <td width="532" class="table_data"><?php echo $row_Reckeywords['d_date']; ?></td>
                     <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                   </tr>

                   <tr>
                     <?php if ($totalRows_RecCover > 0) { // Show if recordset not empty ?>
                       <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前封面圖片</td>
                       <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                         <tr>
                           <td><?php do { ?>
                             <table width="100%" border="0" cellspacing="0" cellpadding="0">
                               <tr>
                                 <td width="100" rowspan="2" align="center"><img src="../<?php echo $row_RecCover['file_link2']; ?>" alt="" class="image_frame" /></td>
                                 <td align="left" class="table_data">&nbsp;圖片說明：<?php echo $row_RecCover['file_title']; ?></td>
                               </tr>
                               <tr>
                                 <td align="left" class="table_data">&nbsp;</td>
                               </tr>
                               <tr>
                                 <td align="center">&nbsp;</td>
                                 <td align="center">&nbsp;</td>
                               </tr>
                             </table>
                             <?php } while ($row_RecCover = mysql_fetch_assoc($RecCover)); ?></td>
                           </tr>
                         </table></td>
                         <td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p></td>
                         <?php } // Show if recordset not empty ?>
                       </tr>

                       <tr>
                        <?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>
                          <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前圖片</td>
                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><?php do { ?>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="100" rowspan="2" align="center"><img src="../<?php echo $row_RecImage['file_link2']; ?>" alt="" class="image_frame" /></td>
                                    <td align="left" class="table_data">&nbsp;圖片說明：<?php echo $row_RecImage['file_title']; ?></td>
                                  </tr>
                                  <tr>
                                    <td align="left" class="table_data">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                  </tr>
                                </table>
                                <?php } while ($row_RecImage = mysql_fetch_assoc($RecImage)); ?></td>
                              </tr>
                            </table></td>
                            <td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p></td>
                            <?php } // Show if recordset not empty ?>
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
    if ((isset($_REQUEST['d_id'])) && ($_REQUEST['d_id'] != "") && (isset($_REQUEST['delsure']))) {

		//----------刪除圖片資料到資料庫begin(在主資料前)-----

     $sql="SELECT * FROM file_set WHERE file_type='image' AND file_d_id='".$_POST['d_id']."'";
     $result = mysql_query($sql)or die("無法送出".mysql_error( ));
     while ( $row = mysql_fetch_array($result))
     {
       if ( (isset($row['file_link1'])) && file_exists("../".$row['file_link1']) ) {
				unlink("../".$row['file_link1']);//刪除檔案
			}
			if ( (isset($row['file_link2'])) && file_exists("../".$row['file_link2'])) {
				unlink("../".$row['file_link2']);//刪除檔案
			}
			if ( (isset($row['file_link3'])) && file_exists("../".$row['file_link3'])) {
				unlink("../".$row['file_link3']);//刪除檔案
			}
			if ( (isset($row['file_link4'])) && file_exists("../".$row['file_link4'])) {
				unlink("../".$row['file_link4']);//刪除檔案
			}
			if ( (isset($row['file_link5'])) && file_exists("../".$row['file_link5'])) {
				unlink("../".$row['file_link5']);//刪除檔案
			}
		}

   $deleteSQL = sprintf("DELETE FROM file_set WHERE file_type='image' AND file_d_id=%s",
     GetSQLValueString($_REQUEST['d_id'], "int"));

   mysql_select_db($database_connect2data, $connect2data);
   $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

	  //----------刪除圖片資料到資料庫end(在主資料前)-----
   //----------刪除圖片資料到資料庫begin(在主資料前)-----

   $sql="SELECT * FROM file_set WHERE file_type='keywordsMobile' AND file_d_id='".$_POST['d_id']."'";
   $result = mysql_query($sql)or die("無法送出".mysql_error( ));
   while ( $row = mysql_fetch_array($result))
   {
     if ( (isset($row['file_link1'])) && file_exists("../".$row['file_link1']) ) {
        unlink("../".$row['file_link1']);//刪除檔案
      }
      if ( (isset($row['file_link2'])) && file_exists("../".$row['file_link2'])) {
        unlink("../".$row['file_link2']);//刪除檔案
      }
      if ( (isset($row['file_link3'])) && file_exists("../".$row['file_link3'])) {
        unlink("../".$row['file_link3']);//刪除檔案
      }
      if ( (isset($row['file_link4'])) && file_exists("../".$row['file_link4'])) {
        unlink("../".$row['file_link4']);//刪除檔案
      }
      if ( (isset($row['file_link5'])) && file_exists("../".$row['file_link5'])) {
        unlink("../".$row['file_link5']);//刪除檔案
      }
    }

    $deleteSQL = sprintf("DELETE FROM file_set WHERE file_type='keywordsMobile' AND file_d_id=%s",
     GetSQLValueString($_REQUEST['d_id'], "int"));

    mysql_select_db($database_connect2data, $connect2data);
    $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

    //----------刪除圖片資料到資料庫end(在主資料前)-----
	  //----------刪除檔案資料到資料庫begin(在主資料前)-----
    $sql="SELECT file_link1 FROM file_set WHERE file_type='file' AND file_d_id='".$_POST['d_id']."'";
    $result = mysql_query($sql)or die("無法送出".mysql_error( ));
    while ( $row = mysql_fetch_array($result))
    {
     unlink("../".$row[0]);
   }

   $deleteSQL = sprintf("DELETE FROM file_set WHERE file_type='file' AND file_d_id=%s",
     GetSQLValueString($_REQUEST['d_id'], "int"));

   mysql_select_db($database_connect2data, $connect2data);
   $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

	  //echo $_REQUEST['d_id'];
	  //----------刪除檔案資料到資料庫begin(在主資料前)
   $deleteSQL = sprintf("DELETE FROM data_set WHERE d_id=%s",
     GetSQLValueString($_REQUEST['d_id'], "int"));

   mysql_select_db($database_connect2data, $connect2data);
   $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());

   $deleteGoTo = "keywords_list.php?delchangeSort=1";
   if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING']."&pageNum=".$_SESSION["ToPage"];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
<?php
mysql_free_result($Reckeywords);

mysql_free_result($RecImage);
?>
