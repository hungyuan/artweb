<?php
if (!isset($_SESSION)) {
	session_start();
}
ob_start();
/*  RECEIVE POST   */
//$email=$_POST['email'];
//$age=$_POST['age'];
$checknum = '';
if(isset($_POST['checknum'])){
	$checknum = $_POST['checknum'];
}else if(isset($_GET['checknum'])){
	$checknum = $_GET['checknum'];
}
/* VALIDATE HOW YOU NEED TO VALIDATE */
//$psw = '';
if(isset($_POST['password'])){
	$_SESSION["m_password"] = $_POST['password'];
}else if(isset($_GET['password'])){
	$_SESSION["m_password"] = $_GET['password'];
}
//$_SESSION["m_password"] = $psw;

//echo "_POST = ".$_POST['checknum']."<br/>";
//echo "_GET = ".$_GET['checknum']."<br/>";
/* RETURN ERROR */

$arrayError[0][0] = "#checknum";			// FIELDID 
$arrayError[0][1] = "輸入的驗證碼錯誤！"; 	// TEXT ERROR	
$arrayError[0][2] = "error";	

/*$arrayError[0][0] = "#email";			// FIELDID 
$arrayError[0][1] = "Your email do not match.. whatever it need to match"; 	// TEXT ERROR	
$arrayError[0][2] = "error";			// BOX COLOR

$arrayError[1][0] = "#age";		// FIELD
$arrayError[1][1] = "Your email do not match.. whatever it need to match"; 	// TEXT ERROR	
$arrayError[1][2] = "error";			// BOX COLOR*/

//echo "_SESSION = ".$_SESSION["Checknum"]."<br/>";
//echo "checknum = ".$checknum."<br/>";
if((isset($_SESSION["Checknum"])) && (isset($checknum)) && ($_SESSION["Checknum"] == $checknum)) {
	$isValidate = true;  // RETURN TRUE FROM VALIDATING, NO ERROR DETECTED
}else{
	$isValidate = false;
}
/* RETTURN ARRAY FROM YOUR VALIDATION  */


/* THIS NEED TO BE IN YOUR FILE NO MATTERS WHAT */
if($isValidate == true){
	echo "true";
}else{
	include('../recordset2json.php');
	echo '{"jsonValidateReturn":'.sd_array2json($arrayError).'}';		// RETURN ARRAY WITH ERROR
}
?>