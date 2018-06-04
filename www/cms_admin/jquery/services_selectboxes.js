$(function () {

    // 判斷是否有預設值
    var defaultValue = false;
    if (0 < $.trim($('#fullIdPath').val()).length) {
        $fullIdPath = $('#fullIdPath').val().split(',');
        defaultValue = true;
		
    }
    //alert($fullIdPath[3]);
    // 設定預設選項
    if (defaultValue) {
        $('#select1').selectOptions($fullIdPath[0]); 
    }
   
    // 開始產生關聯下拉式選單
    $('#select1').change(function () {							   
		//alert("ok");
        // 觸發第二階下拉式選單
        $('#select2').removeOption(/.?/).ajaxAddOption(
            'jquery/action.php?temp='+Math.random(), 
            { 'term_id': $(this).val(), 'lv': 2, 'u_add': 2, 'taxonomy':'post_tag'}, 
            false, 
            function () {
				window.location.href = "services_list.php?selected1="+$('#select1').val()+"&selected2="+$('#select2').val();         
                // 設定預設選項
               /* if (defaultValue) {
                    $(this).selectOptions($fullIdPath[1]).trigger('change');
                } else {
                    $(this).selectOptions().trigger('change');
                }*/
				/*$('#select3').removeOption(/.?/).ajaxAddOption(
          	  'jquery/action.php?temp='+Math.random(), 
         	   { 'c_id': $(this).val(), 'lv': 3, 'u_add': 1}, 
         	   false
     		   )*/
            }
        )/*.change(function () {
            // 觸發第三階下拉式選單
            $('#select3').removeOption(/.?/).ajaxAddOption(
                'jquery/action.php?temp='+Math.random(), 
                { 'c_id': $(this).val(), 'lv': 3 , 'u_add': 1}, 
                false
            );
        });*/
		/*alert($('#select2').selectOptions());
		alert($('#select2').selectedValues());
		alert($('#select2').selectedTexts());
		alert($('#select2').val());*/
		//$('#select3').removeOption(/.?/);
		/*$('#select3').removeOption(/.?/).ajaxAddOption(
            'jquery/action.php?temp='+Math.random(), 
            { 'c_id': $('#select2').val(), 'lv': 3, 'u_add': 1}, 
            false
        )*/
	
    })//.trigger('change');
	
	 /*$('#select2').change(function () {							   
		//alert("ok");
        // 觸發第二階下拉式選單
        $('#select3').removeOption(/.?/).ajaxAddOption(
            'jquery/action.php?temp='+Math.random(), 
            { 'c_id': $(this).val(), 'lv': 3, 'u_add': 1}, 
            false
        )
	});*/
	 
    // 全部選擇完畢後，顯示所選擇的選項
    $('#select2').change(function () {
		if($('#select2').val()!=0){					   
        /*alert('主機：' + $('#select1 option:selected').text() + 
              '／類型：' + $('#select2 option:selected').text() +
              '／遊戲：' + $('#select3 option:selected').text());		*/
		window.location.href = "services_list.php?selected1="+$('#select1').val()+"&selected2="+$('#select2').val();
		}
    });
});