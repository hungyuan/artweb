<?php
require_once 'Connections/connect2data.php';
mysql_select_db($database_connect2data, $connect2data);

$ryder_cat = (isset($_GET['cat'])) ? $_GET['cat'] : 0;
$ryder_id = (isset($_GET['id'])) ? $_GET['id'] : 0;

$query_RecNow = sprintf("SELECT * FROM class_set
  WHERE c_id='%s' AND c_active='1'
  ORDER BY c_sort ASC", $ryder_cat);
$RecNow = mysql_query($query_RecNow, $connect2data) or die(mysql_error());
$row_RecNow = mysql_fetch_assoc($RecNow);
$now = substr($row_RecNow['c_parent'], 0, -1);

if ($now == 'people') {
	$bread = '全人素養';
	$class = 'is-blue';
}else if ($now == 'home') {
	$bread = '環境教養';
	$class = 'is-green';
}else if ($now == 'society') {
	$bread = '未來涵養';
	$class = 'is-orange';
}

$query_RecBanner = sprintf("SELECT * FROM class_set, file_set
  WHERE c_id=file_d_id AND c_id='%s' AND file_type='%s' AND c_active='1'
  ORDER BY c_sort ASC", $ryder_cat, $row_RecNow['c_parent']);
$RecBanner = mysql_query($query_RecBanner, $connect2data) or die(mysql_error());
$row_RecBanner = mysql_fetch_assoc($RecBanner);
$totalRows_RecBanner = mysql_num_rows($RecBanner);

$query_RecWorks = sprintf("SELECT * FROM data_set
  WHERE d_id= '".$ryder_id."'
  ORDER BY d_sort ASC");
$RecWorks = mysql_query($query_RecWorks, $connect2data) or die(mysql_error());
$row_RecWorks = mysql_fetch_assoc($RecWorks);
$totalRows_RecWorks = mysql_num_rows($RecWorks);
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
			<li><img src="<?= $row_RecBanner['file_link1'] ?>"></li>
		</ul>

		<div class="slider-slogan">
			<div class="en"><?= $row_RecBanner['c_content_en'] ?></div>
			<div class="ch"><?= nl2br($row_RecBanner['c_content']) ?></div>
		</div>
	</div>

	<div class="articleOutWrap m-outWrap">
		<div class="catWrap">
			<ul class="catList">
				<li><a href="people.php">全人素養</a>
					<?php if ($now=='people'): ?>
						<ul class="subCatList">
							<!-- <li><a href="people.php">關於本網站</a></li>-->

							<?php while($row_RecPeople = mysql_fetch_assoc($RecPeople)){ ?>
								<li class="<?php if ($row_RecPeople['c_id'] == $ryder_cat): ?>current<?php endif ?>"><a href="list.php?cat=<?= $row_RecPeople['c_id'] ?>"><?= $row_RecPeople['c_title'] ?></a></li>
							<?php } ?>
						</ul>
					<?php endif ?>
				</li>
				<li><a href="home.php">環境教養</a>
					<?php if ($now=='home'): ?>
						<ul class="subCatList">
							<li><a href="home.php">關於本網站</a></li>

							<?php while($row_RecHome = mysql_fetch_assoc($RecHome)){ ?>
								<li class="<?php if ($row_RecHome['c_id'] == $ryder_cat): ?>current<?php endif ?>"><a href="list.php?cat=<?= $row_RecHome['c_id'] ?>"><?= $row_RecHome['c_title'] ?></a></li>
							<?php } ?>
						</ul>
					<?php endif ?>
				</li>
				<li><a href="society.php">未來涵養</a>
					<?php if ($now=='society'): ?>
						<ul class="subCatList">
							<li><a href="society.php">關於本網站</a></li>

							<?php while($row_RecSociety = mysql_fetch_assoc($RecSociety)){ ?>
								<li class="<?php if ($row_RecSociety['c_id'] == $ryder_cat): ?>current<?php endif ?>"><a href="list.php?cat=<?= $row_RecSociety['c_id'] ?>"><?= $row_RecSociety['c_title'] ?></a></li>
							<?php } ?>
						</ul>
					<?php endif ?>
				</li>
			</ul>
		</div>

		<div class="articleWrap">
			<ul class="bread">
				<li>Home</li>
				<li>></li>
				<li><?= $bread ?></li>
				<li>></li>
				<li><?= $row_RecNow['c_title'] ?></li>
			</ul>

			<div class="detailWrap">
				<div class="date"><?php echo str_replace('-', '.', mb_substr($row_RecWorks['d_date'],0,10,"UTF-8") ); ?></div>
				<div class="title"><?= $row_RecWorks['d_title'] ?></div>
				<div class="content">
					<?= $row_RecWorks['d_content'] ?>
				</div>
			</div>

			<div class="pager" onclick="history.back();">
				<a href="javascript:;" class="current">Back</a>
				<a href="javascript:;" class="next">></a>
			</div>
		</div>
	</div>

	<?php mysql_data_seek($RecPeople, 0); ?>
	<?php mysql_data_seek($RecHome, 0); ?>
	<?php mysql_data_seek($RecSociety, 0); ?>
	<?php include 'footer.php'; ?>
</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
<script src="js/common.js"></script>
</html>

<script>
	$(function () {
		TweenMax.to($(".sliderWrap"), 0, {
			top: 0,
			opacity: 1,
			onComplete: function  () {}
		});

		TweenMax.to($(".catWrap"), 0, {
			top: 0,
			opacity: 1,
			onComplete: function  () {}
		});

		TweenMax.to($(".bread"), 0, {
			left: 0,
			opacity: 1,
			onComplete: function  () {}
		});

		TweenMax.to($(".detailWrap"), 1, {
			top: 0,
			opacity: 1,
			onComplete: function  () {}
		});
	})
</script>
