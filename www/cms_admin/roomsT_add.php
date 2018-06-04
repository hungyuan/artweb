<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process.php'); ?>
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

$menu_is="rooms";?>
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
            <td width="30%" class="list_title">新增分類</td>
            <td width="70%">&nbsp;</td>
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
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">分類名稱</td>
          	    	<td><input name="name" type="text" class="table_data" id="name" size="50">
          	    	  <input name="c_parent" type="hidden" id="c_parent" value="roomsT" /></td>
        	    	<td width="250" bgcolor="#e5ecf6">&nbsp;</td>
      	    	</tr>
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳封面</p>                    </td>
                    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTableIndex">
                      <tr>
                        <td> <span class="table_data">選擇圖片：</span>
                          <input name="indexImage[]" type="file" class="table_data" id="indexImage1" />
                          <br>
                          <span class="table_data">圖片說明：</span>
                          <input name="indexImage_title[]" type="text" class="table_data" id="indexImage_title1">
                            <!-- <div class="marginTop1">
                                                      <span class="table_data">寬度格式：</span>
                                                      <label>
                            <select name="file_width" class="table_data" id="file_width">
                              <option value="1">1個單位</option>
                              <option value="2">2個單位</option>
                              <option value="3">3個單位</option>
                            </select>
                                                      </label>
                                                      </div> -->
                          <!-- <div class="marginTop1">
                          <span class="table_data">長度格式：</span>
                          <label>
                            <select name="file_height" class="table_data" id="file_height">
                              <option value="1">1個單位</option>
                              <option value="2">2個單位</option>
                              <option value="3">3個單位</option>
                            </select>
                          </label>
                          </div> -->
                              </td>
                      </tr>
                    </table>

                              </td>
                    <td bgcolor="#e5ecf6" class="table_col_title">
                    <p class="red_letter">*<?php echo $imagesSize['roomsTCover']['note'];?></p></td>
                </tr>
                <tr>
                	<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">狀態</td>
          	    	<td width="532"><label>
          	        <select name="term_active" class="table_data" id="term_active">
          	        	<option value="1">公佈</option>
          	        	<option value="0">不公佈</option>
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

  $slug = urlencode($_POST['name']);

  $insertSQL = sprintf("INSERT INTO terms (name, slug, term_active) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($slug, "text"),
                       GetSQLValueString($_POST['term_active'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

	/*$sql_max_data= "Select MAX(term_id) From terms";//找到term_id的最大值
			//echo $sql_max_data;
			$result_max_data=mysql_query($sql_max_data);

			if($row_max_data = mysql_fetch_array($result_max_data))
			{

				$new_data_num=$row_max_data[0];

				//echo $row_max_data[0];
			}*/
	$new_data_num = mysql_insert_id();

	$insertSQL = sprintf("INSERT INTO term_taxonomy (term_id, taxonomy) VALUES (%s, %s)",
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString('rooms', "text"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

   //----------插入首頁圖片資料到資料庫begin(須放入插入主資料後)----------

    switch ($file_show_type) {
      case '1':
        $format = 'roomsCover1';
        break;
      case '2':
        $format = 'roomsCover2';
        break;
      case '3':
        $format = 'roomsCover3';
        break;
      default:
        $format = 'roomsCover1';
    }

  $image_result=image_process($_FILES['indexImage'], $_REQUEST['indexImage_title'], "roomsTCover","add", $imagesSize['roomsTCover']['IW'], $imagesSize['roomsTCover']['IH']);
    //echo count($image_result);
    //echo $image_result[0][0];

    for($j=1;$j<count($image_result);$j++)
    {
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type, file_width, file_height) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("roomsTCover", "text"),
                       GetSQLValueString($new_data_num, "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($file_show_type, "int"),
                       GetSQLValueString($file_width, "int"),
                       GetSQLValueString($file_height, "int"));

          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
        $_SESSION["change_image"]=1;
    }



  //----------插入首頁圖片資料到資料庫end----------


  $insertGoTo = "roomsT_list.php?pageNum=0&totalRows_RecroomsT=".($_SESSION['totalRows']+1)."&changeSort=1&now_term_id=".$new_data_num."&change_num=1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }


  header(sprintf("Location: %s", $insertGoTo));


}
?>

