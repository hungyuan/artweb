<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php include 'html_title.php'; ?></title>

	<?php include('meta.php') ?>

	<link rel="stylesheet" href="stylesheets/style.css">

	<style>
		.sliderList li:after{display: none;}
	</style>
</head>

<body>
	<?php $now='people' ?>
	<?php include 'topmenu.php'; ?>

	<div class="sliderWrap m-outWrap">
		<div class="colorBlock"></div>

		<ul class="sliderList">
			<li><img src="images/list-banner.jpg"></li>
		</ul>

		<div class="slider-slogan">
			<div class="en">Creativity</div>
			<div class="ch">激發孩子的創造力<BR>成為小小藝術家</div>
		</div>
	</div>

	<div class="articleOutWrap m-outWrap">
		<div class="catWrap">
			<ul class="catList">
				<li><a href="people.php">美麗市民</a>
					<ul class="subCatList">
						<li><a href="people_list.php">老幼代間共學</a></li>
						<li><a href="people_list.php">整合資源全面美感學習</a></li>
						<li class="current">創客博覽會</li>
						<li><a href="people_list.php">夥伴學校美感實踐協作</a></li>
						<li><a href="people_list.php">非專長教師增能培訓</a></li>
						<li><a href="people_list.php">校園美感基地</a></li>
						<li><a href="people_list.php">藝術深耕</a></li>
						<li><a href="people_list.php">美感教學研究</a></li>
					</ul>
				</li>
				<li><a href="home.php">美麗市民</a></li>
				<li><a href="society.php">美善社會</a></li>
			</ul>
		</div>

		<div class="articleWrap">
			<ul class="bread">
				<li>Home</li>
				<li>></li>
				<li>美麗市民</li>
				<li>></li>
				<li>創客博覽會</li>
			</ul>

			<ul class="articleList">
				<li><a href="people_detail.php">
					<div class="date">2016.10.01</div>
					<div>
						<div class="container">
							<div class="title">實踐生活，鼓勵Maker，構築夢想基地</div>
							<div class="content">高雄市教育局、國立科學工藝博物館與高雄市自造者發展協會共同主辦，首屆自2015在國立科學工藝博物館舉辦「第一屆南台灣創客教育博覽會」，共有來自高雄市各級學校、大專院校與企業120...</div>
						</div>
						<div class="pic"><img src="images/list-pic.png"></div>
					</div>
				</a></li>
				<li class="has-pic"><a href="people_detail.php">
					<div class="date">2016.10.01</div>
					<div>
						<div class="container">
							<div class="title">實踐生活，鼓勵Maker，構築夢想基地</div>
							<div class="content">高雄市教育局、國立科學工藝博物館與高雄市自造者發展協會共同主辦，首屆自2015在國立科學工藝博物館舉辦「第一屆南台灣創客教育博覽會」，共有來自高雄市各級學校、大專院校與企業120...</div>
						</div>
						<div class="pic"><img src="images/list-pic.png"></div>
					</div>
				</a></li>
				<li><a href="people_detail.php">
					<div class="date">2016.10.01</div>
					<div>
						<div class="container">
							<div class="title">實踐生活，鼓勵Maker，構築夢想基地</div>
							<div class="content">高雄市教育局、國立科學工藝博物館與高雄市自造者發展協會共同主辦，首屆自2015在國立科學工藝博物館舉辦「第一屆南台灣創客教育博覽會」，共有來自高雄市各級學校、大專院校與企業120...</div>
						</div>
						<div class="pic"><img src="images/list-pic.png"></div>
					</div>
				</a></li>
			</ul>

			<div class="pager">
				<a href="javascript:;" class="image-2x"><img src="images/page-prev.png"><img src="images/page-prev@2x.png" width="13"></a>
				<a href="javascript:;" class="current">1</a>
				<a href="javascript:;">2</a>
				<a href="javascript:;" class="image-2x"><img src="images/page-next.png"><img src="images/page-next@2x.png" width="13"></a>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
<script src="js/common.js"></script>
</html>

<script>
	$(function () {
		TweenMax.to($(".sliderWrap"), 1, {
			top: 0,
			opacity: 1,
			onComplete: function  () {}
		});

		TweenMax.to($(".catWrap"), 1, {
			top: 0,
			opacity: 1,
			onComplete: function  () {}
		});

		TweenMax.to($(".bread"), 1, {
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