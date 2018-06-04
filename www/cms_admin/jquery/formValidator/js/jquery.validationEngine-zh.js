

(function($) {
	$.fn.validationEngineLanguage = function() {};
	$.validationEngineLanguage = {
		newLang: function() {
			$.validationEngineLanguage.allRules = 	{"required":{    			// Add your regex rules here, you can take telephone as an example
						"regex":"none",
						"alertText":"* 請輸入員工的資料！",
						"alertTextCheckboxMultiple":"* ,請選擇一個選項！",
						"alertTextCheckboxe":"* 此為必填之選項！"},
					"requiredC":{    			// Add your regex rules here, you can take telephone as an example
						"regex":"none",
						"alertText":"* 請輸入驗證碼！"},
					"length":{
						"regex":"none",
						"alertText":"* 請輸入 ",
						"alertText2":" 到 ",
						"alertText3": " 之間字元數！"},
					"maxCheckbox":{
						"regex":"none",
						"alertText":"* 所選擇之選項，超出數量！"},	
					"minCheckbox":{
						"regex":"none",
						"alertText":"* 請選擇",
						"alertText2":" 選項"},	
					"confirm":{
						"regex":"none",
						"alertText":"* 你所輸入的密碼有錯誤！"},		
					"telephone":{
						"regex":"/^[0-9\-\(\)\ ]+$/",
						"alertText":"* 無效的電話號碼！"},	
					"email":{
						"regex":"/^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/",
						"alertText":"* 無效的電子郵件！"},	
					"date":{
                         "regex":"/^[0-9]{4}\-\[0-9]{1,2}\-\[0-9]{1,2}$/",
                         "alertText":"* 無效的日期，必須為 YYYY - MM - DD格式！"},
					"onlyNumber":{
						"regex":"/^[0-9\ ]+$/",
						"alertText":"* 只允許輸入數字！"},	
					"noSpecialCaracters":{
						"regex":"/^[0-9a-zA-Z\-\_\ ]+$/",
						"alertText":"* 不允許特殊字元！"},	
					"ajaxUser":{
						"file":"jquery/formValidator/validateUser.php",
						"extraData":"name=eric",
						"alertTextOk":"* 此帳號還沒有被註冊哦！",	
						"alertTextLoad":"* 讀取中，請稍後！",
						"alertText":"* 此帳號已經被使用了哦！"},	
					"ajaxCaptcha":{
						"file":"jquery/formValidator/validateCaptcha.php",
						"alertText":"* 輸入的驗證錯誤！",
						"alertTextOk":"* 輸入的驗證正確！",	
						"alertTextLoad":"* 讀取中，請稍後！"},	
					"captchaCheck":{
						"regex":"/^[0-9a-zA-Z\-\_\ ]+$/",
						"alertText":"* 不允許特殊字元！"},	
					"onlyLetter":{
						"regex":"/^[a-zA-Z\ \']+$/",
						"alertText":"* Letters only"},
					"AllLetter":{
						"regex":"none",
						"alertText":"* 請輸入姓名！"},
					"validate2fields":{
    					"nname":"validate2fields",
    					"alertText":"* 輸入的驗證錯誤！"}	
					}	
					
		}
	}
})(jQuery);

$(document).ready(function() {	
	$.validationEngineLanguage.newLang()
});