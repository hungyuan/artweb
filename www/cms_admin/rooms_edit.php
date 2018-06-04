<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process_rooms.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_Recrooms = "-1";
if (isset($_GET['d_id'])) {
  $colname_Recrooms = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_Recrooms = sprintf("SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND D.d_id = %s", GetSQLValueString($colname_Recrooms, "int"));
$Recrooms = mysql_query($query_Recrooms, $connect2data) or die(mysql_error());
$row_Recrooms = mysql_fetch_assoc($Recrooms);
$totalRows_Recrooms = mysql_num_rows($Recrooms);

$colname_RecImage = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecImage = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image'", GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);

// $colname_RecFile = "-1";
// if (isset($_GET['d_id'])) {
//   $colname_RecFile = $_GET['d_id'];
// }
// mysql_select_db($database_connect2data, $connect2data);
// $query_RecFile = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'file'", GetSQLValueString($colname_RecFile, "int"));
// $RecFile = mysql_query($query_RecFile, $connect2data) or die(mysql_error());
// $row_RecFile = mysql_fetch_assoc($RecFile);
// $totalRows_RecFile = mysql_num_rows($RecFile);

//echo 'selected_roomsT = '.$_SESSION['selected_roomsT'];
$G_selected1 = '';
if (isset($_SESSION['selected_roomsT'])){
	$G_selected1 = $_SESSION['selected_roomsT'] = $row_Recrooms['term_id'];
	//echo 'G_selected1 = '.$G_selected1;
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecroomsT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='rooms' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecroomsT = mysql_query($query_RecroomsT, $connect2data) or die(mysql_error());
$row_RecroomsT = mysql_fetch_assoc($RecroomsT);
$totalRows_RecroomsT = mysql_num_rows($RecroomsT);

$colname_RecIndexImage = "-1";
if (isset($_GET['d_id'])) {
  $colname_RecIndexImage = $_GET['d_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecIndexImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'roomsCover'", GetSQLValueString($colname_RecIndexImage, "int"));
$RecIndexImage = mysql_query($query_RecIndexImage, $connect2data) or die(mysql_error());
$row_RecIndexImage = mysql_fetch_assoc($RecIndexImage);
$totalRows_RecIndexImage = mysql_num_rows($RecIndexImage);

// $colname_RecVideoImage = "-1";
// if (isset($_GET['d_id'])) {
//   $colname_RecVideoImage = $_GET['d_id'];
// }
// mysql_select_db($database_connect2data, $connect2data);
// $query_RecVideoImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'roomsVideoCover'", GetSQLValueString($colname_RecVideoImage, "int"));
// $RecVideoImage = mysql_query($query_RecVideoImage, $connect2data) or die(mysql_error());
// $row_RecVideoImage = mysql_fetch_assoc($RecVideoImage);
// $totalRows_RecVideoImage = mysql_num_rows($RecVideoImage);


$menu_is="rooms";

//記錄帶資料去別地方的資訊
$_SESSION['nowPage']=$selfPage;
$_SESSION['nowMenu']= $menu_is;
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
<script type="text/javascript" src="jquery/jquery.fancybox-1.3.4/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="jquery/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="jquery/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
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
			'autoScale'		: 'true',
			'autoDimensions': 'true',
			'cyclic'		: 'true',
			'overlayOpacity': 0.7,
			'overlayColor'	: '#000',
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic',
			'title'			: $(this).title,
			'href'			: this.href
	});
	$("a.fancyboxEdit").fancybox({
			'autoScale'		: 'true',
			'autoDimensions': 'true',
			'cyclic'		: 'true',
			'overlayOpacity': 0.7,
			'overlayColor'	: '#000',
			'transitionIn'	: 'fade',
			'transitionOut'	: 'fade',
			'title'			: $(this).title,
			'href'			: this.href,
			onStart			: function() {
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
            	  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">分類</td>
            	  <td>
            	    <label>
            	      <select data-placeholder="請選擇分類..." class="chosen-select table_data" multiple style="width:400px;" tabindex="4" name="select1[]" id="select1">
            	        <?php
do {
	$selA = explode(',',$row_Recrooms['d_tag']);
	if (in_array($row_RecroomsT['term_id'], $selA)){
		$sel = "selected=\"selected\"";
	}else{
		$sel = "";
	}
?>
            	        <option value="<?php echo $row_RecroomsT['term_id']?>"<?php echo $sel; ?>><?php echo $row_RecroomsT['name']?><?php //echo $row_RecroomsT['term_id']?></option>
            	        <?php
} while ($row_RecroomsT = mysql_fetch_assoc($RecroomsT));
  $rows = mysql_num_rows($RecroomsT);
  if($rows > 0) {
      mysql_data_seek($RecroomsT, 0);
	  $row_RecroomsT = mysql_fetch_assoc($RecroomsT);
  }
?>
            	        </select></label>
          	    </td>
            	  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>

            	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">名稱</td>
            	  <td><input name="d_title" type="text" class="table_data" id="d_title" value="<?php echo $row_Recrooms['d_title']; ?>" size="80" />
          	    </td>
            	  <td bgcolor="#e5ecf6">
            	    <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_Recrooms['d_id']; ?>" />
                    <input name="term_order" type="hidden" id="term_order" value="<?php echo $row_Recrooms['term_order']; ?>" /><?php //echo $row_RecUnitary['term_order']; ?>
                  </td>
          	  </tr>

              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">英文名稱</td>
                <td><input name="d_class2" type="text" class="table_data" id="d_class2" value="<?php echo $row_Recrooms['d_class2']; ?>" size="80" /></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr>

            	<!-- <tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">電話</td>
            	  <td><input name="d_class4" type="text" class="table_data" id="d_class4" value="<?php echo $row_Recrooms['d_class4']; ?>" size="80" /></td>
            	  <td bgcolor="#e5ecf6">&nbsp;</td>
          	  </tr>
              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">地址</td>
                <td><input name="d_class5" type="text" class="table_data" id="d_class5" value="<?php echo $row_Recrooms['d_class5']; ?>" size="80" /></td>
                <td bgcolor="#e5ecf6">&nbsp;</td>
              </tr> -->

              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">說明</td>
                <td><textarea name="d_content" cols="50" rows="30" class="table_data tiny" id="d_content"><?php echo $row_Recrooms['d_content']; ?></textarea></td>
                <td bgcolor="#e5ecf6"><p class="note_letter">*小斷行請按Shift+Enter。<br />
                  輸入區域的右下角可以調整輸入空間的大小。</p></td>
              </tr>

              <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">封面介紹</td>
                <td><textarea name="d_class3" cols="50" rows="30" class="table_data tiny" id="d_class3"><?php echo $row_Recrooms['d_class3']; ?></textarea></td>
                <td bgcolor="#e5ecf6"><p class="note_letter">*小斷行請按Shift+Enter。<br />
                  輸入區域的右下角可以調整輸入空間的大小。</p></td>
              </tr>
          <!--   	<tr>
            	  <td align="center" bgcolor="#e5ecf6" class="table_col_title">說明</td>
            	  <td><textarea name="d_content" cols="50" rows="30" class="table_data tiny" id="d_content"><?php echo $row_Recrooms['d_content']; ?></textarea></td>
            	  <td bgcolor="#e5ecf6"><p class="note_letter">*小斷行請按Shift+Enter。<br />
            	    輸入區域的右下角可以調整輸入空間的大小。</p></td>
          	  </tr> -->

             <!--  <tr>
                <td align="center" bgcolor="#e5ecf6" class="table_col_title">youtube影片碼</td>
                <td><input name="d_class4" type="text" class="table_data" id="d_class4" value="<?php echo $row_Recrooms['d_class4']; ?>" size="70" /></td>
                <td bgcolor="#e5ecf6"><p class="note_letter">請先自行將影片上傳至 youtube後，再將影片碼輸入於左方文字欄位。<br />
                例如，影片網址為：https://www.youtube.com/watch?v=XJwDYbla0RM，網址watch?v=後面則為影片碼( XJwDYbla0RM )。</p></td>
              </tr> -->
              <?php if ($totalRows_RecVideoImage > 0) { // Show if recordset not empty ?>
                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前youtube封面圖片<a name="imageEdit" id="imageEdit"></a></td>
                    <td><?php do { ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="100" rowspan="2" align="center"><a href="../<?php echo $row_RecVideoImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>" class="fancyboxImg" rel="group" title="<?php echo $row_RecVideoImage['file_title']; ?>"><img src="../<?php echo $row_RecVideoImage['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame"/></a></td>
                                    <td align="left" class="table_data">&nbsp;圖片說明：<?php echo $row_RecVideoImage['file_title']; ?></td>
                              </tr>
                          <tr>
                            <td align="left" class="table_data">&nbsp;</td>
                              </tr>
                          <tr>
                            <td align="center"><a href="image_edit.php?file_id=<?php echo $row_RecVideoImage['file_id'].'&type=roomsVideoCover'; ?>" class="fancyboxEdit" title="修改圖片"><img src="image/media_edit.gif" width="16" height="16" title="修改圖片"/></a><a href="image_del.php?file_id=<?php echo $row_RecVideoImage['file_id'].'&type=roomsVideoCover'; ?>" class="fancyboxEdit" title="刪除圖片"><img src="image/media_delete.gif" width="16" height="16" title="刪除圖片"/></a></td>
                                            <td align="center">&nbsp;</td>
                                </tr>
                        </table>
                        <?php } while ($row_RecVideoImage = mysql_fetch_assoc($RecVideoImage)); ?></td>
                    <td bgcolor="#e5ecf6" class="table_col_title"><p class="note_letter">&nbsp;</p></td>
                  </tr>
                  <?php } // Show if recordset not empty ?>


                  <?php if ($totalRows_RecVideoImage == 0) { // Show if recordset empty ?>
               <!--  <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳youtube封面圖片</p>                   </td>
                    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTableIndex">
                      <tr>
                        <td> <span class="table_data">選擇圖片：</span>
                          <input name="videoImage[]" type="file" class="table_data" id="videoImage1" />
                          <br>
                          <span class="table_data">圖片說明：</span>
                          <input name="videoImage_title[]" type="text" class="table_data" id="videoImage_title1">
                  </td>
                      </tr>
                    </table>

                              </td>
                    <td bgcolor="#e5ecf6" class="table_col_title">
                    <p class="note_letter"><?php echo $imagesSize['roomsVideoCover']['note'];?></p></td>
                </tr> -->
                <?php } // Show if recordset empty ?>
            	<!--<tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">內容說明</td>
                  <td><textarea name="d_content" cols="50" rows="5" class="table_data" id="d_content"><?php //echo $row_Recrooms['d_content']; ?></textarea></td>
                	<td bgcolor="#e5ecf6" class="table_col_title"><p>小斷行請按Shift+Enter。<br />
                	  輸入區域的右下角可以調整輸入空間的大小。</p></td>
                </tr>-->
                <tr>
                  <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">時間</td>
                  <td><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo $row_Recrooms['d_date']; ?>" size="50" /></td>
                  <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#e5ecf6" class="table_col_title">狀態</td>
                  <td><label>
                    <select name="d_active" class="table_data" id="d_active">
                      <option value="0" <?php if (!(strcmp(0, $row_Recrooms['d_active']))) {echo "selected=\"selected\"";} ?>>不公佈</option>
                      <option value="1" <?php if (!(strcmp(1, $row_Recrooms['d_active']))) {echo "selected=\"selected\"";} ?>>公佈</option>
                    </select>
                  </label></td>
                  <td bgcolor="#e5ecf6">&nbsp;</td>
      	      	</tr>

                <?php if ($totalRows_RecIndexImage > 0) { // Show if recordset not empty ?>

                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前列表封面<a name="imageEdit" id="imageEdit"></a></td>
                    <td><?php do { ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="100" rowspan="2" align="center"><a href="../<?php echo $row_RecIndexImage['file_link1'].'?'.(mt_rand(1,100000)/100000); ?>" class="fancyboxImg" rel="group" title="<?php echo $row_RecIndexImage['file_title']; ?>"><img src="../<?php echo $row_RecIndexImage['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame"/></a></td>
                                    <td align="left" class="table_data">&nbsp;圖片說明：<?php echo $row_RecIndexImage['file_title']; ?></td>
                              </tr>
                                      <tr>
                            <!-- <td align="left" class="table_data">&nbsp;寬度格式：
                                          <?php
                                            if($row_RecIndexImage['file_width']==1){
                                              echo "1個單位";
                                            }elseif($row_RecIndexImage['file_width']==2){
                                              echo "2個單位";
                                            }elseif($row_RecIndexImage['file_width']==3){
                                              echo "3個單位";}
                                          ?>
                                          &nbsp;
                                          長度格式：
                                          <?php
                                            if($row_RecIndexImage['file_height']==1){
                                              echo "1個單位";
                                            }elseif($row_RecIndexImage['file_height']==2){
                                              echo "2個單位";
                                            }elseif($row_RecIndexImage['file_height']==3){
                                              echo "3個單位";}
                                          ?>
                                          </td> -->
                              </tr>

                          <tr>
                            <td align="center"><a href="image_edit.php?file_id=<?php echo $row_RecIndexImage['file_id'].'&type=roomsCover'; ?>" class="fancyboxEdit imgEdit" title="修改圖片"><img src="image/media_edit.gif" width="16" height="16" title="修改圖片"/></a><a href="image_del.php?file_id=<?php echo $row_RecIndexImage['file_id'].'&type=roomsCover'; ?>" class="fancyboxEdit" title="刪除圖片"><img src="image/media_delete.gif" width="16" height="16" title="刪除圖片"/></a></td>
                                            <td align="center"><input name="file_id" type="hidden" id="file_id" value="<?php echo $row_RecIndexImage['file_id']; ?>" /></td>
                                </tr>
                        </table>

                        <?php } while ($row_RecIndexImage = mysql_fetch_assoc($RecIndexImage)); ?></td>
                    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*<?php echo $imagesSize['roomsCover']['note'];?></p></td>
                  </tr>

                  <?php } // Show if recordset not empty ?>

                <?php if ($totalRows_RecIndexImage == 0) { // Show if recordset empty ?>

                  <tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳列表封面</p>              	    </td>
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
                          <!-- <div class="marginTop2">
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
                    <p class="red_letter">*<?php echo $imagesSize['roomsCover']['note'];?></p></td>
                </tr>

                <?php } // Show if recordset not empty ?>

                <?php if ($totalRows_RecImage > 0) { // Show if recordset empty ?>
                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前圖片<a name="imageEdit" id="imageEdit"></a></td>
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

                  <!-- 圖片start -->
                  <tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳圖片</p></td>
              	    <td>
                    <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable">
                    	<tr>
                     		<td> <span class="table_data">選擇圖片：</span>
                        	<input name="image[]" type="file" class="table_data" id="image1" />
                        	<br>
                        	<span class="table_data">圖片說明：</span>
                        	<input name="image_title[]" type="text" class="table_data" id="image_title1">                        	</td>
                  		</tr>
                    </table>
                    <table width="100%" border="0" cellspacing="5" cellpadding="2">
                    	<tr>
                        	<td height="28">
                        	<table border="0" cellspacing="2" cellpadding="2">
                        		<tr>
                            		<td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                	<td><a href="javascript:addField()" class="table_data">新增圖片</a></td>
                                	<td class="red_letter">&nbsp;</td>
                            	</tr>
                        	</table>                        	</td>
                        </tr>
                    </table>
                              </td>
              	    <td bgcolor="#e5ecf6" class="table_col_title">
                    <p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?></p></td>
                </tr>
                <!-- 圖片end -->

      		    <!--<tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳圖片</p>              	    </td>
              	    <td><table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable">
                    	<tr>
                     		<td> <span class="table_data">選擇圖片：</span>
                        	<input name="image[]" type="file" class="table_data" id="image1" />
                        	<br>
                        	<span class="table_data">圖片說明：</span>
                        	<input name="image_title[]" type="text" class="table_data" id="image_title1">                        	</td>
                  		</tr>
                    </table><table width="100%" border="0" cellspacing="5" cellpadding="2">
                    	<tr>
                        	<td>
                        	<table border="0" cellspacing="2" cellpadding="2">
                        		<tr>
                            		<td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                	<td><a href="javascript:addField()" class="table_data">增加圖片</a></td>
                                	<td class="red_letter">*圖片請上傳高於 640x480 pixel 72dpi 之圖檔。</td>
                            	</tr>
                        	</table>                        	</td>
                        </tr>
                    </table></td>
              	    <td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p>           	        </td>
                </tr>-->


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
<!-- InstanceEnd -->
<script src="jquery/chosen_v1.0.0/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
$(document).ready(function(){

});
</script>
</html>
<?php
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

function checkV($d){
	return (isset($_REQUEST[$d])) ? $_REQUEST[$d] : NULL;
}

 $d_tag = '';
 $class3 = '';

 $d_tag = is_null(checkV('select1')) ? NULL : implode (",", checkV('select1'));
 $tagA = $_POST['select1'];

 $d_title	= checkV('d_title');
 $d_content	= checkV('d_content');
 $d_class1	= checkV('d_class1');
 $d_class2	= checkV('d_class2');
 $d_class3	= checkV('d_class3');
 $d_class4	= checkV('d_class4');
 $d_class5	= checkV('d_class5');
 $d_class6	= checkV('d_class6');
 $d_date	= checkV('d_date');
 $d_active	= checkV('d_active');
 $d_id		= checkV('d_id');

  $file_show_type = checkV('file_show_type');
   $file_width  = checkV('file_width');
 $file_height  = checkV('file_height');

  $updateSQL = sprintf("UPDATE data_set SET d_title=%s, d_content=%s, d_tag=%s, d_class2=%s, d_class3=%s, d_class4=%s, d_class5=%s, d_class6=%s, d_date=%s, d_active=%s WHERE d_id=%s",
                       GetSQLValueString($d_title, "text"),
                       GetSQLValueString($d_content, "text"),
                       GetSQLValueString($d_tag, "text"),
                       GetSQLValueString($d_class2, "text"),
                       GetSQLValueString($d_class3, "text"),
                       GetSQLValueString($d_class4, "text"),
                       GetSQLValueString($d_class5, "text"),
                       GetSQLValueString($d_class6, "text"),
                       GetSQLValueString($d_date, "date"),
                       GetSQLValueString($d_active, "int"),
                       GetSQLValueString($d_id, "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());



	  mysql_select_db($database_connect2data, $connect2data);
	  $querySQL = "SELECT term_taxonomy_id AS ID FROM term_relationships WHERE object_id='$d_id'";
	  $res = mysql_query($querySQL, $connect2data) or die(mysql_error());
	  $row = mysql_fetch_assoc($res);
	  $total = mysql_num_rows($res);

	  do{
		  if (in_array($row['ID'], $tagA)){ //ID原本的tag是不有在新的tagA裡

		  }else{
			  $deleteSQL = sprintf("DELETE FROM term_relationships WHERE term_taxonomy_id=%s AND object_id=%s",
						   GetSQLValueString($row['ID'], "int"),
						   GetSQLValueString($d_id, "int"));

			  mysql_select_db($database_connect2data, $connect2data);
			  $Result1 = mysql_query($deleteSQL, $connect2data) or die(mysql_error());
		  }

	  } while ($row = mysql_fetch_assoc($res));

	 foreach ($tagA as $tagO){

	 	mysql_select_db($database_connect2data, $connect2data);
		$querySQL = "SELECT term_taxonomy_id AS ID FROM term_relationships WHERE object_id='$d_id' AND term_taxonomy_id='$tagO'";
		$res = mysql_query($querySQL, $connect2data) or die(mysql_error());
		$total = mysql_num_rows($res);

		if($total==0){

			$insertSQL = sprintf("INSERT INTO term_relationships (object_id, term_taxonomy_id) VALUES (%s, %s)",
                       GetSQLValueString($d_id, "int"),
                       GetSQLValueString($tagO, "int"));

		 	mysql_select_db($database_connect2data, $connect2data);
		  	$Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
		}


	}

    $new_data_num = mysql_insert_id();//找到d_id的最大值
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

  $image_result=image_process($_FILES['indexImage'], $_REQUEST['indexImage_title'], "roomsCover","add", $imagesSize[$format]['IW'], $imagesSize[$format]['IH']);
    //echo count($image_result);
    //echo $image_result[0][0];

    for($j=1;$j<count($image_result);$j++)
    {
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type, file_width, file_height) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString("roomsCover", "text"),
                       GetSQLValueString($_POST['d_id'], "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($file_show_type, "int"),
                       GetSQLValueString($file_width, "int"),
                       GetSQLValueString($file_height, "int"));

          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
        $_SESSION["change_image"]=1;
    }


	//----------插入首頁圖片資料到資料庫end----------
    //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
   			//echo image_process();

	$image_result=image_process($_FILES['image'], $_REQUEST['image_title'], "rooms","add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);

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
                       GetSQLValueString($_POST['d_id'], "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($image_result[$j][5], "int"));

  			  mysql_select_db($database_connect2data, $connect2data);
  			  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
			  $_SESSION["change_image"]=1;
		}

	//----------插入圖片資料到資料庫end----------


  //----------插入youtube封面圖片資料到資料庫begin(須放入插入主資料後)----------

  $image_result=image_process($_FILES['videoImage'], $_REQUEST['videoImage_title'], "roomsVideoCover","add", $imagesSize['roomsVideoCover']['IW'], $imagesSize['roomsVideoCover']['IH']);
    //echo count($image_result);
    //echo $image_result[0][0];


    for($j=1;$j<count($image_result);$j++)
    {
        $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_link4, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
                       GetSQLValueString($image_result[$j][3], "text"),
                       GetSQLValueString($image_result[$j][6], "text"),
                       GetSQLValueString("roomsVideoCover", "text"),
                       GetSQLValueString($d_id, "int"),
                       GetSQLValueString($image_result[$j][4], "text"),
                       GetSQLValueString($file_show_type, "int"));

          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
        $_SESSION["change_image"]=1;
    }

  //----------插入youtube封面圖片資料到資料庫end----------


	//----------插入檔案資料到資料庫begin(須放入插入主資料後)----------
   			//echo file_process();


			$file_result=file_process("rooms","add");

			//echo count($file_result);



		for($j=0;$j<count($file_result);$j++)
		{
			  $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_type, file_d_id, file_title) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($file_result[$j][0], "text"),
                       GetSQLValueString($file_result[$j][1], "text"),
                       GetSQLValueString("file", "text"),
                       GetSQLValueString($_POST['d_id'], "int"),
                       GetSQLValueString($file_result[$j][2], "text"));

  			  mysql_select_db($database_connect2data, $connect2data);
  			  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
		}

  $_SESSION['original_selected']=$_SESSION['selected_rooms'];

  //$updateGoTo = "rooms_list.php?selected1=".$class2."&selected2=".$class3."&changeSort=1&change_num=".$_POST['term_order']."&now_d_id=".$_POST['d_id']."&totalRows_Recrooms=".$_SESSION['totalRows']."&pageNum=".$_SESSION["ToPage"];
  $updateGoTo = "rooms_list.php?selected1=".$G_selected1."&changeSort=1&change_num=".$_POST['term_order']."&now_d_id=".$d_id."&totalRows_Recrooms=".$_SESSION['totalRows']."&pageNum=".$_SESSION["ToPage"];

  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING']."&pageNum=".$_SESSION["ToPage"];
  }


  if($image_result[0][0]==1)
  {
		echo "<script type=\"text/javascript\">call_alert('".$updateGoTo."');</script>";
  }else
  {
  		header(sprintf("Location: %s", $updateGoTo));
  }
}
?>
<?php
mysql_free_result($Recrooms);
mysql_free_result($RecroomsT);
?>
