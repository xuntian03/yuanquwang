
$(document).ready(function(){
	var web_url = "http://yuanqu.duapp.com/web/yiqi/index.php/Home/";

	//显示横选项卡的title内容
	$('.sm-nav ul li').click(function(){
		//控制被选中选项卡上方的红线
		$(this).css("borderTop","red solid 3px").siblings().css("borderTop","none");
		//控制被选中选项卡下面div的内容
		var index=$(this).index();
		$(".slall > div").eq(index).show().siblings().hide();

	})


})

