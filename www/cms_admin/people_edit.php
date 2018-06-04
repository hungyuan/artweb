<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process.php'); ?>
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

if(!1){
	header("Location: people_list.php");
}


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


$colname_Recpeople = "-1";
if (isset($_GET['d_id'])) {
  $colname_Recpeople = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_Recpeople = sprintf("SELECT data_set.*, class_set.c_title as c_title FROM data_set LEFT JOIN class_set ON data_set.d_class2 =class_set.c_id WHERE d_id = %s", GetSQLValueString($colname_Recpeople, "int"));
$Recpeople = mysql_query($query_Recpeople, $connect2data) or die(mysql_error());
$row_Recpeople = mysql_fetch_assoc($Recpeople);
$totalRows_Recpeople = mysql_num_rows($Recpeople);

$colname_RecImage = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecImage = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image'", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

//banner
$query_RecImageBanner = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'peopleBanner'", GetSQLValueString($colname_RecImage, "int"));
$RecImageBanner = mysql_query($query_RecImageBanner, $connect2data) or die(mysql_error());
$row_RecImageBanner = mysql_fetch_assoc($RecImageBanner);
$totalRows_RecImageBanner = mysql_num_rows($RecImageBanner);

mysql_select_db($database_connect2data, $connect2data);
$query_RecpeopleC = "SELECT * FROM class_set WHERE c_parent = 'peopleC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecpeopleC = mysql_query($query_RecpeopleC, $connect2data) or die(mysql_error());
$row_RecpeopleC = mysql_fetch_assoc($RecpeopleC);
$totalRows_RecpeopleC = mysql_num_rows($RecpeopleC);

mysql_select_db($database_connect2data, $connect2data);
$query_RecpeopleY = "SELECT * FROM class_set WHERE c_parent = 'peopleY' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecpeopleY = mysql_query($query_RecpeopleY, $connect2data) or die(mysql_error());
$row_RecpeopleY = mysql_fetch_assoc($RecpeopleY);
$totalRows_RecpeopleY = mysql_num_rows($RecpeopleY);

$colname_RecFile = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecFile = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecFile = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'file'", GetSQLValueString($colname_RecFile, "int"));
$RecFile = mysql_query($query_RecFile, $connect2data) or die(mysql_error());
$row_RecFile = mysql_fetch_assoc($RecFile);
$totalRows_RecFile = mysql_num_rows($RecFile);

//echo 'selected_peopleC = '.$_SESSION['selected_peopleC'];
$G_selected1 = '';
if (isset($_SESSION['selected_peopleC'])){
	$G_selected1 = $_SESSION['selected_peopleC'] = $row_Recpeople['d_class2'];
	//echo 'G_selected1 = '.$G_selected1;
}

$menu_is="people";

//記錄帶資料去別地方的資訊
$_SESSION['nowPage']=$selfPage;
$_SESSION['nowMenu']= $menu_is;
$ifFile = 0;
?>
<?php require_once('imagesSize.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php require_once('cmsTitle.php'); ?></title>
  <?php require_once('script.php'); ?>
  <!-- InstanceBeginEditable name="doctitle" -->
  <title>無標題文件</title>
  <link rel="stylesheet" href="jquery/chosen_v1.0.0/chosen.css">
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
     autoSize	: true,
     openEffect	: 'elastic',
     closeEffect	: 'elastic',
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
    openEffect	: 'fade',
    closeEffect	: 'fade',
    autoSize	: true,
    helpers : {
     overlay : {
      css : {
       'background' : 'rgba(0, 0, 0, 0.7)'
     }
   }
 },
 beforeShow	: function() {
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
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td>
                  <table width="100%" border="0" cellpadding="5" cellspacing="3">
                   <tr>
                     <td align="center" bgcolor="#e5ecf6" class="table_col_title">分類</td>
                     <td>
                       <select name="d_class2" id="d_class2">
                         <?php
                         do {
                          ?>
                          <option value="<?php echo $row_RecpeopleC['c_id']?>" <?php if (!(strcmp($row_RecpeopleC['c_id'], $row_Recpeople['d_class2']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecpeopleC['c_title']?></option>
                          <?php
                        } while ($row_RecpeopleC = mysql_fetch_assoc($RecpeopleC));
                        $rows = mysql_num_rows($RecpeopleC);
                        if($rows > 0) {
                          mysql_data_seek($RecpeopleC, 0);
                          $row_RecpeopleC = mysql_fetch_assoc($RecpeopleC);
                        }
                        ?>
                      </select></td>
                      <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                    </tr>

                     <tr>
                       <td align="center" bgcolor="#e5ecf6" class="table_col_title">名稱</td>
                       <td><input name="d_title" type="text" class="table_data" id="d_title" size="80" value="<?php echo $row_Recpeople['d_title']; ?>" /></td>
                       <td bgcolor="#e5ecf6">&nbsp;</td>
                     </tr>

                     <tr>
                       <td align="center" bgcolor="#e5ecf6" class="table_col_title">內容</td>
                       <td><textarea name="d_content" cols="50" rows="30" class="table_data tiny" id="d_content"><?php echo $row_Recpeople['d_content']; ?></textarea></td>
                       <td bgcolor="#e5ecf6"><p class="note_letter">*小斷行請按Shift+Enter。<br />
                         輸入區域的右下角可以調整輸入空間的大小。<br>圖片最大尺寸為 寬 1100 pixel 高 不限</p></td>
                     </tr>

                     <tr>
                      <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">時間</td>
                      <td><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo $row_Recpeople['d_date']; ?>" size="50" /></td>
                      <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                    </tr>
                    <tr>
                     <td align="center" bgcolor="#e5ecf6" class="table_col_title">狀態</td>
                     <td><label>
                       <select name="d_active" class="table_data" id="d_active">
                         <option value="0" <?php if (!(strcmp(0, $row_Recpeople['d_active']))) {echo "selected=\"selected\"";} ?>>不公佈</option>
                         <option value="1" <?php if (!(strcmp(1, $row_Recpeople['d_active']))) {echo "selected=\"selected\"";} ?>>公佈</option>
                       </select>
                     </label></td>
                     <td bgcolor="#e5ecf6">&nbsp;</td>
                   </tr>

                   <tr>
                     <td align="center" bgcolor="#e5ecf6" class="table_col_title">首頁顯示</td>
                     <td><label>
                       <select name="d_data1" class="table_data" id="d_data1">
                         <option value="0" <?php if (!(strcmp(0, $row_Recpeople['d_data1']))) {echo "selected=\"selected\"";} ?>>不公佈</option>
                         <option value="1" <?php if (!(strcmp(1, $row_Recpeople['d_data1']))) {echo "selected=\"selected\"";} ?>>公佈</option>
                       </select>
                     </label></td>
                     <td bgcolor="#e5ecf6">&nbsp;</td>
                   </tr>

                   <?php if ($totalRows_RecImageBanner > 0) { // Show if recordset not empty ?>
                   <!-- <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前上方banner<a name="imageEdit" id="imageEdit"></a></td>
                    <td><?php do { ?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="100" rowspan="2" align="center"><a href="../<?php echo $row_RecImageBanner['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>" class="fancyboxImg" rel="group" title="<?php echo $row_RecImageBanner['file_title']; ?>"><img src="../<?php echo $row_RecImageBanner['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame"/></a></td>
                          <td align="left" class="table_data">&nbsp;圖片說明：<?php echo $row_RecImageBanner['file_title']; ?></td>
                        </tr>
                        <tr>
                          <td align="left" class="table_data">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="center"><a href="image_edit.php?file_id=<?php echo $row_RecImageBanner['file_id'].'&type=peopleBanner'; ?>" class="fancyboxEdit" title="修改圖片"><img src="image/media_edit.gif" width="16" height="16" title="修改圖片"/></a><a href="image_del.php?file_id=<?php echo $row_RecImageBanner['file_id'].'&type=peopleBanner'; ?>" class="fancyboxEdit" title="刪除圖片"><img src="image/media_delete.gif" width="16" height="16" title="刪除圖片"/></a></td>
                          <td align="center">&nbsp;</td>
                        </tr>
                      </table>

                      <?php } while ($row_RecImageBanner = mysql_fetch_assoc($RecImageBanner)); ?></td>
                      <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">&nbsp;</p></td>
                    </tr> -->
                    <?php } // Show if recordset not empty ?>

                    <?php if ($totalRows_RecImageBanner == 0) { // Show if recordset not empty ?>
                    <!-- <tr>
                      <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳上方banner</p></td>
                      <td>
                        <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data">
                         <tr>
                           <td> <span class="table_data">選擇圖片：</span>
                             <input name="imageBanner[]" type="file" class="table_data" id="imageBanner1" />
                             <br>
                             <span class="table_data">圖片說明：</span>
                             <input name="imageBanner_title[]" type="text" class="table_data" id="imageBanner_title1">                          </td>
                           </tr>
                         </table>
                       </td>
                       <td bgcolor="#e5ecf6" class="table_col_title">
                        <p class="red_letter">*<?php echo $imagesSize['peopleBanner']['note'];?></p></td>
                      </tr> -->
                      <?php } // Show if recordset not empty ?>

                      <?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>
                      <tr>
                        <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前封面圖片(有封面才可顯示在最新活動)<a name="imageEdit" id="imageEdit"></a></td>
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
                              <td align="center"><a href="image_edit.php?file_id=<?php echo $row_RecImage['file_id']; ?>" class="fancyboxEdit" title="修改圖片"><img src="image/media_edit.gif" width="16" height="16" title="修改圖片"/></a><a href="image_del.php?file_id=<?php echo $row_RecImage['file_id']; ?>" class="fancyboxEdit" title="刪除圖片"><img src="image/media_delete.gif" width="16" height="16" title="刪除圖片"/></a></td>
                              <td align="center">&nbsp;</td>
                            </tr>
                          </table>

                          <?php } while ($row_RecImage = mysql_fetch_assoc($RecImage)); ?></td>
                          <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">&nbsp;</p></td>
                        </tr>
                        <?php } // Show if recordset not empty ?>

                        <?php if ($totalRows_RecImage == 0) { // Show if recordset not empty ?>
                        <tr>
                          <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳封面圖片(有封面才可顯示在最新活動)</p></td>
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
                              <p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?></p></td>
                            </tr>

                            <?php } // Show if recordset not empty ?>

                            <?php if ($totalRows_RecFile > 0) { // Show if recordset not empty ?>
                            <tr>
                              <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前檔案</td>
                              <td><table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td><table >
                                    <tr>
                                      <?php

                                      $RecFile_endRow = 0;
      $RecFile_columns = 1; //
      $RecFile_hloopRow1 = 0; // @
      do {
        //$numI++;
        //echo $numI;
        if($RecFile_endRow == 0  && $RecFile_hloopRow1++ != 0) echo "<tr>";
        ?>
        <td><table width="320" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" class="table_frame_style">
          <tr>
            <td align="left" class="table_no_border"><span class="table_data">&nbsp;檔案名稱: <a href="../<?php echo $row_RecFile['file_link1']; ?>" title='<?php echo $row_RecFile['file_title']; ?>' target="_blank"><?php echo $row_RecFile['file_name']; ?></a></span></td>
          </tr>
          <tr>
            <td align="left" class="table_no_border">
              <span class="table_data">&nbsp;檔案</span><span class="table_data">說明:</span>
              <span class="table_data"><a href="../<?php echo $row_RecFile['file_link1']; ?>" title='<?php echo $row_RecFile['file_title']; ?>' target="_blank"><?php echo $row_RecFile['file_title']; ?></a></span></td>
            </tr>
            <tr>
              <td class="table_no_border">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="file_edit.php?file_id=<?php echo $row_RecFile['file_id']; ?>" class="fancyboxEdit" title='修改檔案'><img src="image/media_edit.gif" width="16" height="16" title="修改檔案" /></a><a href="file_del.php?file_id=<?php echo $row_RecFile['file_id']; ?>" class="fancyboxEdit" title='刪除檔案'><img src="image/media_delete.gif" width="16" height="16" title="刪除檔案"/></a></td>
              </tr>
            </table></td>
            <?php  $RecFile_endRow++;
            if($RecFile_endRow >= $RecFile_columns) {
              ?>
            </tr>
            <?php
            $RecFile_endRow = 0;
          }
        } while ($row_RecFile = mysql_fetch_assoc($RecFile));
        if($RecFile_endRow != 0) {
          while ($RecFile_endRow < $RecFile_columns) {
            echo("<td>&nbsp;</td>");
            $RecFile_endRow++;
          }
          echo("</tr>");
        }?></table></td>
      </tr>
    </table></td>
    <td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p></td>
  </tr>
  <?php } // Show if recordset not empty ?>


  <?php if (0): ?>
    <tr>
      <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳檔案</p></td>
      <td><table border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable2">
        <tr>
          <td><span class="table_data">選擇檔案：</span>
            <input name="upfile[]" type="file" class="table_data" id="upfile1" />
            <br />
            <span class="table_data">檔案說明：</span>
            <input name="upfile_title[]" type="text" class="table_data" id="upfile_title1" /></td>
          </tr>
        </table>
        <!-- <table border="0" cellspacing="5" cellpadding="2">
          <tr>
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td><a href="javascript:addField2()"><img src="image/add.png" width="16" height="16" border="0" /></a></td>
                <td><a href="javascript:addField2()" class="table_data">新增檔案</a></td>
                <td class="red_letter">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table> --></td>
        <td bgcolor="#e5ecf6" class="table_col_title"><span class="red_letter">*上傳之檔案請勿超過2M。</span></td>
      </tr>
    <?php endif ?>


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
<input name="d_id" type="hidden" id="d_id" value="<?php echo $row_Recpeople['d_id']; ?>" />
<input name="d_sort" type="hidden" id="d_sort" value="<?php echo $row_Recpeople['d_sort']; ?>" />
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


 /*$d_tag = '';
 $class3 = '';

 $d_tag = is_null(checkV('select1')) ? NULL : implode (",", checkV('select1'));
 $tagA = $_POST['select1'];*/

 $d_title	= checkV('d_title');
 $d_title_en  = checkV('d_title_en');
 $d_content	= checkV('d_content');

 $d_class2	= checkV('d_class2');
 $d_class3	= checkV('d_class3');
 $d_class4  = checkV('d_class4');
 $d_class5  = checkV('d_class5');
 $d_class6	= checkV('d_class6');
 $d_date	= checkV('d_date');
 $d_active  = checkV('d_active');
 $d_data1	= checkV('d_data1');
 $d_id		= checkV('d_id');

 $updateSQL = sprintf("UPDATE data_set SET d_title=%s, d_title_en=%s, d_content=%s, d_class2=%s, d_class3=%s, d_class4=%s, d_class5=%s, d_class6=%s, d_data1=%s, d_data2=%s, d_data3=%s, d_data4=%s, d_date=%s, d_active=%s WHERE d_id=%s",
   GetSQLValueString($d_title, "text"),
   GetSQLValueString($d_title_en, "text"),
   GetSQLValueString($d_content, "text"),
   GetSQLValueString($d_class2, "text"),
   GetSQLValueString($d_class3, "text"),
   GetSQLValueString($d_class4, "text"),
   GetSQLValueString($d_class5, "text"),
   GetSQLValueString($d_class6, "text"),
   GetSQLValueString($d_data1, "text"),
   GetSQLValueString($a_2, "text"),
   GetSQLValueString($a_3, "text"),
   GetSQLValueString($a_4, "text"),
   GetSQLValueString($d_date, "date"),
   GetSQLValueString($d_active, "int"),
   GetSQLValueString($d_id, "int"));

 mysql_select_db($database_connect2data, $connect2data);
 $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

    //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
   			//echo image_process();

 $image_result=image_process($_FILES['image'], $_REQUEST['image_title'], "people","add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);

		//echo count($image_result);
		//echo $image_result[0][0];

 for($j=1;$j<count($image_result);$j++)
 {
   $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
     GetSQLValueString($image_result[$j][0], "text"),
     GetSQLValueString($image_result[$j][1], "text"),
     GetSQLValueString($image_result[$j][2], "text"),
     GetSQLValueString($image_result[$j][3], "text"),
     GetSQLValueString("image", "text"),
     GetSQLValueString($d_id, "int"),
     GetSQLValueString($image_result[$j][4], "text"),
     GetSQLValueString($image_result[$j][5], "int"));

   mysql_select_db($database_connect2data, $connect2data);
   $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
   $_SESSION["change_image"]=1;
 }

	//----------插入圖片資料到資料庫end----------

 //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------

 $image_result=image_process($_FILES['imageBanner'], $_REQUEST['imageBanner_title'], "peopleBanner","add", $imagesSize['peopleBanner']['IW'], $imagesSize['peopleBanner']['IH']);
    //echo count($image_result);
    //echo $image_result[0][0];


 for($j=1;$j<count($image_result);$j++)
 {
   $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
     GetSQLValueString($image_result[$j][0], "text"),
     GetSQLValueString($image_result[$j][1], "text"),
     GetSQLValueString($image_result[$j][2], "text"),
     GetSQLValueString($image_result[$j][3], "text"),
     GetSQLValueString("peopleBanner", "text"),
     GetSQLValueString($d_id, "int"),
     GetSQLValueString($image_result[$j][4], "text"),
     GetSQLValueString($image_result[$j][5], "int"));

   mysql_select_db($database_connect2data, $connect2data);
   $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
   $_SESSION["change_image"]=1;
 }
  //----------插入圖片資料到資料庫end----------


 if($ifFile){
    //----------插入檔案資料到資料庫begin(須放入插入主資料後)----------
          //echo file_process();

      $sql_max_data= "Select MAX(d_id) From data_set";//找到d_id的最大值,放入檔案資料內
      //echo $sql_max_data;
      $result_max_data=mysql_query($sql_max_data);

      if($row_max_data = mysql_fetch_array($result_max_data))
      {

        $new_data_num=$row_max_data[0];

        //echo $row_max_data[0];
      }

      $file_result=file_process("peopleFile","add");

    //echo count($file_result);


      for($j=0;$j<count($file_result);$j++)
      {
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_type, file_d_id, file_title) VALUES (%s, %s, %s, %s, %s)",
          GetSQLValueString($file_result[$j][0], "text"),
          GetSQLValueString($file_result[$j][1], "text"),
          GetSQLValueString("file", "text"),
          GetSQLValueString($d_id, "int"),
          GetSQLValueString($file_result[$j][2], "text"));

        mysql_select_db($database_connect2data, $connect2data);
        $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
      }
    }
  //----------插入檔案資料到資料庫end----------

    $_SESSION['original_selected']=$_SESSION['selected_peopleC'];

  //$updateGoTo = "people_list.php?selected1=".$class2."&selected2=".$class3."&changeSort=1&change_num=".$_POST['d_sort']."&now_d_id=".$_POST['d_id']."&totalRows_Recpeople=".$_SESSION['totalRows']."&pageNum=".$_SESSION["ToPage"];
    $updateGoTo = "people_list.php?selected1=".$d_class2."&changeSort=1&change_num=".$_POST['d_sort']."&now_d_id=".$d_id."&totalRows=".$_SESSION['totalRows']."&pageNum=".$_SESSION["ToPage"];

    if (isset($_SERVER['QUERY_STRING'])) {
      $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
      $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum=".$_SESSION["ToPage"];
    }


    if($image_result[0][0]==1)
    {
      echo "<script type=\"text/javascript\">call_alert('".$updateGoTo."');</script>";
    }else
    {
  		//echo $updateGoTo;
      header(sprintf("Location: %s", $updateGoTo));
    }
  }
  ?>
  <?php
  mysql_free_result($Recpeople);
  mysql_free_result($RecImage);
  mysql_free_result($RecpeopleC);
  ?>
