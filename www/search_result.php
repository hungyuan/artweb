<?php
require_once 'Connections/connect2data.php';
require_once('paginator.class.php');
mysql_select_db($database_connect2data, $connect2data);

$ryder_s = (isset($_GET['search']) && $_GET['search']!='') ? $_GET['search'] : '您沒有輸入任何關鍵字';

//page start
$page=(isset($_GET['page'])) ? $_GET['page']:1;
$page_count=6;
$init_count=($page-1)*$page_count;

//使用
$query_RecProjects = sprintf("SELECT * FROM class_set, data_set
  LEFT JOIN file_set ON d_id=file_d_id AND file_type='image'
  WHERE d_class2=c_id AND (d_title like '%%%s%%' OR d_content like '%%%s%%' OR c_title like '%%%s%%') AND c_active='1' AND d_active='1'
  ORDER BY d_date DESC limit $init_count,$page_count", $ryder_s, $ryder_s, $ryder_s);
$RecProjects = mysql_query($query_RecProjects, $connect2data) or die(mysql_error());
// $row_RecProjects = mysql_fetch_assoc($RecProjects);
$totalRows_RecProjects = mysql_num_rows($RecProjects);

//$totalRows_RecProjects_count拿來計算全部有幾則
$query_RecProjects_count = sprintf("SELECT * FROM class_set, data_set
  LEFT JOIN file_set ON d_id=file_d_id AND file_type='image'
  WHERE d_class2=c_id AND (d_title like '%%%s%%' OR d_content like '%%%s%%' OR c_title like '%%%s%%') AND c_active='1' AND d_active='1'
  ORDER BY d_date DESC", $ryder_s, $ryder_s, $ryder_s);
$RecProjects_count = mysql_query($query_RecProjects_count, $connect2data) or die(mysql_error());
$row_RecProjects_count = mysql_fetch_assoc($RecProjects_count);
$totalRows_RecProjects_count = mysql_num_rows($RecProjects_count);

$totalpage=ceil($totalRows_RecProjects_count/6);

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

	<style>
		.subCatList{padding-left: 0;}
	</style>
</head>

<body>
	<?php $now='result' ?>
	<?php include 'topmenu.php'; ?>

	<div class="articleOutWrap m-outWrap">
		<div class="catWrap">
			<ul class="catList">
				<li>您搜尋的關鍵字：
					<ul class="subCatList">
						<li><?= $ryder_s ?></li>
					</ul>
				</li>
			</ul>
		</div>

		<div class="articleWrap">
			<?php if ($ryder_s == '-1' || $totalRows_RecProjects == 0): ?>
				<div class="noresult">找不到資料</div>
			<?php else: ?>
				<ul class="articleList">
					<?php while($row_RecProjects = mysql_fetch_assoc($RecProjects)){ ?>
						<li class="<?php if ($row_RecProjects['file_link1'] != ''): ?>has-pic<?php endif ?>"><a href="detail.php?cat=<?= $row_RecProjects['c_id'] ?>&id=<?= $row_RecProjects['d_id'] ?>">
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
			<?php endif ?>
		</div>
	</div>
</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
<script src="js/common.js"></script>
</html>

<script>
	$(function () {
		TweenMax.to($(".catWrap"), 1, {
			top: 0,
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