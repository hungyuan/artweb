<?php
			if (!isset($_SESSION)) {
               session_start();
               }
            ob_start();
?>
<?php require_once('../../Connections/connect2data.php'); ?>
<?php
/*$inputT = fopen('output2.txt', 'a');
fwrite($inputT, date("Y-m-d H:i:s")."\r\n");
fclose($inputT);*/

    // 資料庫設定
	/*$host_sql = 'localhost';
    $username_sql = 'root';
    $password_sql = '0708';
	$dataname_sql = 'fwukeh';*/
	
	//mysql_select_db($database_connect2data, $connect2data);

    // 聯結資料庫
   // $link = mysql_connect($host_sql, $username_sql, $password_sql) or die('無法連結資料庫');
   $link = mysql_connect($hostname_connect2data, $username_connect2data, $password_connect2data) or die('無法連結資料庫');
    //mysql_select_db($dataname_sql, $link);
	mysql_select_db($database_connect2data, $link);
	//mysql_select_db('fwukeh', $link);
    mysql_query('SET NAMES UTF8');
	
	unset($data);
    // 預設選項
	$data = array();
	if (0 !== (int) $_GET['u_add'] && $_GET['u_add'] == 1){
    $data['0'] = '請選擇';
	}
	
    // 只有在 parentId 與 levelNum 都存在的情況下，才進行資料庫的搜尋
    if (0 !== (int) $_GET['term_id'] && 0 !== (int) $_GET['lv']) {
		
        $parentId = (int) $_GET['term_id'];
		$_SESSION['selected_productsT'] = (int) $_GET['term_id'];
        $levelNum = ( (int) $_GET['lv'] ) - 1;
		
		if(isset($_GET['taxonomy']) && $_GET['taxonomy']!=''){
			$taxonomy = $_GET['taxonomy'];
			//$query = "SELECT term_id, c_title, taxonomy FROM class_set WHERE c_parent = $parentId AND taxonomy = '$taxonomy' AND c_level = $levelNum ORDER BY c_sort ASC, term_id DESC";
			$query = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='$taxonomy' AND TT.parent='$parentId' AND T.term_group='$levelNum' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
		}else{
			 //$query = sprintf("SELECT term_id, c_title, taxonomy FROM class_set WHERE c_parent = %d AND c_level = %d ORDER BY c_sort ASC, term_id DESC", $parentId, $levelNum);
			 $query = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE  TT.parent='$parentId' AND T.term_group='$levelNum' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
		}
		//echo "taxonomy = ".$_GET['taxonomy']."<br/>";
		//echo $query;
        $result = mysql_query($query, $link);
		echo mysql_error();
        while ($row = mysql_fetch_assoc($result)) {
        
            // 將取得的資料放入陣列中
            $data[$row['term_id']] = $row['name'];
			/*if($row['taxonomy']=='brandSeries'){
				$_SESSION['selected_brandSeries'] = $row['term_id'];
			}*/
        }
		/*while ($row = mysql_fetch_row($result)) {
        
            // 將取得的資料放入陣列中
			//echo $row[0]."<br/>";
			//echo $row[1]."<br/>";
            $data[$row[0]] = $row[1].$row[0];
        }*/
    }
    
    // 將陣列轉換為 json 格式輸入
	/*foreach($data as $value){
	echo $value."<br/>";
	echo key($value);
	echo "<br/>";
	}*/
	/*foreach ($result as $key => $value){
	echo "Array: $key, $value <br/>";
	}*/
	/*foreach ($data as $key => $value) {
    echo "Array: $key, $value <br/>";
	}*/
	
	//設定您要寫入的檔案名稱
// w指的是要寫入，若已存在output.txt，則覆蓋
// 改成a 的話，則是複寫，之前的output.txt 資料會保留著
//$fp = fopen('output.txt', 'w');

//"我\r\n愛\r\n妳"則是要寫入的文字
//而在Windows系統下的文字檔會把"\r\n"視同為「跳行」
/*fwrite($fp, date("Y-m-d H:i:s")."\r\n");
foreach ($data as $key => $value) {
fwrite($fp, "Array: $key, $value\r\n");
	}
fclose($fp);*/
	if(count($data)==1 && $_GET['u_add'] == 1){
		$data['0'] = '此分類暫無資料';
	}elseif (count($data)==0){
		$data['0'] = '此分類暫無資料';
	}
	include('recordset2json.php');
	echo sd_recordset2json($data);
	/*echo "<br/>";
    echo json_encode($data);*/
?>