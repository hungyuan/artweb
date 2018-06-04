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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recrooms = 20;
$pageNum = 0;
if (isset($_GET['pageNum'])) {
  $pageNum = $_GET['pageNum'];
}
$startRow_Recrooms = $pageNum * $maxRows_Recrooms;

mysql_select_db($database_connect2data, $connect2data);
$query_RecroomsT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='rooms' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecroomsT = mysql_query($query_RecroomsT, $connect2data) or die(mysql_error());
$row_RecroomsT = mysql_fetch_assoc($RecroomsT);
$totalRows_RecroomsT = mysql_num_rows($RecroomsT);

$G_selected1 = '';
$SDSQL = '';
if(isset($_GET['selected1']) && $_GET['selected1']!=''){

	if($_GET['selected1']!=0){
		$_SESSION['selected_roomsT'] = $G_selected1 = $_GET['selected1'];
		$SDSQL = " AND T.term_id='$G_selected1'";
	}else{
		$_SESSION['selected_roomsT'] = $G_selected1 = $_GET['selected1'];
		$SDSQL = '';
	}

}/*else
{
	$G_selected1 = $_SESSION['selected_roomsT'] = $row_RecroomsT['term_id'];
}*/

mysql_select_db($database_connect2data, $connect2data);
$query_Recrooms = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
WHERE TR.term_taxonomy_id = T.term_id AND D_class1 = 'rooms' AND D.d_id = TR.object_id $SDSQL GROUP BY D.d_id ORDER BY term_order ASC, d_date DESC";
$query_limit_Recrooms = sprintf("%s LIMIT %d, %d", $query_Recrooms, $startRow_Recrooms, $maxRows_Recrooms);
$Recrooms = mysql_query($query_limit_Recrooms, $connect2data) or die(mysql_error());
$row_Recrooms = mysql_fetch_assoc($Recrooms);
//$_SESSION['selected_rooms']=$G_selected2;
//echo $query_Recrooms;

if (isset($_GET['totalRows_Recrooms'])) {
  $S_original_selected='';
  if(isset($_SESSION['original_selected'])){
  	$S_original_selected = $_SESSION['original_selected'];
  }
 /*if(isset($_GET['selected2']) && $_GET['selected2']!=''){
	$G_selected2 = $_GET['selected2'];
  } */
	  if($S_original_selected==$G_selected1)
		{
			$totalRows_Recrooms = $_GET['totalRows_Recrooms'];
		}else
		{
			$all_Recrooms = mysql_query($query_Recrooms);
 	  		$totalRows_Recrooms = mysql_num_rows($all_Recrooms);
		}
	} else {
	  $all_Recrooms = mysql_query($query_Recrooms);
 	  $totalRows_Recrooms = mysql_num_rows($all_Recrooms);
	}
	$all_Recrooms = mysql_query($query_Recrooms);
 	$totalRows_Recrooms = mysql_num_rows($all_Recrooms);
	$totalPages_Recrooms = ceil($totalRows_Recrooms/$maxRows_Recrooms)-1;
	$TotalPage = $totalPages_Recrooms;

$queryString_Recrooms = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum") == false &&
        stristr($param, "totalRows_Recrooms") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recrooms = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recrooms = sprintf("&totalRows_Recrooms=%d%s", $totalRows_Recrooms, $queryString_Recrooms);
 $menu_is="rooms";?>
 <?php
    $R_pageNum = 0;
 if (isset($_REQUEST["pageNum"]))
 {
 	$R_pageNum = $_REQUEST["pageNum"];
 }
      if (! isset($R_pageNum))
      {
	  	$_SESSION["ToPage"]=0;
	  }
 	  //若指定分頁數小於1則預設顯示第一頁
  	  else if ($R_pageNum<0)
      {
	  	$_SESSION["ToPage"]=0;
      }
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
 	  else if ($R_pageNum>$totalPages_Recrooms)
      {
	  	$_SESSION["ToPage"]=$TotalPage;
	  }
	  else
	  {
	  	$_SESSION["ToPage"]=$R_pageNum;
 	  }
?>
<?php
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
	if($R_pageNum>$totalPages_Recrooms && $R_pageNum!=0)
	{
		header("Location:rooms_list.php?pageNum=".$totalPages_Recrooms);
	}


?>
  <?php
//修改排序
$G_changeSort = 0;
$G_delchangeSort = 0;
if (isset($_GET['changeSort']))
{
	$G_changeSort = $_GET['changeSort'];
}
if (isset($_GET['delchangeSort']))
{
	$G_delchangeSort = $_GET['delchangeSort'];
}
if ($G_changeSort==1||$G_delchangeSort==1)
{
	$sort_num=1;

	//echo "now_d_id=".$_GET['now_d_id'];
	//echo "change_num=".$_GET['change_num'];

	mysql_select_db($database_connect2data, $connect2data);

	$query_Recrooms = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND T.term_id='$G_selected1' ORDER BY term_order ASC, d_date DESC";
	$_SESSION['selected_roomsT']=$G_selected1;

	$Recrooms = mysql_query($query_Recrooms, $connect2data) or die(mysql_error());
	$row_Recrooms = mysql_fetch_assoc($Recrooms);
	//echo '<br>query 2 = '.$query_Recrooms.'<br>';

	do{
		//echo 'd_id = >'.$row_Recrooms['d_id'].' term_order =>'.$row_Recrooms['term_order'].', sort_num =>'.$sort_num.'<br>';
		if($row_Recrooms['term_order']==0)
		{}
		else if($row_Recrooms['d_id']==$_GET['now_d_id'])
		{
			//echo 'sort_num(now_d_id) = '.$sort_num."<br/>";

		}else if($sort_num==$_GET['change_num'])
		{
			//echo 'sort_num(change_num) = '.$sort_num."<br/>";
			$sort_num++;

			$updateSQL = sprintf("UPDATE term_relationships SET term_order=%s WHERE object_id=%s AND term_taxonomy_id=%s ",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_Recrooms['d_id'], "int"),
			   GetSQLValueString($row_Recrooms['term_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

			$sort_num++;
		}
		else
		{
			$updateSQL = sprintf("UPDATE term_relationships SET term_order=%s WHERE object_id=%s AND term_taxonomy_id=%s ",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_Recrooms['d_id'], "int"),
			   GetSQLValueString($row_Recrooms['term_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

			echo $sort_num."<br/>";
			echo $row_Recrooms['d_title']."->".$sort_num."<br/>";

			$sort_num++;
		}


	//echo " ".$row_Recrooms['term_order'].'<br>';
	}while ($row_Recrooms = mysql_fetch_assoc($Recrooms));


			$updateSQL = sprintf("UPDATE term_relationships SET term_order=%s WHERE object_id=%s AND term_taxonomy_id=%s ",
			   GetSQLValueString($_GET['change_num'], "int"),
			   GetSQLValueString($_GET['now_d_id'], "int"),
			   GetSQLValueString($G_selected1, "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

			//echo $updateSQL;
	if($G_changeSort==1)
	{
		/*if(isset($_GET['selected2']))
		{
		$G_selected2 = $_GET['selected2'];*/
		if(isset($_GET['now_d_id'])){
			header("Location:rooms_list.php?selected1=".$G_selected1."&pageNum=".$_GET['pageNum']."&totalRows_Recrooms=".$_GET['totalRows_Recrooms']."#".$_GET['now_d_id']);
		}else{
			header("Location:rooms_list.php?selected1=".$G_selected1."&pageNum=".$_GET['pageNum']."&totalRows_Recrooms=".$_GET['totalRows_Recrooms']);
		}
		/*}else
		{
			header("Location:rooms_list.php?selected1=".$row_RecroomsT['term_id']."&pageNum=".$_GET['pageNum']."&totalRows_Recrooms=".$_GET['totalRows_Recrooms']);
		}*/

	}else if($G_delchangeSort==1)
	{
		/*if(isset($_GET['selected2']))
		{
		$G_selected2 = $_GET['selected2'];*/
			header("Location:rooms_list.php?selected1=".$G_selected1."&pageNum=".$_GET['pageNum']);
		/*}else
		{
			header("Location:rooms_list.php?selected=".$row_RecroomsT['term_id']."&pageNum=".$_GET['pageNum']);
		}*/
	}
}
//echo 'selected_roomsT = '.$_SESSION['selected_roomsT'];
?>
<?php
require_once('display_page.php');
require_once('../js/fun_moneyFormat.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>無標題文件</title>
<style>
.chosen-choices {
	position: relative;
	/*overflow: hidden;*/
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	margin: 0;
	padding: 0;
	width: 100%;
	height: auto !important;
	height: 1%;
}
.chosen-choices li.search-choice {
	position: relative;
	margin: 3px 5px 3px 0px;
	padding: 3px 5px;
	border: 1px solid #aaa;
	border-radius: 3px;
	background-color: #e4e4e4;
	background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(20%, #f4f4f4), color-stop(50%, #f0f0f0), color-stop(52%, #e8e8e8), color-stop(100%, #eeeeee));
	background-image: -webkit-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
	background-image: -moz-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
	background-image: -o-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
	background-image: linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
	background-clip: padding-box;
	box-shadow: 0 0 2px white inset, 0 1px 0 rgba(0, 0, 0, 0.05);
	color: #333;
	line-height: 13px;
}
.chosen-choices li {
	list-style: none;
}
</style>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--
function changeSort(pageNum, totalRows_Recrooms, now_d_id, change_num, selected1) { //v1.0
 window.location.href="rooms_list.php?selected1="+selected1+"&changeSort=1"+"&now_d_id="+now_d_id+"&change_num="+change_num+"&pageNum="+pageNum+"&totalRows_Recrooms="+totalRows_Recrooms;
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
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    	<tr>
        	<td width="150" class="list_title">列表</td>
        	<td width="874"><span class="table_data">分類：
<label>
<select name="select1" id="select1">
<option value="0" <?php if (!(strcmp(0, $G_selected1))) {echo "selected=\"selected\"";} ?>>ALL</option>

<?php
do {
?>
<option value="<?php echo $row_RecroomsT['term_id']?>"<?php if (!(strcmp($row_RecroomsT['term_id'], $G_selected1))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecroomsT['name']?><?php //echo $row_RecroomsT['term_id']?></option>
<?php
} while ($row_RecroomsT = mysql_fetch_assoc($RecroomsT));
  $rows = mysql_num_rows($RecroomsT);
  if($rows > 0) {
      mysql_data_seek($RecroomsT, 0);
	  $row_RecroomsT = mysql_fetch_assoc($RecroomsT);
  }
?>
</select>
</label>

        	</span><span class="no_data">
        	    <?php if ($totalRows_Recrooms == 0) { // Show if recordset empty ?>
        	      <strong>此分類沒有資料</strong>
        	      <?php } // Show if recordset empty ?>
            </span> </td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
    	<tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <?php
	displayPages($pageNum, $queryString_Recrooms, $totalPages_Recrooms, $totalRows_Recrooms, $currentPage);
	?>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_Recrooms > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum+1)."/".($totalPages_Recrooms+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_Recrooms ?> </td>
            <td width="24" align="right">&nbsp;</td>
     	</tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
	<form action="rooms_process.php" method="post" name="form1" id="form1">
      <?php if ($totalRows_Recrooms > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
          <tr>
            <td width="140" align="center" class="table_title">新增日期</td>
            <td width="60" align="center" class="table_title">排序</td>
            <td align="center" class="table_title">名稱</td>
            <td width="160" align="center" class="table_title">分類標籤</td>
            <!-- <td width="100" align="center" class="table_title">封面格式</td> -->
            <td width="90" align="center" class="table_title">圖片</td>
            <td width="40" align="center" class="table_title">狀態</td>
            <td width="40" align="center" class="table_title">編輯</td>
            <td width="40" align="center" class="table_title">刪除</td>
          </tr>
          <?php
    	$i=0;//加上i
  		do {
  		if ($i%2==0)
		{
		$i=$i+1;
		echo "<tr>";}
		else
		{
		$i=$i+1;
		echo "<tr bgcolor='#E4E4E4'>";}
  		?>
          <?php
		mysql_select_db($database_connect2data, $connect2data);
		$query_RecImage = "SELECT * FROM file_set  WHERE file_type='roomsCover' AND file_d_id = ".$row_Recrooms['d_id'];
		$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
		$row_RecImage = mysql_fetch_assoc($RecImage);
		$totalRows_RecImage = mysql_num_rows($RecImage);
		//echo 'totalRows_RecImage'.$totalRows_RecImage;
		?>


      <td align="center" class="table_data" ></a><a href="rooms_edit.php?d_id=<?php echo $row_Recrooms['d_id']; ?>"><?php echo $row_Recrooms['d_date']; ?></a></td>
  <td align="center" class="table_data" ><label>
        <select name="sort" id="sort" onchange="changeSort('<?php echo $pageNum; ?>','<?php echo $totalRows_Recrooms; ?>','<?php echo $row_Recrooms['d_id']; ?>',this.options[this.selectedIndex].value,'<?php if(isset($G_selected1)){echo $G_selected1;}else{echo $row_RecroomsT['term_id'];} ?>')">
          <option value="0" <?php if (!(strcmp(0, $row_Recrooms['term_order']))) {echo "selected=\"selected\"";} ?>>至頂</option>
          <?php

          for($j=1;$j<=($totalRows_Recrooms);$j++)
          {
          	echo "<option value=\"".$j."\" ";
			if (!(strcmp($j, $row_Recrooms['term_order']))) {echo "selected=\"selected\"";}
			echo ">".$j."</option>";
          }
		  ?>
        </select>
        </label><?php $_SESSION['totalRows']=$totalRows_Recrooms; ?></td>

      <td align="center" class="table_data" ><a href="rooms_edit.php?d_id=<?php echo $row_Recrooms['d_id']; ?>"><?php echo $row_Recrooms['d_title']; ?></a></td>

      <td align="center" class="table_data" ><a href="rooms_edit.php?d_id=<?php echo $row_Recrooms['d_id']; ?>"><ul class="chosen-choices">
	  <?php
	  do {
	$selA = explode(',',$row_Recrooms['d_tag']);
	if (in_array($row_RecroomsT['term_id'], $selA)){
		echo '<li class="search-choice"><span>'.$row_RecroomsT['name'].'</span></li>';
	}

} while ($row_RecroomsT = mysql_fetch_assoc($RecroomsT));
  $rows = mysql_num_rows($RecroomsT);
  if($rows > 0) {
      mysql_data_seek($RecroomsT, 0);
	  $row_RecroomsT = mysql_fetch_assoc($RecroomsT);
  }

	  				/*$d_new_product = "無";
				  if (!(strcmp($row_Recrooms['d_new_product'],"0"))) {
					  $d_new_product = "無";
					}elseif (!(strcmp($row_Recrooms['d_new_product'],"1"))) {
					  $d_new_product = "主力商品";
					}elseif (!(strcmp($row_Recrooms['d_new_product'],"2"))) {
					  $d_new_product = "熱賣商品";
					}elseif (!(strcmp($row_Recrooms['d_new_product'],"3"))) {
					  $d_new_product = "新商品";
					}
					echo $d_new_product;*/
				  ?></ul>
                  </a></td>

              <!--     封面格式start -->
<!--      <td align="center" class="table_data" ><a href="rooms_edit.php?d_id=<?php echo $row_Recrooms['d_id']; ?>">
 -->
		<?php
		// echo $row_RecImage['file_width'].'*'.$row_RecImage['file_height'];
		?>

  <!--       </a></td> -->
    <!--     封面格式end -->
    <td align="center"  class="table_data">
    <a name="<?php echo $row_Recrooms['d_id']; ?>" id="<?php echo $row_Recrooms['d_id']; ?>">
    <a href="rooms_edit.php?d_id=<?php echo $row_Recrooms['d_id']; ?>#imageEdit"><img src="<?php if($totalRows_RecImage==0){echo "image/default_image_s.jpg";}else{echo "../".$row_RecImage['file_link2'].'?'.(mt_rand(1,100000)/100000);} ?>" alt="" class="image_frame" /></a></td>

    <!--<td align="center"  class="table_data"><a href="rooms_process.php?d_id=<?php //echo $row_Recrooms['d_id']; ?>&d_new_product=<?php //echo $row_Recrooms['d_new_product']; ?>"><?php echo ($row_Recrooms['d_new_product']==1)?"新品":"非新品";?></a></td>-->
    <td align="center"  class="table_data"><?php  //list使用
				if($row_Recrooms['d_active'])
				{
					echo "<a href='".$row_Recrooms['d_active']."' rel='".$row_Recrooms['d_id']."' class='activeCh'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
				}
				else
				{
					echo "<a href='".$row_Recrooms['d_active']."' rel='".$row_Recrooms['d_id']."' class='activeCh'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
				}

?></td>
    <td align="center" class="table_data"><a href="rooms_edit.php?d_id=<?php echo $row_Recrooms['d_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
    <td align="center" class="table_data"><a href="rooms_del.php?d_id=<?php echo $row_Recrooms['d_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
  </tr>
  <?php } while ($row_Recrooms = mysql_fetch_assoc($Recrooms)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
        <tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <?php
	displayPages($pageNum, $queryString_Recrooms, $totalPages_Recrooms, $totalRows_Recrooms, $currentPage);
	?>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_Recrooms > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum+1)."/".($totalPages_Recrooms+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_Recrooms ?> </td>
            <td width="24" align="right">&nbsp;</td>
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
mysql_free_result($Recrooms);

mysql_free_result($RecroomsT);
?>

<script type="text/javascript">
$(document).ready(function() {
	$('#select1').change(function() {
		//alert($(this).val());
		window.location.href = "rooms_list.php?selected1="+$(this).val();
	});

});
</script>