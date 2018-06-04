<?php require_once('Connections/connect2data.php'); ?>
<?php //使用者如果存在
// *** Redirect if username exists
  $FF_dupKeyUsernameValue = $_GET["requsername"];
  $FF_dupKeySQL = "SELECT m_account FROM member_set WHERE m_account='" . $FF_dupKeyUsernameValue . "'";
  mysql_select_db($database_connect2data, $connect2data);
  $FF_rsKey=mysql_query($FF_dupKeySQL, $connect2data) or die(mysql_error());
?>
<html>
<head>
<title>檢查帳號</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--Fireworks MX 2004 Dreamweaver MX 2004 target.  Created Sat Feb 02 20:09:18 GMT+0800 2008-->
<style type="text/css">
<!--
body {
	margin-top: 0px;
	margin-bottom: 0px;
	background-color: #FFFFD7;
}
.style6 {
	color: #A09581;
	font-weight: bold;
	font-size: 9pt;
}
-->
</style>

<style type="text/css">
<!--
.style6 {
	font-size: 13px;
	color: #666666;
}
.style7 {	color: #A09581;
	font-weight: bold;
	font-size: 9pt;
}
.style7 {	font-size: 13px;
	color: #666666;
}
-->
</style>
<script src="js/AC_RunActiveContent.js" type="text/javascript"></script>
<link href="cms_admin/css/work_css.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="16" align="left" valign="top">&nbsp;</td>
    <td width="719" align="left" valign="top"><form action="" method="POST" enctype="multipart/form-data" name="form1" >
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
         <?php if(mysql_num_rows($FF_rsKey) == 0) { ?>
        <tr>
          <td><span style="display:block"><img src="images/account_o.gif" width="14" height="14" />此帳號<span class="err_title"><strong><?php echo $_GET['requsername'];?></strong></span>還沒有被註冊哦！</span></td>
        </tr>
        <?php }?>
        <?php if(mysql_num_rows($FF_rsKey) > 0) { ?>
        <tr>
          <td><img src="images/account_x.gif" width="14" height="14" />此帳號<span class="err_title"><strong><?php echo $_GET['requsername'];?></strong></span>已經被使用了哦！</td>
        </tr><?php }?>
      </table>
    </form></td>
    <td width="53" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php mysql_free_result($FF_rsKey);?>