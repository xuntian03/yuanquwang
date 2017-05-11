
$(document).ready(function(){
	var web_url = "http://yuanqu.duapp.com/web/yiqi/index.php/Home/";
	
	//留言信息提交
	$('#sub-mess').click(function(){
	
		var spa_cons = $('#mess').val();		
		var spa_getter = $('.sl-img-user').html();

		var send_data = {'spa_cons':spa_cons,'spa_getter':spa_getter};
		var url = web_url+"Space/spaAjax";	  

		$.ajax({
			type:'POST',
			url:url,
			dataType:"json",  
			data:send_data,
			error: function(){ 
						alert('Error loading document'); 
					}, 
			success: function(msg){  
						$(msg).each(function(){
							$(".sm-mes-new").append("<div class='sm-mes-show'><p class='sm-mess-time'>"
							+"最新留言时间　"+this.time+"</p><p class='sm-mess-sender'>"+"留言者　"
							+this.sender+"</p><p class='sm-mess-cons'>"+this.cons+"</p></div>");
						})
						$('#mess').val(null);

					} 
		}); 
	});

	//添加好友
	$('#make-fri').click(function(){
		var fri_user = $('#fri-user').html();
		var send_data = {'fri_user':fri_user};
		var url = web_url+"Space/makeAjax";	
		//alert(fri_user);
        $('#make-fri').load(url,send_data,function(data,textStatus,xmlHttpRequest){
			 $('#make-fri').html(data);
		});
		alert("添加好友请求成功！");	
	})

	//解除好友
	$('#dele-fri').click(function(){
		var dele_user = $('#fri-user').html();
		var send_data = {'dele_user':dele_user};
		var url = web_url+"Space/deleAjax";	
		//alert(dele_user);
        $('#dele-fri').load(url,send_data,function(data,textStatus,xmlHttpRequest){
			 $('#dele-fri').html(data);
		});
		alert("好友解除成功！");	
	})

	//同意好友请求
	$('.agree').click(function(){
		var agr_post = $(this).siblings('.agr-post').html();
		var send_data = {'agr_post':agr_post};
		var url = web_url+"Space/agrAjax";	
        $(this).load(url,send_data);
		alert("同意添加！");
		$(this).siblings().hide();	
	})

	//忽略好友请求
	$('.ignore').click(function(){
		var ign_post = $(this).siblings('.agr-post').html();
		var send_data = {'ign_post':ign_post};
		var url = web_url+"Space/ignAjax";	
		$(this).load(url,send_data);
		$(this).siblings().hide();
	})

}) 
