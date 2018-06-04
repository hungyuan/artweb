<?php
require_once 'Connections/connect2data.php';
mysql_select_db($database_connect2data, $connect2data);

$query_RecCat = sprintf("SELECT * FROM class_set
  WHERE c_parent='homeC' AND c_active='1'
  ORDER BY c_sort ASC");
$RecCat = mysql_query($query_RecCat, $connect2data) or die(mysql_error());
// $row_RecCat = mysql_fetch_assoc($RecCat);
$totalRows_RecCat = mysql_num_rows($RecCat);

$query_RecNews = sprintf("SELECT * FROM data_set, class_set, file_set
  WHERE d_id=file_d_id AND d_class2=c_id AND d_class1='home' AND c_parent='homeC' AND file_type='image' AND c_active='1' AND d_active='1' AND d_data1='1'
  ORDER BY d_date DESC");
$RecNews = mysql_query($query_RecNews, $connect2data) or die(mysql_error());
// $row_RecNews = mysql_fetch_assoc($RecNews);
$totalRows_RecNews = mysql_num_rows($RecNews);

$now = 'home';
$class = 'is-green';
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
			<li><img src="images/slider-2.jpg"></li>
			<li><img src="images/slider-3.jpg"></li>
			<li><img src="images/slider-1.jpg"></li>
		</ul>

		<div class="prev image-2x"></div>
		<div class="next image-2x"></div>

		<div class="sliderPager">
			<a data-slide-index="0" href="javascript:;"></a>
			<a data-slide-index="1" href="javascript:;"></a>
			<a data-slide-index="2" href="javascript:;"></a>
		</div>

		<div class="slider-slogan">
			<div class="en">Space Aesthetics</div>
			<div class="ch">營造具美感的校園環境</div>
		</div>
	</div>

	<div class="scrollDown image-2x"><img src="images/down-green.png"><img src="images/down-green@2x.png" width="74"></div>

	<div class="mainProjects m-outWrap flowUp">
		<div class="articleWrap">
			<div class="title-ch">多元方式<BR>營造美感環境</div>
			<div class="title-en">Multiple dimensions<BR>build the space of aesthetics</div>
			<div class="content">建構美感環境<BR>認同多元文化<BR>舒展美好生活</div>
		</div>

		<div class="expWrap image-2x"><img src="images/home-exp.png"><img src="images/home-exp@2x.png" width="583"></div>
	</div>

	<div class="aboutWrap m-outWrap flowUp">
		<div class="pic"><img src="images/about-2.png"></div>
		<div class="titleWrap">
			<div class="en">Tradition and Modern</div>
			<div class="ch">傳統與現代對話</div>
		</div>
		<div class="content"></div>
	</div>

	<div class="full-middleArea flowUp">
		<img src="images/full-2.jpg">

		<div class="fma-slogan m-outWrap">
			<div class="title-en">Space Aesthetics</div>
			<div class="title-ch">傳統與現代<BR>營造美的環境</div>
		</div>
	</div>

	<div class="allListWrap m-outWrap flowUp">
		<?php while($row_RecCat = mysql_fetch_assoc($RecCat)){ ?>
			<div class="listWrap">
				<div class="cat"><?= $row_RecCat['c_title'] ?></div>

				<ul class="list">
					<?php
					mysql_select_db($database_connect2data, $connect2data);
					$query_RecWorks = sprintf("SELECT * FROM data_set LEFT JOIN file_set
					  ON d_id=file_d_id AND file_type='image'
					  WHERE d_class1='home' AND d_class2='%s' AND d_active='1'
					  ORDER BY d_sort ASC LIMIT 0, 3", $row_RecCat['c_id']);
					$RecWorks = mysql_query($query_RecWorks, $connect2data) or die(mysql_error());
					// $row_RecWorks = mysql_fetch_assoc($RecWorks);
					$totalRows_RecWorks = mysql_num_rows($RecWorks);
					?>

					<?php while($row_RecWorks = mysql_fetch_assoc($RecWorks)){ ?>
						<li class="<?php if ($row_RecWorks['file_link1'] != ''): ?>has-pic<?php endif ?>"><a href="detail.php?cat=<?= $row_RecCat['c_id'] ?>&id=<?= $row_RecWorks['d_id'] ?>">
							<div class="date"><?php echo str_replace('-', '.', mb_substr($row_RecWorks['d_date'],0,10,"UTF-8") ); ?></div>
							<div>
								<div class="articleWrap">
									<div class="title"><?= $row_RecWorks['d_title'] ?></div>
									<div class="content"><?= mb_substr(preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/", "", strip_tags($row_RecWorks['d_content'])), 0, 40, "utf-8"); ?>...</div>
									<div class="content-with-pic"><?= mb_substr(preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/", "", strip_tags($row_RecWorks['d_content'])), 0, 15, "utf-8"); ?>...</div>
								</div>
								<div class="pic"><img src="<?= $row_RecWorks['file_link1'] ?>"></div>
							</div>
						</a></li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
	</div>

	<?php if ($totalRows_RecNews > 0): ?>
		<div class="newsWrap m-outWrap flowUp">
			<div class="nw-head">
				<div class="en">News</div>
				<div class="ch">最新活動</div>
			</div>

			<div class="newsSliderWrap">
				<ul class="newsSliderList">
					<?php while($row_RecNews = mysql_fetch_assoc($RecNews)){ ?>
						<li><a href="detail.php?cat=<?= $row_RecNews['c_id'] ?>&id=<?= $row_RecNews['d_id'] ?>">
							<div class="pic"><img src="<?= $row_RecNews['file_link1'] ?>"></div>
							<div class="date"><?php echo str_replace('-', '.', mb_substr($row_RecNews['d_date'],0,10,"UTF-8") ); ?>
								<div class="cat"><?= $row_RecNews['c_title'] ?></div>
							</div>
							<div class="title"><?= $row_RecNews['d_title'] ?>
								<div class="more image-2x"><img src="images/news-more-green.png"><img src="images/news-more-green@2x.png" width="51"></div>
							</div>
						</a></li>
					<?php } ?>
				</ul>

				<div class="nsw-prev image-2x"></div>
				<div class="nsw-next image-2x"></div>
			</div>
		</div>
	<?php else: ?>
		<div style="height: 100px;"></div>
	<?php endif ?>

	<?php include 'footer.php'; ?>
</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
<script src="js/jquery.bxslider.min.js"></script>
<link rel="stylesheet" href="css/jquery.bxslider.css">
<script src="js/flowup.js"></script>
<script src="js/common.js"></script>
</html>

<script>
	$(function () {
		$("body").flowUp(".flowUp", { translateY: 200, duration: 1.2 });

		TweenMax.to($(".sliderWrap, .scrollDown"), 1, {
			top: 0,
			opacity: 1,
			onComplete: function  () {}
		});

		$(".scrollDown").on("click", function () {
			$("body").animate({
				scrollTop: $(".mainProjects").offset().top
			}, 1000);
		})

		$('.sliderList').bxSlider({
			auto: true,
			mode: 'fade',
			pagerCustom: '.sliderPager',
			prevSelector: '.prev',
			nextSelector: '.next',
			prevText: '<img src="images/prev.png"><img src="images/prev@2x.png" width="72">',
			nextText: '<img src="images/next.png"><img src="images/next@2x.png" width="72">',
			onSlideBefore: function () {}
		});

		$('.newsSliderList').bxSlider({
			auto: true,
			slideWidth: 285,
			slideMargin: 36,
			minSlides: 3,
			maxSlides: 3,
			moveSlides: 1,
			pager: false,
			prevSelector: '.nsw-prev',
			nextSelector: '.nsw-next',
			prevText: '<img src="images/prev-green.png"><img src="images/prev-green@2x.png" width="50">',
			nextText: '<img src="images/next-green.png"><img src="images/next-green@2x.png" width="50">',
			onSlideBefore: function () {}
		});
	})
</script>
