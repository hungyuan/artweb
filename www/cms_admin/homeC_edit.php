<?php require_once('../sstart.php'); ?><?php require_once('../sstart.php'); ?>
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

if(!1){
	header("Location: homeC_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


$colname_RechomeC = "-1";
if (isset($_GET['c_id'])) {
  $colname_RechomeC = $_GET['c_id'];
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'homeC'", GetSQLValueString($colname_RechomeC, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

mysql_select_db($database_connect2data, $connect2data);
$query_RecImageMobile = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'homeC_mobile'", GetSQLValueString($colname_RechomeC, "int"));
$RecImageMobile = mysql_query($query_RecImageMobile, $connect2data) or die(mysql_error());
$row_RecImageMobile = mysql_fetch_assoc($RecImageMobile);
$totalRows_RecImageMobile = mysql_num_rows($RecImageMobile);

mysql_select_db($database_connect2data, $connect2data);
$query_RechomeC = sprintf("SELECT * FROM class_set WHERE c_id = %s", GetSQLValueString($colname_RechomeC, "int"));
$RechomeC = mysql_query($query_RechomeC, $connect2data) or die(mysql_error());
$row_RechomeC = mysql_fetch_assoc($RechomeC);
$totalRows_RechomeC = mysql_num_rows($RechomeC);

$menu_is="home";
$_SESSION['nowPage']=$selfPage;
$_SESSION['nowMenu']= $menu_is;

?>
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
    <script type="text/javascript" src="jquery/fancyapps/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <script type="text/javascript" src="jquery/fancyapps/source/jquery.fancybox.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery/fancyapps/source/jquery.fancybox.css" media="screen" />
    <script type="text/javascript">
      <!--
      function updateData(){
      //var content = $("#content").val().replace(/&/g, escape("&"));
      var d_id = $('#d_id').val();
      $.ajax({
        type: "POST",
        url: "data_save.php",
        data: $('#form1').serializeArray(),
        success: function(data){
              //nothing
              //alert(data);
            }
         });
    }
    $(document).ready(function() {

     $("a[rel=group]").fancybox({
       autoSize : true,
       openEffect : 'elastic',
       closeEffect  : 'elastic',
       helpers : {
        overlay : {
         css : {
          'background' : 'rgba(0, 0, 0, 0.7)'
        }
      }
    }
  });
     $("a.fancyboxEdit").fancybox({
      type: 'ajax',
      openEffect  : 'fade',
      closeEffect : 'fade',
      autoSize  : true,
      helpers : {
       overlay : {
        css : {
         'background' : 'rgba(0, 0, 0, 0.7)'
       }
     }
   },
   beforeShow : function() {
     updateData();
   }
  });

   });
    <?php
    if( isset($_SESSION["change_image"]) && ($_SESSION["change_image"]==1) )
    {
      $_SESSION["change_image"]=0;
      echo "window.location.reload();";
    }
    ?>

    function call_alert(link_url) {

     alert("上傳得檔案中，有的不是圖片!");
     window.location=link_url;

   }

   function addField() {
     var pTable=document.getElementById('pTable');
     var lastRow = pTable.rows.length;
        //alert(pTable.rows.length);
        var myField=document.getElementById('image'+lastRow);
        //alert('image'+lastRow);
        if(myField.value){
          var aTr=pTable.insertRow(lastRow);
          var newRow = lastRow+1;
          var newImg='img'+(newRow);
          var aTd1=aTr.insertCell(0);
          aTd1.innerHTML = '<span class="table_data">選擇圖片： </span><input name="image[]" type="file" class="table_data" id="image'+newRow+'"><br><span class="table_data">圖片說明： </span><input name="image_title[]" type="text" class="table_data" id="image_title'+newRow+'">';
        }else{
          alert("尚有未選取之圖片欄位!!");
        }
      }

      function addField2() {
        var pTable2=document.getElementById('pTable2');
        var lastRow = pTable2.rows.length;
      //alert(pTable2.rows.length);
      var myField=document.getElementById('upfile'+lastRow);
      //alert('upfile'+lastRow);
      if(myField.value){
        var aTr=pTable2.insertRow(lastRow);
        var newRow = lastRow+1;
        var newFile='file'+(newRow);
        var aTd1=aTr.insertCell(0);
        aTd1.innerHTML = '<span class="table_data">選擇檔案： </span><input name="upfile[]" type="file" class="table_data" id="upfile'+newRow+'"><br><span class="table_data">檔案說明： </span><input name="upfile_title[]" type="text" class="table_data" id="upfile_title'+newRow+'">';
      }else{
        alert("尚有未選取之檔案欄位!!");
      }
    }

    function addFieldIndex() {
      var pTable=document.getElementById('pTableIndex');
      var lastRow = pTable.rows.length;
      //alert(pTable.rows.length);
      var myField=document.getElementById('indexImage'+lastRow);
      //alert('image'+lastRow);
      if(myField.value){
        var aTr=pTable.insertRow(lastRow);
        var newRow = lastRow+1;
        var newImg='img'+(newRow);
        var aTd1=aTr.insertCell(0);
        aTd1.innerHTML = '<span class="table_data">選擇圖片： </span><input name="indexImage[]" type="file" class="table_data" id="indexImage'+newRow+'"><br><span class="table_data">圖片說明： </span><input name="indexImage_title[]" type="text" class="table_data" id="indexImage_title'+newRow+'">';
      }else{
        alert("尚有未選取之圖片欄位!!");
      }
   }
  //-->
  </script>
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
              <td width="30%" class="list_title">修改</td>
              <td width="70%">&nbsp;</td>
            </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><img src="image/spacer.gif" width="1" height="1"></td>
            </tr>
          </table>
          <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="100%" border="0" cellspacing="3" cellpadding="5">
              <tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellspacing="3" cellpadding="5">
                    <tr>
                      <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">名稱</td>
                      <td width="516"><input name="c_title" type="text" class="table_data" id="c_title" value="<?php echo $row_RechomeC['c_title']; ?>" size="50" />
                        <input name="c_id" type="hidden" id="c_id" value="<?php echo $row_RechomeC['c_id']; ?>" /></td>
                        <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                      </tr>

                       <tr>
                        <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">英文slogan</td>
                        <td width="532"><textarea name="c_content_en" cols="50" rows="8" class="table_data" id="c_content_en"><?php echo $row_RechomeC['c_content_en']; ?></textarea></td>
                        <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                      </tr>

                      <tr>
                        <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">中文slogan</td>
                        <td width="532"><textarea name="c_content" cols="50" rows="8" class="table_data" id="c_content"><?php echo $row_RechomeC['c_content']; ?></textarea></td>
                        <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                      </tr>

                      <tr>
                        <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">狀態</td>
                        <td width="516"><label>
                          <select name="c_active" class="table_data" id="c_active">
                            <option value="0" <?php if (!(strcmp(0, $row_RechomeC['c_active']))) {echo "selected=\"selected\"";} ?>>不公佈</option>
                            <option value="1" <?php if (!(strcmp(1, $row_RechomeC['c_active']))) {echo "selected=\"selected\"";} ?>>公佈</option>
                          </select>
                        </label></td>
                        <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                      </tr>

                      <?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>
                      <tr>
                        <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前banner圖片<a name="imageEdit" id="imageEdit"></a></td>
                        <td><?php do { ?>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="100" rowspan="2" align="center"><a href="../<?php echo $row_RecImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>" class="fancyboxImg" rel="group" title="<?php echo $row_RecImage['file_title']; ?>"><img src="../<?php echo $row_RecImage['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame"/></a></td>
                              <td align="left" class="table_data">&nbsp;圖片說明：<?php echo $row_RecImage['file_title']; ?></td>
                            </tr>
                            <tr>
                              <td align="left" class="table_data">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center"><a href="image_edit.php?file_id=<?php echo $row_RecImage['file_id']; ?>&type=homeC" class="fancyboxEdit" title="修改圖片"><img src="image/media_edit.gif" width="16" height="16" title="修改圖片"/></a><a href="image_del.php?file_id=<?php echo $row_RecImage['file_id']; ?>&type=homeC" class="fancyboxEdit" title="刪除圖片"><img src="image/media_delete.gif" width="16" height="16" title="刪除圖片"/></a></td>
                              <td align="center">&nbsp;</td>
                            </tr>
                          </table>

                          <?php } while ($row_RecImage = mysql_fetch_assoc($RecImage)); ?></td>
                          <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*圖片請上傳寬 1100pixel、高 390pixel之圖檔。<BR>每次上傳之檔案大小總計請勿超過2M。</p></td>
                        </tr>
                        <?php } // Show if recordset not empty ?>

                        <?php if ($totalRows_RecImage == 0) { // Show if recordset not empty ?>
                        <tr>
                          <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳bnner圖片</p></td>
                          <td>
                            <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable">
                             <tr>
                               <td> <span class="table_data">選擇圖片：</span>
                                 <input name="image[]" type="file" class="table_data" id="image1" />
                                 <br>
                                 <span class="table_data">圖片說明：</span>
                                 <input name="image_title[]" type="text" class="table_data" id="image_title1">                          </td>
                               </tr>
                             </table>
                             <?php if(0){ ?>
                             <table width="100%" border="0" cellspacing="5" cellpadding="2">
                               <tr>
                                 <td height="28">
                                   <table border="0" cellspacing="2" cellpadding="2">
                                    <tr>
                                      <td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                      <td><a href="javascript:addField()" class="table_data">新增圖片</a></td>
                                      <td class="red_letter">&nbsp;</td>
                                    </tr>
                                  </table>                          </td>
                                </tr>
                              </table>
                              <?php } ?>
                            </td>
                            <td bgcolor="#e5ecf6" class="table_col_title">
                              <p class="red_letter">*圖片請上傳寬 1100pixel、高 390pixel之圖檔。<BR>每次上傳之檔案大小總計請勿超過2M。</p></td>
                            </tr>

                            <?php } // Show if recordset not empty ?>

                            <?php if ($totalRows_RecImageMobile > 0) { // Show if recordset not empty ?>
                      <tr>
                        <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前手機版圖片<a name="imageEdit" id="imageEdit"></a></td>
                        <td><?php do { ?>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="100" rowspan="2" align="center"><a href="../<?php echo $row_RecImageMobile['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>" class="fancyboxImg" rel="group" title="<?php echo $row_RecImageMobile['file_title']; ?>"><img src="../<?php echo $row_RecImageMobile['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame"/></a></td>
                              <td align="left" class="table_data">&nbsp;圖片說明：<?php echo $row_RecImageMobile['file_title']; ?></td>
                            </tr>
                            <tr>
                              <td align="left" class="table_data">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center"><a href="image_edit.php?file_id=<?php echo $row_RecImageMobile['file_id']; ?>&type=homeC_mobile" class="fancyboxEdit" title="修改圖片"><img src="image/media_edit.gif" width="16" height="16" title="修改圖片"/></a><a href="image_del.php?file_id=<?php echo $row_RecImageMobile['file_id']; ?>&type=homeC_mobile" class="fancyboxEdit" title="刪除圖片"><img src="image/media_delete.gif" width="16" height="16" title="刪除圖片"/></a></td>
                              <td align="center">&nbsp;</td>
                            </tr>
                          </table>

                          <?php } while ($row_RecImageMobile = mysql_fetch_assoc($RecImageMobile)); ?></td>
                          <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter"></p></td>
                        </tr>
                        <?php } // Show if recordset not empty ?>

                        <?php if (0) { // Show if recordset not empty ?>
                        <tr>
                          <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳手機版圖片</p></td>
                          <td>
                            <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable">
                             <tr>
                               <td> <span class="table_data">選擇圖片：</span>
                                 <input name="imageMobile[]" type="file" class="table_data" id="imageMobile1" />
                                 <br>
                                 <span class="table_data">圖片說明：</span>
                                 <input name="imageMobile_title[]" type="text" class="table_data" id="imageMobile_title1">                          </td>
                               </tr>
                             </table>
                             <?php if(0){ ?>
                             <table width="100%" border="0" cellspacing="5" cellpadding="2">
                               <tr>
                                 <td height="28">
                                   <table border="0" cellspacing="2" cellpadding="2">
                                    <tr>
                                      <td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                      <td><a href="javascript:addField()" class="table_data">新增圖片</a></td>
                                      <td class="red_letter">&nbsp;</td>
                                    </tr>
                                  </table>                          </td>
                                </tr>
                              </table>
                              <?php } ?>
                            </td>
                            <td bgcolor="#e5ecf6" class="table_col_title">
                              <p class="red_letter"></p></td>
                            </tr>

                            <?php } // Show if recordset not empty ?>

                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" /></td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </td>
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
  $updateSQL = sprintf("UPDATE class_set SET c_title=%s, c_class=%s, c_content_en=%s, c_content=%s, c_link=%s, c_active=%s WHERE c_id=%s",
   GetSQLValueString($_POST['c_title'], "text"),
   GetSQLValueString($_POST['c_class'], "int"),
   GetSQLValueString($_POST['c_content_en'], "text"),
   GetSQLValueString($_POST['c_content'], "text"),
   GetSQLValueString($_POST['c_link'], "text"),
   GetSQLValueString($_POST['c_active'], "int"),
   GetSQLValueString($_POST['c_id'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());


      //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
          //echo image_process();

   $image_result=image_process($_FILES['image'], $_REQUEST['image_title'], "home","add", "1100", "390");

      //echo count($image_result);
      //echo $image_result[0][0];

   for($j=1;$j<count($image_result);$j++)
   {
     $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
       GetSQLValueString($image_result[$j][0], "text"),
       GetSQLValueString($image_result[$j][1], "text"),
       GetSQLValueString($image_result[$j][2], "text"),
       GetSQLValueString($image_result[$j][3], "text"),
       GetSQLValueString("homeC", "text"),
       GetSQLValueString($_POST['c_id'], "int"),
       GetSQLValueString($image_result[$j][4], "text"),
       GetSQLValueString($image_result[$j][5], "int"));

     mysql_select_db($database_connect2data, $connect2data);
     $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
     $_SESSION["change_image"]=1;
   }

    //----------插入圖片資料到資料庫end----------

         //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
          //echo image_process();

   $image_result=image_process($_FILES['imageMobile'], $_REQUEST['imageMobile_title'], "home","add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);

      //echo count($image_result);
      //echo $image_result[0][0];

   for($j=1;$j<count($image_result);$j++)
   {
     $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
       GetSQLValueString($image_result[$j][0], "text"),
       GetSQLValueString($image_result[$j][1], "text"),
       GetSQLValueString($image_result[$j][2], "text"),
       GetSQLValueString($image_result[$j][3], "text"),
       GetSQLValueString("homeC_mobile", "text"),
       GetSQLValueString($_POST['c_id'], "int"),
       GetSQLValueString($image_result[$j][4], "text"),
       GetSQLValueString($image_result[$j][5], "int"));

     mysql_select_db($database_connect2data, $connect2data);
     $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
     $_SESSION["change_image"]=1;
   }

    //----------插入圖片資料到資料庫end----------

  $updateGoTo = "homeC_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum=".$_SESSION["ToPage"];
  }
  header(sprintf("Location: %s", $updateGoTo));

}
?>
<?php
mysql_free_result($RechomeC);
?>