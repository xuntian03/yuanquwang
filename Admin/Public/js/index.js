
$(document).ready(function(){
	var web_url = "http://yuanqu.duapp.com/web/yiqi/index.php/Admin/";

	//无刷新验证管理员是否存在
	$('#name').blur(function(){
		var name = $('#name').val();
		var send_data = {'name':name};
		var url = web_url+"Index/userAjax";	  

		$.ajax({
			type:'POST',
			url:url,
			dataType:"json",  
			data:send_data,
			error: function(){ 
						alert('Error loading document'); 
					}, 
			success: function(msg){  
						if(msg==0){
							alert('管理员不存在！');
							$('#name').val(null);
						}
					
					} 
		});

	});

	//鼠标点击管理员输入框时，清空验证码错误提示
	$('#name').focus(function(){
		$('#ver_col').val(null);
	});

	//验证码刷新
	$('#shuaxin').click(function(){
		$('#veri').attr('src',web_url+'Index/verifyImg/'+Math.random());
	});

})

