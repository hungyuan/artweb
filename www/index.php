<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php include 'html_title.php'; ?></title>

	<?php include('meta.php') ?>

	<link rel="stylesheet" href="stylesheets/style.css">
</head>

<body>
	<div class="index-preloadPage">
		<div class="ipp-container">
			<div class="fourboxArea">
				<div class="box-1"></div>
				<div class="box-2"></div>
				<div class="box-3"></div>
				<div class="box-4"></div>
			</div>

			<div class="logo image-2x"><img src="images/logo.png"><img src="images/logo@2x.png" width="256"></div>

			<ul class="preloadList">
				<li><a href="people.php">全人素養</a></li>
				<li><a href="home.php">環境教養</a></li>
				<li><a href="society.php">未來涵養</a></li>
			</ul>
		</div>

		<div class="ipp-footer">
			<div class="item">
				<span class="title">高雄市政府教育局</span>
				<span class="content">社會教育科</span>
				<span class="title">電話</span>
				<span class="content">07-7995678</span>
			</div>
			<div class="item">
				<span class="title">地址</span>
				<span class="content">高雄市鳳山區光復路二段132號</span>
			</div>
		</div>
	</div>
</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="js/vegas.min.js"></script>
<link rel="stylesheet" href="css/vegas.min.css">
<script src="js/common.js"></script>
</html>

<script>
	$(function () {
		$(".index-preloadPage").vegas({
		    timer: false,
		    delay: 5500,
		    transitionDuration: 1800,
		    slides: [
		    { src: "images/preload.jpg" },
		    ],
		    animation: 'kenburnsUp',
		    animationDuration: 10000
		});
	})
</script>
