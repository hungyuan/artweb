<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('imagesSize.php'); ?>
<?php
	//echo $_SESSION['nowMenu'];
switch($_SESSION['nowMenu']){
	case "banners":
	case "news":
	require_once('photo_process_banners.php');
	$fileType 	= "file_type='image' AND";
	$format = 'newsCover1';
	$not		= $imagesSize[$_SESSION['nowMenu']]['note'];
	$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
	$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
	break;

	case "menu":
	require_once('photo_process_banners.php');
	$fileType 	= "file_type='image' AND";
	$not		= $imagesSize[$_SESSION['nowMenu']]['note'];
	$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
	$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
	break;

	case "award":
	require_once('photo_process_banners.php');
	$fileType 	= "file_type='image' AND";
	$not		= $imagesSize[$_SESSION['nowMenu']]['note'];
	$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
	$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
	break;

	case "farmerterm":
	require_once('photo_process.php');
	$fileType 	= "file_type='image' AND";
	$not		= $imagesSize[$_SESSION['nowMenu']]['note'];
	$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
	$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
	break;


	case "rooms":
	require_once('photo_process_rooms.php');
	$fileType 	= "file_type='image' AND";
	$not		 = $imagesSize[$_SESSION['nowMenu']]['note'];
	$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
	$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
	break;
	case "product":
	require_once('photo_process_banners.php');
	$fileType 	= "file_type='image' AND";
	$not		 = $imagesSize[$_SESSION['nowMenu']]['note'];
	$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
	$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
	break;

	default:
	require_once('photo_process.php');
	$fileType 	= "file_type='image' AND";
	$not		 = $imagesSize[$_SESSION['nowMenu']]['note'];
	$IWidth		= $imagesSize[$_SESSION['nowMenu']]['IW'];
	$IHeight	= $imagesSize[$_SESSION['nowMenu']]['IH'];
}

if($_SESSION['nowMenu']=="farmer"){
	if (isset($_REQUEST['type']) && ($_REQUEST['type']=="personal")){
		$fileType = "file_type='imageP' AND";
	}
}
//echo $_SESSION['nowMenu'].'<br>';
if (isset($_REQUEST['type']) && $_REQUEST['type']=='teamMemberList'){
	$type = $_REQUEST['type'];
	$fileType 	= "file_type='teamMemberListImage' AND";
	$not		 = $imagesSize['teamMemberList']['note'];
	$IWidth		= $imagesSize['teamMemberList']['IW'];
	$IHeight	= $imagesSize['teamMemberList']['IH'];
}elseif (isset($_REQUEST['type']) && $_REQUEST['type']=='roomsCover'){
	$type = $_REQUEST['type'];
	$fileType 	= "file_type='roomsCover' AND";
	$not		 = $imagesSize['roomsCover']['note'];
	$IWidth		= $imagesSize['roomsCover']['IW'];
	$IHeight	= $imagesSize['roomsCover']['IH'];
}elseif (isset($_REQUEST['type']) && $_REQUEST['type']=='newsCover'){
	$type = $_REQUEST['type'];
	$fileType 	= "file_type='newsCover' AND";
	$not		 = $imagesSize['newsCover']['note'];
	$IWidth		= $imagesSize['newsCover']['IW'];
	$IHeight	= $imagesSize['newsCover']['IH'];
}elseif (isset($_REQUEST['type']) && $_REQUEST['type']=='peopleC'){
	$type = $_REQUEST['type'];
	$fileType 	= "file_type='peopleC' AND";
	$not		 = "圖片請上傳寬 1100pixel、高 390pixel之圖檔。<BR>每次上傳之檔案大小總計請勿超過2M。";
	$IWidth		= "1100";
	$IHeight	= "390";
}elseif (isset($_REQUEST['type']) && $_REQUEST['type']=='homeC'){
	$type = $_REQUEST['type'];
	$fileType 	= "file_type='homeC' AND";
	$not		 = "圖片請上傳寬 1100pixel、高 390pixel之圖檔。<BR>每次上傳之檔案大小總計請勿超過2M。";
	$IWidth		= "1100";
	$IHeight	= "390";
}elseif (isset($_REQUEST['type']) && $_REQUEST['type']=='societyC'){
	$type = $_REQUEST['type'];
	$fileType 	= "file_type='societyC' AND";
	$not		 = "圖片請上傳寬 1100pixel、高 390pixel之圖檔。<BR>每次上傳之檔案大小總計請勿超過2M。";
	$IWidth		= "1100";
	$IHeight	= "390";
}elseif (isset($_REQUEST['type']) && $_REQUEST['type']=='peopleC_mobile'){
	$type = $_REQUEST['type'];
	$fileType 	= "file_type='peopleC_mobile' AND";
	$not		 = $imagesSize['peopleC']['note'];
	$IWidth		= $imagesSize['peopleC']['IW'];
	$IHeight	= $imagesSize['peopleC']['IH'];
}elseif (isset($_REQUEST['type']) && $_REQUEST['type']=='reportingVideoCover'){

	$type = $_REQUEST['type'];
	$fileType 	= "file_type='reportingVideoCover' AND";
	$not		 = $imagesSize['reportingVideoCover']['note'];
	$IWidth		= $imagesSize['reportingVideoCover']['IW'];
	$IHeight	= $imagesSize['reportingVideoCover']['IH'];
// }elseif (isset($_REQUEST['format'])){
// 	$file_show_type = $_REQUEST['format'];

// 	if($_SESSION['nowMenu']=='news'){
// 		switch ($file_show_type) {
// 			case '1':
// 				$format = 'newsCover1';
// 				$f = '一個單位';
// 				break;
// 			case '2':
// 				$format = 'newsCover2';
// 				$f = '二個單位';
// 				break;
// 			default:
// 				$format = 'newsCover1';
// 				$f = '一個單位';
// 		}
// 		$not		 = '選擇的封面圖片格式為<b class="red_letter">'.$f.'</b>。<br>'.$imagesSize[$format]['note'];
// 	}


// 	$IWidth		= $imagesSize[$format]['IW'];
// 	$IHeight	= $imagesSize[$format]['IH'];

}else{
	$type = '-1';
}
//echo $type;
?>
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

	$file_show_type = (isset($_POST['file_show_type'])) ? $_POST['file_show_type'] : NULL;
	$file_width = (isset($_POST['file_width'])) ? $_POST['file_width'] : NULL;
	$file_height = (isset($_POST['file_height'])) ? $_POST['file_height'] : NULL;

	$updateSQL = sprintf("UPDATE file_set SET file_title=%s, file_content=%s, file_show_type=%s, file_width=%s, file_height=%s WHERE $fileType file_id=%s",
		GetSQLValueString($_POST['file_title'], "text"),
		GetSQLValueString($_POST['file_content'], "text"),
		GetSQLValueString($file_show_type, "int"),
		GetSQLValueString($file_width, "int"),
		GetSQLValueString($file_height, "int"),
		GetSQLValueString($_POST['file_id'], "int"));

	mysql_select_db($database_connect2data, $connect2data);
	$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

      //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
   			//echo image_process();

	if (isset($_REQUEST['type']) && $_REQUEST['type']=='fuckyou'){


		switch ($file_show_type) {
			case '1':
			$format = 'newsCover1';
			break;
			case '2':
			$format = 'newsCover2';
			break;
			default:
			$format = 'newsCover1';
		}

		$image_result=image_process($_FILES['image'], $_REQUEST['file_title'], "newsCover","edit", $imagesSize[$format]['IW'], $imagesSize[$format]['IH']);


	// }elseif($_SESSION['nowMenu']=='collection'){

	// 	$image_result=image_process($_FILES['image'], $_REQUEST['file_title'], $_REQUEST['file_content'], $_SESSION['nowMenu'], "edit", $IWidth, $IHeight);

	}elseif (isset($_REQUEST['type']) && $_REQUEST['type']=='newsCover'){

		$image_result=image_process($_FILES['image'], $_REQUEST['file_title'], 'newsCover', "edit", $IWidth, $IHeight);

	}else{

		$image_result=image_process($_FILES['image'], $_REQUEST['file_title'], $_SESSION['nowMenu'], "edit", $IWidth, $IHeight);

	}

	//echo 'IWidth = '.$IWidth.'<br>';
	//echo 'IHeight = '.$IHeight.'<br>';

		//echo count($image_result);
		//echo $image_result[0][0];

		//刪除圖片真實檔案begin----
	if(count($image_result)==2)
	{
			//$sql="SELECT file_link1 FROM file_set WHERE file_id='".$_POST['file_id']."'";
		$sql="SELECT file_link1 FROM file_set WHERE ".$fileType." file_id='".$_POST['file_id']."'";

		$result = mysql_query($sql)or die("無法送出".mysql_error( ));
		while ( $row = mysql_fetch_array($result))
		{
				//echo $image_result[1][1]."<br>";
				//echo $row[0]."<BR>";
			if($image_result[1][1]==$row[0])
			{}
		else
		{
			if ( (isset($row[0])) && file_exists("../".$row[0]) ) {
						unlink("../".$row[0]);//刪除檔案
					}
				}
			}

			//$sql="SELECT file_link2 FROM file_set WHERE file_id='".$_POST['file_id']."'";
			$sql="SELECT file_link2 FROM file_set WHERE ".$fileType." file_id='".$_POST['file_id']."'";

			$result = mysql_query($sql)or die("無法送出".mysql_error( ));
			while ( $row = mysql_fetch_array($result))
			{
				//echo $image_result[1][2]."<br>";
				//echo $row[0]."<BR>";
				if($image_result[1][2]==$row[0])
				{}
			else
			{
				if ( (isset($row[0])) && file_exists("../".$row[0]) ) {
						unlink("../".$row[0]);//刪除檔案
					}
				}
			}

			//$sql="SELECT file_link2 FROM file_set WHERE file_id='".$_POST['file_id']."'";
			$sql="SELECT file_link3 FROM file_set WHERE ".$fileType." file_id='".$_POST['file_id']."'";

			$result = mysql_query($sql)or die("無法送出".mysql_error( ));
			while ( $row = mysql_fetch_array($result))
			{
				//echo $image_result[1][2]."<br>";
				//echo $row[0]."<BR>";
				if($image_result[1][3]==$row[0])
				{}
			else
			{
				if ( (isset($row[0])) && file_exists("../".$row[0]) ) {
						unlink("../".$row[0]);//刪除檔案
					}
				}
			}

			//$sql="SELECT file_link2 FROM file_set WHERE file_id='".$_POST['file_id']."'";
			$sql="SELECT file_link4 FROM file_set WHERE ".$fileType." file_id='".$_POST['file_id']."'";

			$result = mysql_query($sql)or die("無法送出".mysql_error( ));
			while ( $row = mysql_fetch_array($result))
			{
				//echo $image_result[1][2]."<br>";
				//echo $row[0]."<BR>";
				if($image_result[1][6]==$row[0])
				{}
			else
			{
				if ( (isset($row[0])) && file_exists("../".$row[0]) ) {
						unlink("../".$row[0]);//刪除檔案
					}
				}
			}
			$sql="SELECT file_link5 FROM file_set WHERE ".$fileType." file_id='".$_POST['file_id']."'";

			$result = mysql_query($sql)or die("無法送出".mysql_error( ));
			while ( $row = mysql_fetch_array($result))
			{
				//echo $image_result[1][2]."<br>";
				//echo $row[0]."<BR>";
				if($image_result[1][8]==$row[0])
				{}
			else
			{
				if ( (isset($row[0])) && file_exists("../".$row[0]) ) {
						unlink("../".$row[0]);//刪除檔案
					}
				}
			}
		}
		//刪除圖片真實檔案end----

		for($j=1;$j<count($image_result);$j++)
		{
			/*if($_SESSION['nowMenu']=='brands'){
				$fileType = "file_type='brandImage' AND";
			}else{
				$fileType = "file_type='image' AND";
			}*/
			//if($_SESSION['nowMenu']=='products'){

			$insertSQL = sprintf("UPDATE file_set SET file_name=%s, file_link1=%s, file_link2=%s, file_link3=%s, file_link4=%s, file_link5=%s, file_show_type=%s, file_width=%s, file_height=%s WHERE $fileType file_id=%s" ,
				GetSQLValueString($image_result[$j][0], "text"),
				GetSQLValueString($image_result[$j][1], "text"),
				GetSQLValueString($image_result[$j][2], "text"),
				GetSQLValueString($image_result[$j][3], "text"),
				GetSQLValueString($image_result[$j][6], "text"),
				GetSQLValueString($image_result[$j][8], "text"),
				GetSQLValueString($file_show_type, "text"),
				GetSQLValueString($file_width, "int"),
				GetSQLValueString($file_height, "int"),
				GetSQLValueString($_POST['file_id'], "int"));

			/*}else{

				$insertSQL = sprintf("UPDATE file_set SET file_name=%s, file_link1=%s, file_link2=%s WHERE $fileType file_id=%s" ,
                       GetSQLValueString($image_result[$j][0], "text"),
                       GetSQLValueString($image_result[$j][1], "text"),
                       GetSQLValueString($image_result[$j][2], "text"),
					   GetSQLValueString($_POST['file_id'], "int"));

}*/

  			  //echo $insertSQL;
mysql_select_db($database_connect2data, $connect2data);
$Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

$_SESSION["change_image"]=1;
}

	//----------插入圖片資料到資料庫end----------

  /*if($_SESSION['nowMenu']=='brands'){

		$updateGoTo = $_SESSION['nowPage']."?c_id=" . $_POST['file_d_id'] . "";

	}elseif($_SESSION['nowMenu']=='brandSeries'){

		$updateGoTo = $_SESSION['nowPage']."?c_id=" . $_POST['file_d_id'] . "";

	}else{

		$updateGoTo = $_SESSION['nowPage']."?d_id=" . $_POST['file_d_id'] . "";

	}*/
	//$updateGoTo = $_SESSION['nowPage']."?d_id=" . $_POST['file_d_id'] . "";
	if($_REQUEST['type']=='peopleC' || $_REQUEST['type']=='homeC' || $_REQUEST['type']=='societyC'){
		$updateGoTo = $_SESSION['nowPage']."?c_id=" . $_POST['file_d_id'] . "";
	}else{
		$updateGoTo = $_SESSION['nowPage']."?d_id=" . $_POST['file_d_id'] . "#imageEdit";
	}
	if($_SESSION['nowMenu']=="farmerterm"){
		$updateGoTo = $_SESSION['nowPage']."?term_id=" . $_POST['file_d_id'] . "#imageEdit";}


  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
}*/
  /*echo 'nowMenu = '.$_SESSION['nowMenu'].'<br>';
  echo 'file_d_id = '.$_POST['file_d_id'].'<br>';
  echo 'updateGoTo = '.$updateGoTo.'<br>';
  echo "<script type=\"text/javascript\">call_alert('".$updateGoTo."');</script>";*/
  if($image_result[0][0]==1)
  {
  	echo "<script type=\"text/javascript\">call_alert('".$updateGoTo."');</script>";
  }else
  {
  	header(sprintf("Location: %s", $updateGoTo));
  }

}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
	$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_RecImage = "-1";
if (isset($_GET['file_id'])) {
	$colname_RecImage = $_GET['file_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecImage = sprintf("SELECT * FROM file_set WHERE $fileType file_id = %s",
	GetSQLValueString($colname_RecImage, "int"));
$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
$row_RecImage = mysql_fetch_assoc($RecImage);
$totalRows_RecImage = mysql_num_rows($RecImage);
// echo $query_RecImage;
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
			<td width="30%" class="list_title">修改圖片</td>
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
							<td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title"><span class="table_data">圖片說明</span></td>
							<td width="532"><input name="file_title" type="text" class="table_data" id="file_title" value="<?php echo $row_RecImage['file_title']; ?>" size="50">
								<input name="file_id" type="hidden" id="file_id" value="<?php echo $row_RecImage['file_id']; ?>" />
								<input name="file_d_id" type="hidden" id="file_d_id" value="<?php echo $row_RecImage['file_d_id']; ?>" /></td>
								<td width="250" bgcolor="#e5ecf6"></td>
							</tr>
							<?php if($_SESSION['nowMenu']=='collection'){ ?>
							<tr>
								<td align="center" bgcolor="#e5ecf6" class="table_col_title"><span class="table_data">圖片說明</span></td>
								<td><textarea name="file_content" cols="80" rows="5" class="table_data" id="file_content"><?php echo $row_RecImage['file_content']; ?></textarea></td>
								<td bgcolor="#e5ecf6"></td>
							</tr>
							<?php } ?>
							<tr>
								<td align="center" bgcolor="#e5ecf6" class="table_col_title">目前圖片</td>
								<td><img src="../<?php echo $row_RecImage['file_link2'].'?'.(mt_rand(1,100000)/100000); ?>" alt="" class="image_frame" /></td>
								<td bgcolor="#e5ecf6" class="table_col_title"><p>&nbsp;</p></td>
							</tr>

							<!--     newsCover  satart -->
							<?php if($type=='internationalCover' || $type=='workCover' || $type=='reportingCover' || $type=='productCover'){ ?>
							<tr>
								<td align="center" bgcolor="#e5ecf6" class="table_col_title">寬度格式</td>
								<td>
									<label>
										<select name="file_width" class="table_data" id="file_width">
											<option value="1" <?php if (!(strcmp(1, $row_RecImage['file_width']))) {echo "selected=\"selected\"";} ?>>1個單位</option>
											<option value="2" <?php if (!(strcmp(2, $row_RecImage['file_width']))) {echo "selected=\"selected\"";} ?>>2個單位</option>
											<option value="3" <?php if (!(strcmp(3, $row_RecImage['file_width']))) {echo "selected=\"selected\"";} ?>>3個單位</option>
										</select>
									</label>
								</td>
								<td bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
							</tr>
							<tr>
								<td align="center" bgcolor="#e5ecf6" class="table_col_title">長度格式</td>
								<td>
									<label>
										<select name="file_height" class="table_data" id="file_height">
											<option value="1" <?php if (!(strcmp(1, $row_RecImage['file_height']))) {echo "selected=\"selected\"";} ?>>1個單位</option>
											<option value="2" <?php if (!(strcmp(2, $row_RecImage['file_height']))) {echo "selected=\"selected\"";} ?>>2個單位</option>
											<option value="3" <?php if (!(strcmp(3, $row_RecImage['file_height']))) {echo "selected=\"selected\"";} ?>>3個單位</option>
										</select>
									</label>
								</td>
								<td bgcolor="#e5ecf6" class="table_col_title">&nbsp;</td>
							</tr>
							<?php } ?>
							<!--  newsCover  end -->


							<tr>
								<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>更改圖片</p>
								</td>
								<td><input name="image[]" type="file" class="table_data" id="image[]" size="50" ></td>
								<td bgcolor="#e5ecf6" class="table_col_title"><p><span class="red_letter">*<?php echo $not; ?>
								</span></p>
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
		<input type="hidden" name="type" value="<?php echo $type; ?>" />
	</form>
	<table width="100%" height="1" border="0" align="center" cellpadding="0" cellspacing="0" class="buttom_dot_line">
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
</body>
</html>


<?php
mysql_free_result($RecImage);
?>
