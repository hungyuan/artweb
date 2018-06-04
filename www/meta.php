<?php
require_once 'Connections/connect2data.php';
mysql_select_db($database_connect2data, $connect2data);

$query_RecKeywords = sprintf("SELECT * FROM data_set
  WHERE d_class1='keywords' AND d_active='1'
  ORDER BY d_sort ASC");
$RecKeywords = mysql_query($query_RecKeywords, $connect2data) or die(mysql_error());
$row_RecKeywords = mysql_fetch_assoc($RecKeywords);
$totalRows_RecKeywords = mysql_num_rows($RecKeywords);
?>

<meta name="viewport" content="width=1280" />

<link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="images/fav.ico">
<link rel="apple-touch-icon" sizes="76x76" href="images/fav.ico">
<link rel="apple-touch-icon" sizes="120x120" href="images/fav.ico">
<link rel="apple-touch-icon" sizes="152x152" href="images/fav.ico">

<?php if ($totalRows_RecKeywords): ?>
	<meta name="Kyewords" Content="<?= $row_RecKeywords['d_class2'] ?>">
	<meta name="Description" content="<?= $row_RecKeywords['d_class3'] ?>">
<?php else: ?>
	<meta name="kyewords" Content="高雄市, 美感, 教育, 美感教育, 藝術, 生活, 創意, 市民, 家園, 社會, 美化, 美麗, 美善, 政府, 共學, 創作, 實踐, 校園, 專長培訓">
	<meta name="description" content="教育部於102年8月發布美感教育中長程計畫第一期五年計畫，以美力國民、美化家園、美善社會為願景，並透過美感播種、美感立基、美感普及等3個目標，及11項發展策略，期望能達成各教育階段發展性的美感素養指標與課程內涵、建立強化知覺、情感、體驗、詮釋、表達與思辨過程的「感受」與「實踐」的教育行動範例，並完成在地生活化的學校特色、課程與教材，學生能建立自我價值認同的美感能力。103年定為「美感教育年」，積極推動美感教育。高雄市配合教育部五年計畫，依據本市有山、有海、有河、有港之在地特色，由各科室透過各項子計畫申請，全面推展各級學校實施美感教育，並依據教育部美力國民、美化家園、美善社會三大願景及美感播種、美感立基、美感普及三大目標著手，於105年透過資源盤點，積極研提「高雄市美感教育中程計畫」。
	">
<?php endif ?>