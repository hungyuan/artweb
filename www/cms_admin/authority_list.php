<?php
			if (!isset($_SESSION)) {
               session_start();
               }
            ob_start();
			
?>
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

$maxRows_RecAuthority = 10;
$pageNum_RecAuthority = 0;
if (isset($_GET['pageNum_RecAuthority'])) {
  $pageNum_RecAuthority = $_GET['pageNum_RecAuthority'];
}
$startRow_RecAuthority = $pageNum_RecAuthority * $maxRows_RecAuthority;

mysql_select_db($database_connect2data, $connect2data);
$query_RecAuthority = "SELECT * FROM `admin` ORDER BY user_id ASC";
$query_limit_RecAuthority = sprintf("%s LIMIT %d, %d", $query_RecAuthority, $startRow_RecAuthority, $maxRows_RecAuthority);
$RecAuthority = mysql_query($query_limit_RecAuthority, $connect2data) or die(mysql_error());
$row_RecAuthority = mysql_fetch_assoc($RecAuthority);

if (isset($_GET['totalRows_RecAuthority'])) {
  $totalRows_RecAuthority = $_GET['totalRows_RecAuthority'];
} else {
  $all_RecAuthority = mysql_query($query_RecAuthority);
  $totalRows_RecAuthority = mysql_num_rows($all_RecAuthority);
}
$totalPages_RecAuthority = ceil($totalRows_RecAuthority/$maxRows_RecAuthority)-1;

$queryString_RecAuthority = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecAuthority") == false && 
        stristr($param, "totalRows_RecAuthority") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecAuthority = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecAuthority = sprintf("&totalRows_RecAuthority=%d%s", $totalRows_RecAuthority, $queryString_RecAuthority);
$menu_is="authority";
 ?>
 <?php 
    $R_pageNum_RecAuthority = 0;
 if (isset($_REQUEST["pageNum_RecAuthority"])) 
 {
 	$R_pageNum_RecAuthority = $_REQUEST["pageNum_RecAuthority"];
 }
      if (! isset($R_pageNum_RecAuthority)) 
      {
	  	$_SESSION["ToPage"]=0;
	  }
 	  //若指定分頁數小於1則預設顯示第一頁
  	  else if ($R_pageNum_RecAuthority<0) 
      {
	  	$_SESSION["ToPage"]=0;
      }
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
 	  else if ($R_pageNum_RecAuthority>$totalPages_RecAuthority)
      {
	  	$_SESSION["ToPage"]=$TotalPage;
	  }
	  else
	  {
	  	$_SESSION["ToPage"]=$R_pageNum_RecAuthority;
 	  }
?>
<?php
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
	if($R_pageNum_RecAuthority>$totalPages_RecAuthority && $R_pageNum_RecAuthority!=0)
	{
		header("Location:authority_list.php?pageNum_RecAuthority=".$totalPages_RecAuthority);
	}

	
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
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    	<tr>
        	<td width="300" class="list_title">管理員列表</td>
        	<td width="724"><span class="no_data">
            <?php if ($totalRows_RecAuthority == 0) { // Show if recordset empty ?>
              <strong>抱歉!找不到任何資料~</strong>
              <?php } // Show if recordset empty ?>
</span> </td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
    	<tr>
            <td width="739" align="right" class="page_display">
<!-------顯示頁選擇與分頁設定開始---------->
    <table border="0">
      <tr>
        <td><?php if ($pageNum_RecAuthority > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecAuthority=%d%s", $currentPage, max(0, $pageNum_RecAuthority - 1), $queryString_RecAuthority); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecAuthority;//所有筆數
			//echo $totalPages_RecAuthority;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecAuthority;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecAuthority;//以字串顯示所有的筆數,如&totalRows_RecAuthority=11
			if($totalPages_RecAuthority<10)
			{
				if($totalRows_RecAuthority == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecAuthority+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecAuthority+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecAuthority=%d%s", $currentPage, $i-1, $queryString_RecAuthority);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecAuthority>10
			{
				$morePage_num=$totalPages_RecAuthority-$pageNum_RecAuthority;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecAuthority<3)
					{
						if($totalRows_RecAuthority == 0)
						{
							//如果沒有任何資料，不顯示|符號
						}
						else
						{
							echo " | ";
						}
				
						for ($i=1; $i<=10; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecAuthority+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecAuthority=%d%s", $currentPage, $i-1, $queryString_RecAuthority);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecAuthority=%d%s", $currentPage, $totalPages_RecAuthority, $queryString_RecAuthority);
							echo ">..." .($totalPages_RecAuthority+1). "</a> | " ;
					}
					else//$pageNum_RecAuthority>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecAuthority=%d%s", $currentPage, 0, $queryString_RecAuthority);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecAuthority-1; $i<=$pageNum_RecAuthority+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecAuthority+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecAuthority=%d%s", $currentPage, $i-1, $queryString_RecAuthority);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecAuthority=%d%s", $currentPage, $totalPages_RecAuthority, $queryString_RecAuthority);
						echo ">..." .($totalPages_RecAuthority+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecAuthority-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecAuthority=%d%s", $currentPage, 0, $queryString_RecAuthority);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecAuthority+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecAuthority+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecAuthority=%d%s", $currentPage, $i-1, $queryString_RecAuthority);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
				}

			}
		
		?>
        </td>
        
        <td><?php if ($pageNum_RecAuthority < $totalPages_RecAuthority) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecAuthority=%d%s", $currentPage, min($totalPages_RecAuthority, $pageNum_RecAuthority + 1), $queryString_RecAuthority); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecAuthority > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum_RecAuthority+1)."/".($totalPages_RecAuthority+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecAuthority ?> </td>
            <td width="24" align="right">&nbsp;</td>
     	</tr>
	</table>
    <table width="800" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
	<form action="authority_process.php" method="post" name="form1" id="form1">
      <?php if ($totalRows_RecAuthority > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
          <tr>
            <td width="759" align="center" class="table_title">管理員帳號</td>
            <td width="100" align="center" class="table_title">帳號是否有效</td>
            <td width="60" align="center" class="table_title">修改</td>
            <td width="60" align="center" class="table_title">刪除</td>
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
//echo $totalRows_RecImage;
		?>
        <td align="center" class="table_data" ><a href="authority_edit.php?user_id=<?php echo $row_RecAuthority['user_id']; ?>"><?php echo $row_RecAuthority['user_name']; ?></a></td>
            <td align="center"  class="table_data"><?php  //list使用
				if($row_RecAuthority['user_active'])
				{
					echo "<a href='".$row_RecAuthority['user_active']."' rel='".$row_RecAuthority['user_id']."' class='activeChU'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
				}
				else
				{
					echo "<a href='".$row_RecAuthority['user_active']."' rel='".$row_RecAuthority['user_id']."' class='activeChU'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
				}
				
?>
</td>
            <td align="center" class="table_data"><a href="authority_edit.php?user_id=<?php echo $row_RecAuthority['user_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
            <td align="center" class="table_data">
            <?php if( $row_RecAuthority['user_limit']!=1 ){?>
            <a href="authority_del.php?user_id=<?php echo $row_RecAuthority['user_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a>
            <?php 
				}else{
					echo '不可刪除';
				}
			 ?>
            </td>
          </tr>
          <?php } while ($row_RecAuthority = mysql_fetch_assoc($RecAuthority)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
    	<tr>
            <td width="739" align="right" class="page_display">
<!-------顯示頁選擇與分頁設定開始---------->
    <table border="0">
      <tr>
        <td><?php if ($pageNum_RecAuthority > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RecAuthority=%d%s", $currentPage, max(0, $pageNum_RecAuthority - 1), $queryString_RecAuthority); ?>"><</a>
              <?php } // Show if not first page ?>
        </td>
        
        <td>
        <?php
			//echo $totalRows_RecAuthority;//所有筆數
			//echo $totalPages_RecAuthority;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecAuthority;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecAuthority;//以字串顯示所有的筆數,如&totalRows_RecAuthority=11
			if($totalPages_RecAuthority<10)
			{
				if($totalRows_RecAuthority == 0)
				{
					//如果沒有任何資料，不顯示|符號
				}
				else
				{
					echo " | ";
				}
				
				for ($i=1; $i<=$totalPages_RecAuthority+1; $i++)
				{
				  //如果非正在顯示的分頁則建立頁碼連結
				  if ($i != $pageNum_RecAuthority+1 )
				  { 
					
					echo "<a href=";
					printf("%s?pageNum_RecAuthority=%d%s", $currentPage, $i-1, $queryString_RecAuthority);
					echo ">" . $i . "</a> | " ;
				  }
				  //如果是正在顯示的方頁則單純顯示頁碼
				  else
				  { 
					echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
				  }
				}
			}
			else//$totalPages_RecAuthority>10
			{
				$morePage_num=$totalPages_RecAuthority-$pageNum_RecAuthority;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecAuthority<3)
					{
						if($totalRows_RecAuthority == 0)
						{
							//如果沒有任何資料，不顯示|符號
						}
						else
						{
							echo " | ";
						}
				
						for ($i=1; $i<=10; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecAuthority+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecAuthority=%d%s", $currentPage, $i-1, $queryString_RecAuthority);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
							echo "<a href=";
							printf("%s?pageNum_RecAuthority=%d%s", $currentPage, $totalPages_RecAuthority, $queryString_RecAuthority);
							echo ">..." .($totalPages_RecAuthority+1). "</a> | " ;
					}
					else//$pageNum_RecAuthority>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecAuthority=%d%s", $currentPage, 0, $queryString_RecAuthority);
						echo ">" . 1 . "...</a> | " ;
												
						for ($i=$pageNum_RecAuthority-1; $i<=$pageNum_RecAuthority+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecAuthority+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecAuthority=%d%s", $currentPage, $i-1, $queryString_RecAuthority);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						  }
						}
						
						echo "<a href=";
						printf("%s?pageNum_RecAuthority=%d%s", $currentPage, $totalPages_RecAuthority, $queryString_RecAuthority);
						echo ">..." .($totalPages_RecAuthority+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
						$beforePage_num=9-$morePage_num;
						$beforePage=$pageNum_RecAuthority-$beforePage_num;
						
						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";
						
						echo "<a href=";
						printf("%s?pageNum_RecAuthority=%d%s", $currentPage, 0, $queryString_RecAuthority);
						echo ">" . 1 . "...</a> | " ;
							
						for ($i=$beforePage+1; $i<=$totalPages_RecAuthority+1; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
						  if ($i != $pageNum_RecAuthority+1 )
						  { 
							
							echo "<a href=";
							printf("%s?pageNum_RecAuthority=%d%s", $currentPage, $i-1, $queryString_RecAuthority);
							echo ">" . $i . "</a> | " ;
						  }
						  //如果是正在顯示的方頁則單純顯示頁碼
						  else
						  { 
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;

						  }
						}
				}

			}
		
		?>
        </td>
        
        <td><?php if ($pageNum_RecAuthority < $totalPages_RecAuthority) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RecAuthority=%d%s", $currentPage, min($totalPages_RecAuthority, $pageNum_RecAuthority + 1), $queryString_RecAuthority); ?>">></a>
              <?php } // Show if not last page ?>
        </td>
 <?php ?>      
        
        

      </tr>
    </table>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecAuthority > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum_RecAuthority+1)."/".($totalPages_RecAuthority+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecAuthority ?> </td>
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
mysql_free_result($RecAuthority);
?>
