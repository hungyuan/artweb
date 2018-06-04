<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('file_process.php'); ?>
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

//echo $_SESSION['nowMenu'].'<br>';
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE file_set SET file_title=%s WHERE file_id=%s",
   GetSQLValueString($_POST['file_title'], "text"),
   GetSQLValueString($_POST['file_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

      //----------插入檔案資料到資料庫begin(須放入插入主資料後)----------
   			//echo file_process();


  $file_result=file_process($_SESSION['nowMenu'],"edit");

		//echo count($file_result);

		//刪除真實檔案begin----
  if(count($file_result)==1)
  {
   $sql="SELECT file_link1 FROM file_set WHERE file_id='".$_POST['file_id']."'";
   $result = mysql_query($sql)or die("無法送出".mysql_error( ));
   while ( $row = mysql_fetch_array($result))
   {
						//echo $file_result[0][1]."<br>";
						//echo $row[0]."<BR>";
    if($file_result[0][1]==$row[0])
    {}
  else
  {
   if (file_exists("../".$row[0])) {
								unlink("../".$row[0]);//刪除檔案
							}
						}
					}

        }
		//刪除真實檔案end----

        for($j=0;$j<count($file_result);$j++)
        {
         $insertSQL = sprintf("UPDATE file_set SET file_name=%s, file_link1=%s WHERE file_id=%s" ,
           GetSQLValueString($file_result[$j][0], "text"),
           GetSQLValueString($file_result[$j][1], "text"),
           GetSQLValueString($_POST['file_id'], "int"));

         mysql_select_db($database_connect2data, $connect2data);
         $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
       }



	//----------插入檔案資料到資料庫end----------

 /* $updateGoTo = "news_edit.php?d_id=" . $row_RecFile['file_d_id'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/

  //echo $row_RecFile['d_id'];
  $updateGoTo = $_SESSION['nowPage']."?d_id=" . $_POST['file_d_id'] . "";

  header(sprintf("Location: %s", $updateGoTo));


}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}



$colname_RecFile = "-1";
if (isset($_GET['file_id'])) {
  $colname_RecFile = $_GET['file_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecFile = sprintf("SELECT * FROM file_set WHERE file_id = %s", GetSQLValueString($colname_RecFile, "int"));
$RecFile = mysql_query($query_RecFile, $connect2data) or die(mysql_error());
$row_RecFile = mysql_fetch_assoc($RecFile);
$totalRows_RecFile = mysql_num_rows($RecFile);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>修改圖片</title>
  <script type="text/javascript" src="jquery/jquery-1.6.4.min.js"></script>
  <script type="text/javascript">

    $(document).ready(function() {

     $(".btnType").hover(function(){
      $(this).addClass('btnTypeClass');
      $(this).css('cursor', 'pointer');
    }, function(){
      $(this).removeClass('btnTypeClass');
    });

   });

 </script>
</head>
<body>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="30%" class="list_title">修改檔案</td>
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
             <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">檔案說明</td>
             <td width="532">
              <input name="file_title" type="text" class="table_data" id="file_title" value="<?php echo $row_RecFile['file_title']; ?>" size="50">
              <input name="file_id" type="hidden" id="file_id" value="<?php echo $row_RecFile['file_id']; ?>" />
              <input name="file_d_id" type="hidden" id="file_d_id" value="<?php echo $row_RecFile['file_d_id']; ?>" /></td>
              <td width="250" bgcolor="#e5ecf6">
                <ul class="red_letter">
                  <li>請寫檔案說明，網頁才會顯示檔案。</li>
                </ul>
              </td>
            </tr>
            <tr>
             <td align="center" bgcolor="#e5ecf6" class="table_col_title">檔案名稱</td>
             <td class="table_col_title">&nbsp;<?php echo $row_RecFile['file_name']; ?></td>
             <td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p></td>
           </tr>
           <tr>
            <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>更改檔案</p>
            </td>
            <td><input name="upfile[]" type="file" class="table_data" id="upfile[]" size="50" ></td>
            <td bgcolor="#e5ecf6" class="table_col_title">
              <ul class="red_letter">
                <li>每次上傳之檔案大小總計請勿超過<?php echo ini_get("upload_max_filesize"); ?>。</li>
              </ul>
            </td>
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
</body>
</html>
<?php
mysql_free_result($RecFile);
?>
