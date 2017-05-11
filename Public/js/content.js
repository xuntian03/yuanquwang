
$(document).ready(function(){
	var web_url = "http://yuanqu.duapp.com/web/yiqi/index.php/Home/";
	
	//留言信息提交
	$('#sub-mess').click(function(){
		var mes_cons = $('#mess').val();
		var mes_cate = $('#mess-id').val();

		var send_data = {'mes_cons':mes_cons,'mes_cate':mes_cate};
		var url = web_url+"Content/mesAjax";

		$.ajax({
			type:'POST',
			url:url,
			dataType:"json",  //服务器端json格式必须严格按照："键值":"值"的格式
			data:send_data,
			error: function(){ 
						alert('Error loading document'); 
					}, 
			success: function(msg){  
 
				/*	alert(typeof msg);
					$.each(msg,function(i,item)){
						alert('ad');
						alert(item.res);
					}*/
						$(msg).each(function(){
							$(".sm-new").append("<div class='sm-mess'><p class='sm-mess-time'>"
							+"最新发表时间　"+this.time+"</p><p class='sm-mess-user'>"+"留言者　"
							+this.user+"</p><p class='sm-mess-cons'>"+this.cons+"</p></div>");
						})
						$('#mess').val(null);
					} 
		});
	});

	//参加活动
	$('#vote_ok').click(function(){
		var lists_id = ($(this).siblings('#lists_id').val());
		var lists_zan = ($(this).siblings('#lists_zan').val());

		var send_data = {'dianzan':lists_zan,'id':lists_id};
		$(this).siblings('#lists_zan').load(web_url+"Index/getAjax",send_data)
	 		//	alert(send_data);
	}); 


}) 
