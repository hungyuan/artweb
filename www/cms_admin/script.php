<?php require_once('../Connections/connect2data.php'); ?>
<?php
//選單後台每頁必加===================================================
if(!isset($menu_is)){
	$menu_is = '-1';
}
mysql_select_db($database_connect2data, $connect2data);
$sql = "SELECT * FROM menu WHERE menu_title = '".$menu_is."'";
//$res = mysql_query($sql);
$res = mysql_query($sql, $connect2data) or die(mysql_error());
$row = mysql_fetch_array($res);
?>
<script type="text/javascript" src="jquery/jquery-1.7.2.min.js"></script>

<!--<script type="text/javascript" src="jquery/jquery.js"></script>-->

<?php
$output = explode('/',$_SERVER['PHP_SELF']);
if(isset($output[5])){
	$outputSt = $output[5];
	$outType = str_replace(".php","",$output[5]);
	$outstA = explode('-',$output[5]);
	$outn = count($outstA);
	$outSt = str_replace(".php","",$outstA[$outn-1]);
}elseif(isset($output[4])){
	$outputSt = $output[4];
	$outType = str_replace(".php","",$output[4]);
	$outstA = explode('-',$output[4]);
	$outn = count($outstA);
	$outSt = str_replace(".php","",$outstA[$outn-1]);
}elseif(isset($output[3])){
	$outputSt = $output[3];
	$outType = str_replace(".php","",$output[3]);
	$outstA = explode('-',$output[3]);
	$outn = count($outstA);
	$outSt = str_replace(".php","",$outstA[$outn-1]);
}else{
	$outputSt = $output[2];
	$outType = str_replace(".php","",$output[2]);
	$outstA = explode('-',$output[2]);
	$outn = count($outstA);
	$outSt = str_replace(".php","",$outstA[$outn-1]);
}
//echo $outType."<br />";
$outTypeA = explode('_',$outType);
//echo $outTypeA[1]."<br />";
if(isset($outTypeA[1])){
	if( ($outTypeA[1]=='add') || ($outTypeA[1]=='edit') || ($outTypeA[1]=='rule') ){
		if($outType!='member_add' && $outType!='member_edit'){
			require_once('tinymce.php');
		}
		
		//echo "add or edit";
	}elseif( ($outTypeA[1]=='list')){
		//echo "list or del";
		echo "<script type=\"text/javascript\" src=\"jquery/changActive.js\"></script>";
	}
}
/*switch ($outTypeA[1]){
case "add":
case "edit":
 require_once('tinymce.php');
 echo "add or edit";
break;
}*/
?>
<script type="text/javascript">
	menu_now='<?php echo $row['menu_use']; ?>';

$(document).ready(function() {
   $(menu_now).addClass("main_menu_now"); //同时新增二个样式类别
   
   $(".button_set").hover(function(){
		$(this).addClass('btnTypeClass');
		$(this).css('cursor', 'pointer');
	}, function(){
		$(this).removeClass('btnTypeClass');
	});
	
   $(".btnType").hover(function(){
		$(this).addClass('btnTypeClass');
		$(this).css('cursor', 'pointer');
	}, function(){
		$(this).removeClass('btnTypeClass');
	});
   
   $("button.submitBtn").hover(function(){
		$(this).find('img').attr('src', 'image/submit_btn_over_01.png');
		$(this).css('cursor', 'pointer');
	}, function(){
		$(this).find('img').attr('src', 'image/submit_btn_01.png');
	});
	
	$("#searchButton").hover(function(){
		$(this).find('img').attr('src', 'image/go2.gif');
		$(this).css('cursor', 'pointer');
	}, function(){
		$(this).find('img').attr('src', 'image/go1.gif');
	});
  
});
</script>