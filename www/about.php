<?php
require_once 'Connections/connect2data.php';
mysql_select_db($database_connect2data, $connect2data);

$query_RecCat = sprintf("SELECT * FROM class_set
  WHERE c_parent='societyC' AND c_active='1'
  ORDER BY c_sort ASC");
$RecCat = mysql_query($query_RecCat, $connect2data) or die(mysql_error());
// $row_RecCat = mysql_fetch_assoc($RecCat);
$totalRows_RecCat = mysql_num_rows($RecCat);

$query_RecNews = sprintf("SELECT * FROM data_set, class_set, file_set
  WHERE d_id=file_d_id AND d_class2=c_id AND d_class1='society' AND c_parent='societyC' AND file_type='image' AND c_active='1' AND d_active='1' AND d_data1='1'
  ORDER BY d_date DESC");
$RecNews = mysql_query($query_RecNews, $connect2data) or die(mysql_error());
// $row_RecNews = mysql_fetch_assoc($RecNews);
$totalRows_RecNews = mysql_num_rows($RecNews);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php include 'html_title.php'; ?></title>

	<?php include('meta.php') ?>

	<link rel="stylesheet" href="stylesheets/style.css">
</head>

<body class="<?= $class ?>">
	<?php include 'topmenu.php'; ?>

	<div class="sliderWrap m-outWrap">
		<div class="colorBlock"></div>

		<ul class="sliderList">
			<li><img src="images/slider-1.jpg"></li>
			<li><img src="images/slider-2.jpg"></li>
			<li><img src="images/slider-3.jpg"></li>
		</ul>

		<div class="prev image-2x"></div>
		<div class="next image-2x"></div>

		<div class="sliderPager">
			<a data-slide-index="0" href="javascript:;"></a>
			<a data-slide-index="1" href="javascript:;"></a>
			<a data-slide-index="2" href="javascript:;"></a>
		</div>

		<div class="slider-slogan">
			<div class="en">Experience Aesthetics</div>
			<div class="ch">在生活中體驗美學</div>
		</div>
	</div>

	<div class="scrollDown image-2x"><img src="images/down-orange.png"><img src="images/down-orange@2x.png" width="74"></div>

	<div class="mainProjects m-outWrap flowUp">
		<div class="articleWrap">
			<div class="title-ch">生活與體驗中<BR>實踐美善力量</div>
			<div class="title-en">Life and experience<BR>Practice good strength</div>
			<div class="content">廣設社大及市民學苑藝文課程，提供市民認識藝術；透過美感科技文創總動員，將產業升級，讓想法實踐，使美的素養能在生活中隨處可見。</div>
		</div>

		<div class="expWrap image-2x"><img src="images/society-exp.png"><img src="images/society-exp@2x.png" width="583"></div>
	</div>

	<div class="aboutWrap m-outWrap flowUp">
		<div class="pic"><img src="images/about-3.png"></div>
		<div class="titleWrap">
			<div class="en">Experience</div>
			<div class="ch">在生活中體驗美學</div>
		</div>
		<div class="content">廣設社大及市民學苑藝文課程，提供市民認識藝術；透過美感科技文創總動員，將產業升級，讓想法實踐，使美的素養能在生活中隨處可見。</div>
	</div>

	<div class="full-middleArea flowUp">
		<img src="images/full-3.jpg">

		<div class="fma-slogan m-outWrap">
			<div class="title-en">PRACTICE<BR>GOOD<BR>STRENGTH</div>
			<div class="title-ch">生活與體驗中<BR>實踐美善力量</div>
		</div>
	</div>



	<?php include 'footer.php'; ?>
</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
<script src="js/jquery.bxslider.min.js"></script>
<link rel="stylesheet" href="css/jquery.bxslider.css">
<script src="js/flowup.js"></script>
<script src="js/common.js"></script>
</html>
