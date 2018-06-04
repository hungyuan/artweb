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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['use_rname'])) {
  $loginUsername=$_POST['use_rname'];
  $password=$_POST['user_password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "first.php";
  $MM_redirectLoginFailed = "login_again.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_connect2data, $connect2data);
  
  $LoginRS__query=sprintf("SELECT user_name, user_password FROM `admin` WHERE user_name=%s AND user_password=%s AND user_active='1' ",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $connect2data) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
	$loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_AccountUsername'] = $loginUsername;
    $_SESSION['MM_AccountUserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require('cmsTitle.php'); ?></title>
<link href="css/work_css.css" rel="stylesheet" type="text/css">
<link rel="dbblackpork icon" href="../css/favcon.ico" type="image/x-icon" />
<script type="text/javascript" src="jquery/jquery-1.6.4.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	
	$(".btnType").hover(function(){
		$(this).addClass('btnTypeClass');
		$(this).css('cursor', 'pointer');
	}, function(){
		$(this).removeClass('btnTypeClass');
	});
	
	var mrg = ($(this).height() - $('#login-wrapper-form').height())/3;
	$('#login-wrapper-form').css('margin-top',mrg+'px');
	
});

</script>
</head>
<body>

<div id="login-wrapper">
<div id="login-wrapper-form">
<form action="<?php echo $loginFormAction; ?>" method="POST" name="form1" id="form1">
    
    <div class="art-logo-name"><img src="../images/login_logo.png" ></div>

    <h3 class="login-cms-text">後端內容管理系統</h3>
    
    <div id="login-content">
    <ul id="login-input">
    	<li><span class="login-input-text"><label for="use_rname">ACCOUNT</label></span><input type="text" name="use_rname" id="use_rname" ></li>
    	<li><span class="login-input-text"><label for="user_password">PASSWORD</label></span><input type="password" name="user_password" id="user_password" ></li>
    </ul>
    <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" />
   
    </div>
</form>
</div>

</div>

</body>
</html>
