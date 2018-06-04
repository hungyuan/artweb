<?php require_once('../sstart.php'); ?>
<?php require_once('photo_process_banners.php'); ?>
<?php require_once('file_process.php'); ?>

<?php $editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$menu_is = "news";
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
  <script type="text/javascript">
    <!--
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
              <td width="30%" class="list_title">新增</td>
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
                <td><table width="100%" border="0" cellspacing="3" cellpadding="5">
                 <tr>
                   <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
                   <td width="532"><input name="d_title" type="text" class="table_data" id="d_title" value="" size="50" />
                    <input name="d_class1" type="hidden" id="d_class1" value="<?php echo $menu_is;?>" /></td>
                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                  </tr>

                  <tr>
                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">內容</td>
                    <td><textarea name="d_content" cols="50" rows="30" class="table_data tiny" id="d_content"></textarea></td>
                    <td bgcolor="#e5ecf6"><p class="note_letter">*小斷行請按Shift+Enter。<br />
                      輸入區域的右下角可以調整輸入空間的大小。</p></td>
                    </tr>

                    <tr>
                     <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">日期</td>
                     <td width="532"><input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo date("Y-m-d H:i:s"); ?>" size="50"></td>
                     <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                   </tr>
                   <tr>
                     <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">在網頁顯示</td>
                     <td width="532"><label>
                       <select name="d_active" class="table_data" id="d_active">
                         <option value="1">顯示</option>
                         <option value="0">不顯示</option>
                       </select></label></td>
                       <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                     </tr>


                     <tr>
                      <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳封面圖片</p>                    </td>
                      <td>
                        <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data">
                          <tr>
                            <td> <span class="table_data">選擇圖片：</span>
                              <input name="imageCover[]" type="file" class="table_data" id="imageCover1" />
                              <br>
                              <span class="table_data">圖片說明：</span>
                              <input name="image_titleCover[]" type="text" class="table_data" id="image_titleCover1">                         </td>
                            </tr>
                          </table>
                        </td>
                        <td bgcolor="#e5ecf6" class="table_col_title">
                          <p class="red_letter">*<?php echo $imagesSize['newsCover']['note'];?></p></td>
                        </tr>


                        <tr>
                          <td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳圖片</p>                    </td>
                          <td>
                            <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable">
                              <tr>
                                <td> <span class="table_data">選擇圖片：</span>
                                  <input name="image[]" type="file" class="table_data" id="image1" />
                                  <br>
                                  <span class="table_data">圖片說明：</span>
                                  <input name="image_title[]" type="text" class="table_data" id="image_title1">                         </td>
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
                                    </table>                          </td>
                                  </tr>
                                </table>

                              </td>
                              <td bgcolor="#e5ecf6" class="table_col_title">
                                <p class="red_letter">*<?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?></p></td>
                              </tr>

                              <?php if(0){ ?>
           <!--          <table width="100%" border="0" cellspacing="5" cellpadding="2">
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
                    <?php } ?>

                    </td>

                </tr>
                <?php if($ifFile){ ?>
            <tr>
              		<td align="center" bgcolor="#e5ecf6" class="table_col_title"><p>上傳檔案</p>              	    </td>
              	    <td>
                    <table border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable2">
                    	<tr>
                     		<td> <span class="table_data">選擇檔案：</span>
                        	<input name="upfile[]" type="file" class="table_data" id="upfile1" />
                        	<br>
                        	<span class="table_data">檔案說明：</span>
                        	<input name="upfile_title[]" type="text" class="table_data" id="upfile_title1">                        	</td>
                  		</tr>
                    </table>
                    <table width="100%" border="0" cellspacing="5" cellpadding="2">
                    	<tr>
                        	<td>
                        	<table border="0" cellspacing="2" cellpadding="2">
                        		<tr>
                            		<td width="16"><a href="javascript:addField2()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                	<td width="48"><a href="javascript:addField2()" class="table_data">新增檔案</a></td>
                                	<td width="390" class="red_letter">&nbsp;</td>
                            	</tr>
                        	</table>                        	</td>
                        </tr>
                    </table>                    </td>
              	    <td bgcolor="#e5ecf6" class="table_col_title"><p><span class="red_letter">*上傳之檔案請勿超過2M。</span></p>           	        </td>
                  </tr> -->
                  <?php } ?>

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
  $d_content = $_POST['d_content'];
  $insertSQL = sprintf("INSERT INTO data_set (d_title, d_content, d_class1, d_class2, d_class3, d_class4, d_class5, d_class6, d_date, d_active) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
   GetSQLValueString($_POST['d_title'], "text"),
   GetSQLValueString($d_content, "text"),
   GetSQLValueString($_POST['d_class1'], "text"),
   GetSQLValueString($_POST['d_class2'], "text"),
   GetSQLValueString($_POST['d_class3'], "text"),
   GetSQLValueString($_POST['d_class4'], "text"),
   GetSQLValueString($_POST['d_class5'], "text"),
   GetSQLValueString($_POST['d_class6'], "text"),
   GetSQLValueString($_POST['d_date'], "date"),
   GetSQLValueString($_POST['d_active'], "int"));

  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

		//----------插入圖片資料到資料庫begin(須放入插入主資料後)----------
				//echo image_process();

				$sql_max_data= "Select MAX(d_id) From data_set";//找到d_id的最大值,放入圖片資料內
				//echo $sql_max_data;
				$result_max_data=mysql_query($sql_max_data);

				if($row_max_data = mysql_fetch_array($result_max_data))
				{

					$new_data_num=$row_max_data[0];

					//echo $row_max_data[0];
				}

		//$image_result=image_process("news","add", "0", "0");
		//一般附圖
        $image_result=image_process($_FILES['image'], $_REQUEST['image_title'], $menu_is,"add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);
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
           GetSQLValueString($new_data_num, "int"),
           GetSQLValueString($image_result[$j][4], "text"),
           GetSQLValueString($image_result[$j][5], "int"));

          mysql_select_db($database_connect2data, $connect2data);
          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());

          $_SESSION["change_image"]=1;
        }



        // Cover
        //一般附圖
        $image_result=image_process($_FILES['imageCover'], $_REQUEST['image_titleCover'], "newsCover","add", $imagesSize['newsCover']['IW'], $imagesSize['newsCover']['IH']);
      //echo count($image_result);
      //echo $image_result[0][0];


        for($j=1;$j<count($image_result);$j++)
        {
          $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
           GetSQLValueString($image_result[$j][0], "text"),
           GetSQLValueString($image_result[$j][1], "text"),
           GetSQLValueString($image_result[$j][2], "text"),
           GetSQLValueString($image_result[$j][3], "text"),
           GetSQLValueString("newsCover", "text"),
           GetSQLValueString($new_data_num, "int"),
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

      $file_result=file_process("news","add");

		//echo count($file_result);


      for($j=0;$j<count($file_result);$j++)
      {
       $insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_type, file_d_id, file_title) VALUES (%s, %s, %s, %s, %s)",
         GetSQLValueString($file_result[$j][0], "text"),
         GetSQLValueString($file_result[$j][1], "text"),
         GetSQLValueString("file", "text"),
         GetSQLValueString($new_data_num, "int"),
         GetSQLValueString($file_result[$j][2], "text"));

       mysql_select_db($database_connect2data, $connect2data);
       $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
     }



	//----------插入檔案資料到資料庫end----------
   }

   $insertGoTo = "news_list.php?pageNum=0&totalRows=".($_SESSION['totalRows']+1)."&changeSort=1&now_d_id=".$new_data_num."&change_num=1";
   if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }

  if($image_result[0][0]==1)
  {
    echo "<script type=\"text/javascript\">call_alert('".$insertGoTo."');</script>";
  }else
  {
    header(sprintf("Location: %s", $insertGoTo));
  }

}
?>

