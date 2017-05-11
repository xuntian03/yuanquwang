
$(document).ready(function(){
	var web_url = "http://yuanqu.duapp.com/web/yiqi/index.php/Home/College/"; 

	//显示横选项卡的title内容
	$('.sl-nav ul li').click(function(){
		//控制被选中选项卡上方的红线
		$(this).css("borderTop","red solid 3px").siblings().css("borderTop","none");
		//控制被选中选项卡下面div的内容
		var index=$(this).index();
		$(".slall > div").eq(index).show().siblings().hide();
		//$(".slall > div").eq(index).css('display','block').siblings().css('display','none');	
	})

    //显示大学选项框
	var arr_coll = ['所有大学','北京交通大学','清华大学','北京大学','中国人民大学','对外经贸大学','北京师范大学',
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
		$("#sel_coll").append('<option value="'+web_url+'college?coll='+arr_coll[i]+'">'
		+arr_coll[i]+'</option>');
	}

	//通过选择大学显示相应学校的内容
	$('#sel_coll').change(function(){
		
		if(this.selectedIndex!=0){
			window.location.href = this.options[this.selectedIndex].value;  //在原窗口打开
			//改变tab显示的内容
		/*	var name= $('#sel_coll').val();
			var index = name.lastIndexOf("\=");
			name = name.substring(index+1,name.length);
			//alert(name);
			$('#hot').html(name);
			//$('#hot').append("<a>hhhhh</a>");
		*/
		}

	})

	

})

