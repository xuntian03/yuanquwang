
$(document).ready(function(){
	var web_url = "http://yuanqu.duapp.com/web/yiqi/index.php/Admin/";

	//点击管理项目，显示其内容
	$('.sl-nav ul li').click(function(){
		$(this).css("background","#ccc").siblings().css("background","#fff");
		var index=$(this).index();
		$(".sr-list").eq(index).show().siblings().hide();
	
	})

	//活动留言管理 -- 添加留言者选项
	$("#sel_act").change(function(){
		var mes_user = $(this).val();
		window.open(web_url+"ActmesMan/actMesEdit?mes_user="+$(this).val());
	})
	$("#sel_act2").change(function(){
		var mes_user = $(this).val();
		window.location.href = web_url+"ActmesMan/actMesEdit?mes_user="+$(this).val();
	})


	//活动留言管理 -- 添加留言者选项
	$("#sel_spa").change(function(){
		var spa_user = $(this).val();
		window.open(web_url+"SpamesMan/spaMesEdit?spa_user="+$(this).val());
	})
	$("#sel_spa2").change(function(){
		var spa_user = $(this).val();
		window.location.href = web_url+"SpamesMan/spaMesEdit?spa_user="+$(this).val();
	})

	//二维码管理 -- 添加上传者选项
	$("#sel_sao").change(function(){
		var sao_user = $(this).val();
		window.open(web_url+"SaomaMan/saomaEdit?sao_user="+$(this).val());
	})
	$("#sel_sao2").change(function(){
		var sao_user = $(this).val();
		window.location.href = web_url+"SaomaMan/saomaEdit?sao_user="+$(this).val();
	})


})


