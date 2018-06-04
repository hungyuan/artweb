<?php
$uploadFileSize = "每次上傳之檔案大小總計請勿超過".ini_get("upload_max_filesize")."。";
$maxFileSize = "<br />$uploadFileSize";
ini_set('memory_limit', '256M');



$imagesSize = array(
	"people"	=>	array(
		'IW'	=> 285,
		'IH'	=> 200,
		'note'	=> "圖片請上傳寬 285pixel、高 200pixel之圖檔。 $maxFileSize"
		),
	"home"	=>	array(
		'IW'	=> 285,
		'IH'	=> 200,
		'note'	=> "圖片請上傳寬 285pixel、高 200pixel之圖檔。 $maxFileSize"
		),
	"society"	=>	array(
		'IW'	=> 285,
		'IH'	=> 200,
		'note'	=> "圖片請上傳寬 285pixel、高 200pixel之圖檔。 $maxFileSize"
		),
	"farmer"	=>	array(
		'IW'	=> 700,
		'IH'	=> 800,
		'note'	=> "圖片請上傳寬不大於716 pixel 72dpi之圖檔。 $maxFileSize"
		),
	"awardTIndex"	=>	array(
		'IW'	=> 200,
		'IH'	=> 200,
		'note'	=> "200*200 $maxFileSize"
		),
	"news"	=>	array(
		'IW'	=> 800,
		'IH'	=> 530,
		'note'	=> "圖片請上傳寬 800pixel、高 530pixel之圖檔。 $maxFileSize"
		),
	"newsCover"	=>	array(
		'IW'	=> 300,
		'IH'	=> 195,
		'note'	=> "圖片請上傳寬 300pixel、高 195pixel之圖檔。 $maxFileSize"
		),
	"rooms"	=>	array(
		'IW'	=> 800,
		'IH'	=> 530,
		'note'	=> "圖片請上傳寬 800pixel、高 530pixel之圖檔。 $maxFileSize"
		),
	"roomsCover"	=>	array(
		'IW'	=> 600,
		'IH'	=> 220,
		'note'	=> "圖片請上傳寬 600pixel、高 220pixel之圖檔。 $maxFileSize"
		),
	"other"		=>	array(
		'IW'	=> 700,
		'IH'	=> 800,
		'note'	=> "圖片請上傳寬不大於700 pixel 72dpi之圖檔。 $maxFileSize"
		)
	);
?>