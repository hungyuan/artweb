<?php
if (!isset($_SESSION)) {
	session_start();
}
ob_start();
include('../recordset2json.php');
/* RECEIVE VALUE */
/*$validateValue = '';
if(isset($_POST['validateValue'])){
	$validateValue = $_POST['validateValue'];
}else if(isset($_GET['validateValue'])){
	$validateValue = $_GET['validateValue'];
}
$validateId = '';
if(isset($_POST['validateId'])){
	$validateId = $_POST['validateId'];
}else if(isset($_GET['validateId'])){
	$validateId = $_GET['validateId'];
}
$validateError = '';
if(isset($_POST['validateError'])){
	$validateError = $_POST['validateError'];
}else if(isset($_GET['validateError'])){
	$validateError = $_GET['validateError'];
}*/
$validateValue=$_POST['validateValue'];
$validateId=$_POST['validateId'];
$validateError=$_POST['validateError'];

	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;
	$arrayToJs[1] = $validateError;
if((isset($_SESSION["Checknum"])) && (isset($validateValue)) && ($_SESSION["Checknum"] == $validateValue)) {
//if($validateValue =="karnius"){		// validate??
	$arrayToJs[2] = "true";			// RETURN TRUE	
	echo '{"jsonValidateReturn":'.sd_array2json($arrayToJs).'}';			// RETURN ARRAY WITH success
}else{
	for($x=0;$x<1000000;$x++){
		if($x == 990000){
			$arrayToJs[2] = "false";
			echo '{"jsonValidateReturn":'.sd_array2json($arrayToJs).'}';		// RETURN ARRAY WITH ERROR
		}
	}
	
}

?>