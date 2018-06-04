<?php require_once('../Connections/connect2data.php'); ?>
<?php
		if (!isset($_SESSION)) {
  			session_start();
		}
		//echo $_REQUEST[authority_id];
		//echo $_REQUEST[active];
		if (isset($_REQUEST['active']))
		{
		
			if($_REQUEST['active']==1)
			{
				$sql= "UPDATE admin SET user_active='0' WHERE user_id='".$_REQUEST['user_id']."'";
			}
			else
			{
				$sql= "UPDATE admin SET user_active='1' WHERE user_id='".$_REQUEST['user_id']."'";
			}
		
			//echo $sql;
			//echo $_SESSION["ToPage"];
			mysql_select_db($database_connect2data, $connect2data);
			mysql_query($sql) or die("無法送出" . mysql_error( ));
			header("Location:authority_list.php?pageNum_RecAuthority=".$_SESSION["ToPage"]);
		}
		
		
?>