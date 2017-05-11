
//显示横选项卡的title内容
$(document).ready(function(){
	$('.tab ul li').click(function(){
		//控制被选中选项卡上方的红线
		$(this).css("borderTop","red solid 3px").siblings().css("borderTop","none");
		//控制被选中选项卡下面div的内容
		var index=$(this).index();
		$(".sm > div").eq(index).show().siblings().hide();
		//$(".slall > div").eq(index).css('display','block').siblings().css('display','none');	
	})

/*	$('#sub-i').click(function(){
		var mes_cate = "bb";
		alert($('.dir').val());
		var send_data = {'mes_cate':mes_cate};
		var url = "http://localhost:88/web/yiqi/index.php/Home/Space/avaAjax";
		$.ajax({
			type:'POST',
			url:url,
			dataType:"json",  //服务器端json格式必须严格按照："键值":"值"的格式
			data:send_data,
			error: function(){ 
						alert('Error loading document'); 
					}, 
			success: function(msg){ 
					
						alert(msg);
					} 
		})
	})*/
})

