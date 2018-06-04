<?php
$query_RecPeople = sprintf("SELECT * FROM class_set
  WHERE c_parent='peopleC' AND c_active='1'
  ORDER BY c_sort ASC");
$RecPeople = mysql_query($query_RecPeople, $connect2data) or die(mysql_error());
// $row_RecPeople = mysql_fetch_assoc($RecPeople);
$totalRows_RecPeople = mysql_num_rows($RecPeople);

$query_RecHome = sprintf("SELECT * FROM class_set
  WHERE c_parent='homeC' AND c_active='1'
  ORDER BY c_sort ASC");
$RecHome = mysql_query($query_RecHome, $connect2data) or die(mysql_error());
// $row_RecHome = mysql_fetch_assoc($RecHome);
$totalRows_RecHome = mysql_num_rows($RecHome);

$query_RecSociety = sprintf("SELECT * FROM class_set
  WHERE c_parent='societyC' AND c_active='1'
  ORDER BY c_sort ASC");
$RecSociety = mysql_query($query_RecSociety, $connect2data) or die(mysql_error());
// $row_RecSociety = mysql_fetch_assoc($RecSociety);
$totalRows_RecSociety = mysql_num_rows($RecSociety);
?>

<div class="topmenuOutWrap m-outWrap">
	<div class="logo image-2x"><a href="index.php"><img src="images/topmenu-logo.png"><img src="images/topmenu-logo@2x.png" width="230"></a></div>

	<div class="topmenuArea">
		<ul class="topmenuList">
			<li class="<?php if ($now=='people'): ?>current<?php endif ?>"><a href="people.php">全人素養</a></li>
			<li class="<?php if ($now=='home'): ?>current<?php endif ?>"><a href="home.php">環境教養</a></li>
			<li class="<?php if ($now=='society'): ?>current<?php endif ?>"><a href="society.php">未來涵養</a></li>
      <!--
      <li> <a href="about.php">關於本網站</a></li>
      -->
		</ul>

		<?php if ($now=='people'): ?>
			<ul class="subMenuList">
				<!--
        <li class="<?php if ($now == 'people' && !isset($ryder_cat)): ?>current<?php endif ?>"><a href="people.php">關於本網站</a></li>
        -->

				<?php while($row_RecPeople = mysql_fetch_assoc($RecPeople)){ ?> //取出People分類資料
					<li class="<?php if (isset($ryder_cat) && $row_RecPeople['c_id'] == $ryder_cat): ?>current<?php endif ?>">
					
					<!--
					<a href="list.php?cat=<?= $row_RecPeople['c_id'] ?>"><?= $row_RecPeople['c_title'] ?></a>
					-->	
					<a href="#"><?= $row_RecPeople['c_menu'] ?></a>
					</li>
				<?php } ?>
			</ul>
		<?php endif ?>

		<?php if ($now=='home'): ?>

			<ul class="subMenuList">
        
				<!--
        <li class="<?php if ($now == 'home' && !isset($ryder_cat)): ?>current<?php endif ?>"><a href="home.php">關於本網站</a></li>
        -->

				<?php while($row_RecHome = mysql_fetch_assoc($RecHome)){ ?> //取出Home分類資料
					<li class="<?php if (isset($ryder_cat) && $row_RecHome['c_id'] == $ryder_cat): ?>current<?php endif ?>">
					<a href="list.php?cat=<?= $row_RecHome['c_id'] ?>"><?= $row_RecHome['c_title'] ?></a>
					</li>
				<?php } ?>
			</ul>
		<?php endif ?>

		<?php if ($now=='society'): ?>
			<ul class="subMenuList">
        <!--
        <li class="<?php if ($now == 'society' && !isset($ryder_cat)): ?>current<?php endif ?>"><a href="society.php">關於本網站</a></li>
        -->
				<?php while($row_RecSociety = mysql_fetch_assoc($RecSociety)){ ?> //取出Society分類資料
					<li class="<?php if (isset($ryder_cat) && $row_RecSociety['c_id'] == $ryder_cat): ?>current<?php endif ?>">
					<a href="list.php?cat=<?= $row_RecSociety['c_id'] ?>"><?= $row_RecSociety['c_title'] ?></a>
					</li>
				<?php } ?>
			</ul>
		<?php endif ?>

		<div class="searchArea">
			<form action="search_result.php" method="GET" class="searchForm">
				<input type="text" name="search" id="search" required>
				<div class="search-submit image-2x"><img src="images/search-bg.png"><img src="images/search-bg@2x.png" width="9"></div>
			</form>
		</div>
	</div>
</div>

<?php mysql_data_seek($RecPeople, 0); ?>
<?php mysql_data_seek($RecHome, 0); ?>
<?php mysql_data_seek($RecSociety, 0); ?>
