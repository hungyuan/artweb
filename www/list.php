<?php
require_once 'Connections/connect2data.php';
require_once('paginator.class.php');
mysql_select_db($database_connect2data, $connect2data);

$ryder_cat = (isset($_GET['cat'])) ? $_GET['cat'] : 0;

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

//page start
$page=(isset($_GET['page'])) ? $_GET['page']:1;
$page_count=4;
$init_count=($page-1)*$page_count;

//使用
$query_RecProjects = sprintf("SELECT * FROM data_set LEFT JOIN file_set
  ON d_id=file_d_id AND file_type='image'
  WHERE d_class1='%s' AND d_class2='%s' AND d_active='1'
  ORDER BY d_sort ASC limit $init_count,$page_count", $now, $ryder_cat);
$RecProjects = mysql_query($query_RecProjects, $connect2data) or die(mysql_error());
// $row_RecProjects = mysql_fetch_assoc($RecProjects);
$totalRows_RecProjects = mysql_num_rows($RecProjects);

//$totalRows_RecProjects_count拿來計算全部有幾則
$query_RecProjects_count = sprintf("SELECT * FROM data_set LEFT JOIN file_set
  ON d_id=file_d_id AND file_type='image'
  WHERE d_class1='%s' AND d_class2='%s' AND d_active='1'
  ORDER BY d_sort ASC", $now, $ryder_cat);
$RecProjects_count = mysql_query($query_RecProjects_count, $connect2data) or die(mysql_error());
$row_RecProjects_count = mysql_fetch_assoc($RecProjects_count);
$totalRows_RecProjects_count = mysql_num_rows($RecProjects_count);

$totalpage=ceil($totalRows_RecProjects_count/4);

$pages = new Paginator;
$pages->items_total = $totalRows_RecProjects_count;
$pages->items_per_page = $page_count;
$pages->paginate();
//page end
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

			<ul class="articleList">
				<?php while($row_RecProjects = mysql_fetch_assoc($RecProjects)){ ?>
					<li class="<?php if ($row_RecProjects['file_link1'] != ''): ?>has-pic<?php endif ?>"><a href="detail.php?cat=<?= $ryder_cat ?>&id=<?= $row_RecProjects['d_id'] ?>">
						<div class="date"><?php echo str_replace('-', '.', mb_substr($row_RecProjects['d_date'],0,10,"UTF-8") ); ?></div>
						<div>
							<div class="container">
								<div class="title"><?= $row_RecProjects['d_title'] ?></div>
								<div class="content"><?= mb_substr(preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/", "", strip_tags($row_RecProjects['d_content'])), 0, 110, "utf-8"); ?>...</div>
								<div class="content-with-pic"><?= mb_substr(preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/", "", strip_tags($row_RecProjects['d_content'])), 0, 90, "utf-8"); ?>...</div>
							</div>
							<div class="pic"><img src="<?= $row_RecProjects['file_link1'] ?>"></div>
						</div>
					</a></li>
				<?php } ?>
			</ul>

			<div class="pager">
				<?php if($page!=1) {?> <a href="<?= $pages->prevpage(); ?>" class="prev"><</a> <?php } ?>

				<?php echo $pages->display_pages(); ?>

				<?php if($page!=$totalpage) {?> <a href="<?= $pages->nextpage(); ?>" class="next">></a> <?php } ?>
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

		TweenMax.staggerTo($(".articleList li"), 0.6, {
			top: 0,
			opacity: 1,
			onComplete: function  () {
				$(this.target).addClass("add-transition");
			}
		}, 0.33);
	})
</script>
