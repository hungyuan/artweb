<div class="footerOutWrap m-outWrap">
	<div class="fow-section-1">
		<div class="leftArea">
			<ul class="footmenuList">
				<li class="<?php if ($now=='people'): ?>current<?php endif ?>"><a href="people.php">全人素養</a></li>
				<li class="<?php if ($now=='home'): ?>current<?php endif ?>"><a href="home.php">環境教養</a></li>
				<li class="<?php if ($now=='society'): ?>current<?php endif ?>"><a href="society.php">未來涵養</a></li>
			</ul>

			<?php if ($now=='people'): ?>
				<ul class="footsubMenuList">
					<li class="<?php if ($now == 'people' && !isset($ryder_cat)): ?>current<?php endif ?>"><a href="people.php">關於本網站</a></li>

					<?php while($row_RecPeople = mysql_fetch_assoc($RecPeople)){ ?>
						<li class="<?php if (isset($ryder_cat) && $row_RecPeople['c_id'] == $ryder_cat): ?>current<?php endif ?>"><a href="list.php?cat=<?= $row_RecPeople['c_id'] ?>"><?= $row_RecPeople['c_title'] ?></a></li>
					<?php } ?>
				</ul>
			<?php endif ?>

			<?php if ($now=='home'): ?>
				<ul class="footsubMenuList">
					<li class="<?php if ($now == 'home' && !isset($ryder_cat)): ?>current<?php endif ?>"><a href="home.php">關於本網站</a></li>

					<?php while($row_RecHome = mysql_fetch_assoc($RecHome)){ ?>
						<li class="<?php if (isset($ryder_cat) && $row_RecHome['c_id'] == $ryder_cat): ?>current<?php endif ?>"><a href="list.php?cat=<?= $row_RecHome['c_id'] ?>"><?= $row_RecHome['c_title'] ?></a></li>
					<?php } ?>
				</ul>
			<?php endif ?>

			<?php if ($now=='society'): ?>
				<ul class="footsubMenuList">
					<li class="<?php if ($now == 'society' && !isset($ryder_cat)): ?>current<?php endif ?>"><a href="society.php">關於本網站</a></li>

					<?php while($row_RecSociety = mysql_fetch_assoc($RecSociety)){ ?>
						<li class="<?php if (isset($ryder_cat) && $row_RecSociety['c_id'] == $ryder_cat): ?>current<?php endif ?>"><a href="list.php?cat=<?= $row_RecSociety['c_id'] ?>"><?= $row_RecSociety['c_title'] ?></a></li>
					<?php } ?>
				</ul>
			<?php endif ?>
		</div>

		<div class="rightArea">
			<div class="logo image-2x"><a href="index.php"><img src="images/footer-logo.png"><img src="images/footer-logo@2x.png" width="217"></a></div>

			<div class="foot-searchArea">
				<form action="search_result.php" method="GET" class="searchForm">
					<input type="text" name="search" id="search" required>
					<div class="search-submit image-2x"><img src="images/search-bg.png"><img src="images/search-bg@2x.png" width="9"></div>
				</form>
			</div>

			<div class="copyright-en">Copyright ©<BR>Kaoshiung Aesthetic Education Site<BR>All rights reserved.</div>
		</div>
	</div>

	<div class="fow-section-2">
		<div class="leftArea">
			<div class="footer-footer">
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

		<div class="rightArea">
			<div class="copyright-ch">高雄市政府教育局 版權所有<BR>本網站由<a href="http://www.fsps.kh.edu.tw" target="_blank" title="左營區福山國小">左營區福山國小</a>負責維護<BR><a href="http://163.16.244.5/cms_admin/login.php" target="_blank">登入管理</a></div>
		</div>
	</div>
</div>
