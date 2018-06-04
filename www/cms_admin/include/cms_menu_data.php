<?php	
	$menuList = array("首頁","品牌故事","時尚快遞","禮服殿堂","攝影光廊","創意造型","浪漫婚禮","幸福宣言","常見問題","聯絡我們","線上預約","會員專區","關鍵字","訂閱消息","票選活動","其他設定");
	$linkList = array("home.php","about_brand_form.php","fashion_list.php","dress_main.php","photo_main.php","creative_list.php","wedding_list.php","happiness_list.php","faq_list.php","contact.php","reservation_list.php","member_list.php","keywords.php","rss_list.php","campaign_list.php","other_privacy.php");
	$enTitleList = array("home","about","fashion","dress","photo","creative","wedding","happiness","faq","contact","reservation","member","keywords","rss","campaign","other");
	$titleList = array("home"=>"首頁","about"=>"品牌故事","fashion"=>"時尚快遞","dress"=>"禮服殿堂","photo"=>"攝影光廊","creative"=>"創意造型","wedding"=>"浪漫婚禮","faq"=>"常見問題","contact"=>"聯絡我們","reservation"=>"線上預約","member"=>"會員專區","faq"=>"常見問題","member_faq"=>"會員答問集","member_news"=>"會員新訊","member_download"=>"下載專區","member_card"=>"賀卡專區","member_invitation"=>"喜帖專區","memberinvitationreply"=>"會員喜帖","sponsor"=>"協力廠商","happiness"=>"幸福宣言","link"=>"連結分享","rss"=>"訂閱消息","keywords"=>"關鍵字管理","qna"=>"網友答問集","other_privacy"=>"隱私權政策","other_recruit"=>"招募精英");
	
	$submenuList = array(
						"home"=>array(
							array("title"=>"編輯首頁","url"=>"home.php"),
							array("title"=>"協力廠商","url"=>"home_sponsor.php"),
							array("title"=>"連結分享","url"=>"home_link.php")
						),
						"about"=>array(
							array("title"=>"品牌故事主頁內容","url"=>"about_brand_form.php"),
							array("title"=>"品牌故事項目列表","url"=>"about_list.php")
						),
						"dress"=>array(
							array("title"=>"禮服殿堂主頁輪播圖片","url"=>"dress_main.php"),
							array("title"=>"禮服殿堂列表","url"=>"dress_list.php"),
							array("title"=>"禮服殿堂分類","url"=>"dress_class_list.php")
						),
						"photo"=>array(
							array("title"=>"攝影光廊主頁輪播圖片","url"=>"photo_main.php"),
							array("title"=>"攝影光廊列表","url"=>"photo_list.php"),
							array("title"=>"攝影光廊分類","url"=>"photo_class_list.php")
						),
						"reservation"=>array(
							array("title"=>"預約列表","url"=>"reservation_list.php"),
							array("title"=>"預約類型及注意事項","url"=>"reservation_type.php"),
						),/*
						"wedding"=>array(
							array("title"=>"浪漫婚禮主頁輪播圖片","url"=>"wedding_main.php"),
							array("title"=>"浪漫婚禮列表","url"=>"wedding_list.php"),
							array("title"=>"浪漫婚禮分類","url"=>"wedding_class_list.php")
						),*/
						"faq"=>array(
							array("title"=>"問題列表","url"=>"faq_list.php"),
							array("title"=>"問題分類列表","url"=>"faq_class_list.php"),
							array("title"=>"問題主頁說明文字","url"=>"faq_main.php")
						),
						/*"qna"=>array(
							array("title"=>"問題列表","url"=>"qna_list.php"),
							array("title"=>"問題分類列表","url"=>"qna_class_list.php"),
							array("title"=>"問題主頁說明文字","url"=>"qna_main.php")
						),*/
						"member"=>array(
							array("title"=>"會員列表","url"=>"member_list.php"),
							array("title"=>"會員條款","url"=>"member_compact.php"),
							array("title"=>"會員答問集","url"=>"member_faq_list.php"),
							array("title"=>"會員新訊","url"=>"member_news_list.php"),
							array("title"=>"下載專區","url"=>"member_download_list.php"),
							array("title"=>"賀卡專區","url"=>"member_card_list.php"),
							array("title"=>"喜帖專區","url"=>"member_invitation_list.php"),
							array("title"=>"會員喜帖","url"=>"member_invitation_reply_list.php"),
							array("title"=>"喜帖公告","url"=>"member_invitation_news.php"),
							array("title"=>"喜帖按鈕連結","url"=>"member_invitation_links_list.php")
						),
						"other"=>array(
							array("title"=>"隱私權政策","url"=>"other_privacy.php"),
							array("title"=>"招募精英","url"=>"other_recruit.php"),
							array("title"=>"會員地區設定","url"=>"other_location.php")
						)
				 	);
	
	$submenuList2 = array(
						"member_faq"=>array(
							array("title"=>"答問集列表","url"=>"member_faq_list.php"),
							array("title"=>"答問集分類列表","url"=>"member_faq_class_list.php"),
						)/*,
						"member_news"=>array(
							array("title"=>"新訊列表","url"=>"member_news_list.php"),
							array("title"=>"新增新訊","url"=>"member_news_add_form.php"),
						),
						"member_download"=>array(
							array("title"=>"下載列表","url"=>"member_download_list.php"),
							array("title"=>"新增下載","url"=>"member_download_add_form.php"),
						),
						"member_card"=>array(
							array("title"=>"賀卡列表","url"=>"member_card_list.php"),
							array("title"=>"新增賀卡","url"=>"member_card_add_form.php"),
						),
						"member_invitation"=>array(
							array("title"=>"喜帖列表","url"=>"member_invitation_list.php"),
							array("title"=>"新增喜帖","url"=>"member_invitation_add_form.php"),
						)*/
				 	);
?>