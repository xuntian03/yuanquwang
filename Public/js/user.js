$(document).ready(function(){
	var web_url = "http://yuanqu.duapp.com/web/yiqi/index.php/Home/";

	//验证码刷新
	$('#shuaxin').click(function(){
		$('#veri').attr('src',web_url+'User/verifyImg/'+Math.random());
	});

	//鼠标点击管理员输入框时，清空验证码错误提示
	$('#name').focus(function(){
		$('#ver_col').val(null);
	});

	//出生年份选择
	//onload=function(){
		for(var i = 1976; i < 2005 ; i++){
			$("#sel_year").append('<option value="'+i+'">'+i+'年</option>');
		}
	//}

	//学校选择
	var arr_coll = ['北京交通大学','清华大学','北京大学','中国人民大学','对外经贸大学','北京师范大学',
		'北京航空航天大学','中央财经大学','北京理工大学','北京邮电大学','北京科技大学','中国政法大学',
		'北京外国语大学','北京中医药大学','中国农业大学','中国石油大学','北京化工大学','北京林业大学',
		'北京语言大学','中央民族大学','中国地质大学','华北电力大学','中国矿业大学','北京体育大学',
		'中国人民公安大学','北京协和医学院','北京工商大学','北京联合大学','中央传媒大学','北京工业大学',
		'北方工业大学','首都医科大学','首都师范大学','首都经济贸易大学','国际关系学院','中央戏剧学院',
		'中央美术学院','中央音乐学院','北京印刷学院','北京电子科技学院','外交学院','中国劳动关系学院',
		'北京电影学院','中华女子学院','北京服装学院','北京舞蹈学院','北京信息工程学院','北京城市学院',
		'北京石油化工学院','首钢工学院','北京农学院','首都体育学院','北京第二外国语学院','北京物资学院',
		'中国音乐学院','中国戏曲学院','中国青年政治学院','北京建筑工程学院','北京机械工业学院'];
	for(var i = 0; i < arr_coll.length ; i++){
			$("#sel_coll").append('<option value="'+arr_coll[i]+'">'+arr_coll[i]+'</option>');
	}

	//判断注册的用户名是否已经存在
	$('#reg_name').blur(function(){
		var reg_name = $('#reg_name').val();
		var send_data = {'reg_name':reg_name};
		var url = web_url+"User/regAjax";	  

		$.ajax({
			type:'POST',
			url:url,
			dataType:"json",  
			data:send_data,
			error: function(){ 
						alert('Error loading document'); 
					}, 
			success: function(msg){  
						if(msg==1){
							alert('用户名已经存在！');
							$('#reg_name').val(null);
						}					
					} 
		});
	});

	//无刷新验证用户名是否正确
	$('#name').blur(function(){
		var name = $('#name').val();
		var send_data = {'name':name};
		var url = web_url+"User/userAjax";	  

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
							alert('该用户不存在！');
							$('#name').val(null);
						}
					
					} 
		});

	});


})
