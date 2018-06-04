<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
  ob_start();
}
?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php
// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_AccountUsername'] = NULL;
  $_SESSION['MM_AccountUserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;

  unset($_SESSION['MM_AccountUsername']);
  unset($_SESSION['MM_AccountUserGroup']);
  unset($_SESSION['PrevUrl']);

  $logoutGoTo = "../cms_admin/login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) {
  // For security, start by assuming the visitor is NOT authorized.
  $isValid = False;

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username.
  // Therefore, we know that a user is NOT logged in if that Session variable is blank.
  if (!empty($UserName)) {
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login.
    // Parse the strings into arrays.
    $arrUsers = Explode(",", $strUsers);
    $arrGroups = Explode(",", $strGroups);
    if (in_array($UserName, $arrUsers)) {
      $isValid = true;
    }
    // Or, you may restrict access to only certain users based on their username.
    if (in_array($UserGroup, $arrGroups)) {
      $isValid = true;
    }
    if (($strUsers == "") && true) {
      $isValid = true;
    }
  }
  return $isValid;
}

$MM_restrictGoTo = "../cms_admin/login.php";
if (!((isset($_SESSION['MM_AccountUsername'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_AccountUsername'], $_SESSION['MM_AccountUserGroup'])))) {
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0)
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo);
  exit;
}
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

$colname_RecUser = "-1";
if (isset($_SESSION['MM_AccountUsername'])) {
  $colname_RecUser = $_SESSION['MM_AccountUsername'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecUser = sprintf("SELECT user_id, user_name, user_level, user_limit, user_active FROM `admin` WHERE user_name = %s", GetSQLValueString($colname_RecUser, "text"));
$RecUser = mysql_query($query_RecUser, $connect2data) or die(mysql_error());
$row_RecUser = mysql_fetch_assoc($RecUser);
$totalRows_RecUser = mysql_num_rows($RecUser);

$colname_RecLevelAuthority = "-1";
if (isset($row_RecUser['user_level'])) {
  $colname_RecLevelAuthority = $row_RecUser['user_level'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecLevelAuthority = sprintf("SELECT * FROM a_set WHERE a_id = %s", GetSQLValueString($colname_RecLevelAuthority, "int"));
$RecLevelAuthority = mysql_query($query_RecLevelAuthority, $connect2data) or die(mysql_error());
$row_RecLevelAuthority = mysql_fetch_assoc($RecLevelAuthority);
$totalRows_RecLevelAuthority = mysql_num_rows($RecLevelAuthority);

/*list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) =
  explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));*/

/*  if (preg_match('/Basic\s+(.*)$/i', $_SERVER['HTTP_AUTHORIZATION'], $matches))
{
    list($name, $password) = explode(':', base64_decode($matches[1]));
    $_SERVER['PHP_AUTH_USER'] = strip_tags($name);
    $_SERVER['PHP_AUTH_PW'] = strip_tags($password);
}*/

/*list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':' , base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));

// split the user/pass parts
list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));

// open a user/pass prompt
if (!isset($_SERVER['PHP_AUTH_USER'])) {
   header('WWW-Authenticate: Basic realm="My Realm"');
   header('HTTP/1.0 401 Unauthorized');
   echo 'Text to send if user hits Cancel button';
   exit;
 } else {
   echo "<p>Hello, </p>".$_SERVER['PHP_AUTH_USER'];
   echo "<p>You entered as your password: </p>".$_SERVER['PHP_AUTH_PW'];
 }*/
?>
<link href="../cms_admin/css/work_css.css" rel="stylesheet" type="text/css" media="screen" />
<!--<link href="../cms_admin/css/work_css.css" rel="stylesheet" type="text/css" media="print" />-->

<link rel="dbblackpork icon" href="../favicon.png" type="image/x-icon" />
<script type="text/javascript" src="js/swapImage.js"></script>