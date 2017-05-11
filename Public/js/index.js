
$(document).ready(function(){
	var web_url = "http://yuanqu.duapp.com/web/yiqi/index.php/Home/Index";

	//搜索内容
	$('#img-sou').click(function(){
		var cons = $('.h-cons-sou').val();
		var web_cons = web_url+'/main?cons='+cons;
		window.open(web_cons);	
	})
	//搜索内容 -- 游客
	$('#img-sous').click(function(){
		var cons = $('.h-cons-sou').val();
		var web_cons = web_url+'/index?cons='+cons;
		window.open(web_cons);	
	})

	//显示提示消息
	$('#float-info').mouseover(function(){
		$('#float-show').show();	
	})
	//离开则隐藏消息
	$('#float').mouseout(function(){
		//$('#float-show').hide();	
	})

/*	
	//显示热门活动的参与人数
	$('.sh span').mouseover(function(){
		//var zan = $(this).siblings('#zan').val();
		$(this).append("<strong>"+zan+"人参加</strong>").css("color","#aaa");	
	})
	$('.sh span').mouseout(function(){
		$('.sh strong').hide();	
	})
*/

	//点赞数增加
	$('.sl-list-con img').click(function(){
		var lists_id = ($(this).siblings('#lists_id').val());
		var lists_zan = ($(this).siblings('#lists_zan').html());
		//alert(lists_zan);
		var send_data = {'dianzan':lists_zan,'id':lists_id};
		$(this).siblings('#lists_zan').load(web_url+"/getAjax",send_data,
		function(data,textStatus,xmlHttpRequest){
			//alert("服务器返回："+data);	
			//$(this).val(data);
			$(this).html(data);
		});		 			
	}) 

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
		$("#sel_coll").append('<option value="'+web_url+'/main?coll='+arr_coll[i]+'">'
		+arr_coll[i]+'</option>');
	}

	//通过选择大学显示相应学校的活动
	$('#sel_coll').change(function(){
		//alert(this.selectedIndex);
		if(this.selectedIndex!=0){
			//window.open(this.options[this.selectedIndex].value);          //在新窗口打开
			window.location.href = this.options[this.selectedIndex].value;  //在原窗口打开
		}
	})
	//通过选择大学显示相应学校的活动 -- 游客
	for(var i = 0; i < arr_coll.length ; i++){
		$("#sel_colls").append('<option value="'+web_url+'/index?coll='+arr_coll[i]+'">'
		+arr_coll[i]+'</option>');
	}
	$('#sel_colls').change(function(){
		if(this.selectedIndex!=0){
			window.location.href = this.options[this.selectedIndex].value;  //在原窗口打开
		}
	})


/***************************************以下为实现图片滚动功能****************************************/
	//定义变量
	var num1 = 0;  //不能定义在函数里边，否则每次值都会归零
	var num2 = 0; 
	var links=$(".sl-pic-title a");
	var float=$(".float");
	var imgs=$(".sl-pic-img img");	

	//左翻页
	$(".leftB").click(function(){
		imgs.finish();
		float.stop(true);
		var temp=num1;
		num1--;
		if(num1==-1){
			num1=4;
		}
		imgs.eq(num1).css("left",616).animate({left:0});
		imgs.eq(temp).animate({left:-616});
		links.css("color","#009797");
		float.animate({left:links.eq(num1).position().left})
		links.eq(num1).css("color","#fff");
	});

	//右翻页
	$('.rightB').click(function(){		
		var temp = num1;
		imgs.finish();
		num1++;
		if(num1==5){
			num1=0;
		}
		imgs.eq(num1).css("left",-616).animate({left:0});
		imgs.eq(temp).animate({left:616});	
		links.css("color","#009797");
		float.animate({left:links.eq(num1).position().left})
		links.eq(num1).css("color","#fff");
	})

	//点击页数实现翻页
	links.hover(function(){		
		imgs.finish();
		float.stop(true);
		links.css("color","#009797");
		var that=$(this);
		var lefts=$(this).position().left;
		float.animate({left:lefts},function(){
			that.css("color","#fff");
		})

		var index=$(this).index(".sl-pic-title a");
		num2=index;
		if(num1==num2){
			return;
		}else if(num1<num2){
			imgs.eq(num2).css("left",616).animate({left:0});
			imgs.eq(num1).animate({left:-616});
		}else if(num1>num2){
			imgs.eq(num2).css("left",-616).animate({left:0});
			imgs.eq(num1).animate({left:616});
		}
		num1=num2;
		num2="";
	},function(){

	}) 

	//图片上的上一页和下一页图标	
	$('.sl-pic').hover(function(){
		$(".leftB,.rightB").css("display","block");
	},function(){
		$(".leftB,.rightB").css("display","none");
	});

	//自动播放图片
	setInterval(autoPic,2500); 
	function autoPic() 
	{ 
		var temp = num1;
		imgs.finish();
		num1++;
		if(num1==5){
			num1=0;
		}
		imgs.eq(num1).css("left",-616).animate({left:0});
		imgs.eq(temp).animate({left:616});	
		links.css("color","#009797");
		float.animate({left:links.eq(num1).position().left})
		links.eq(num1).css("color","#fff");
	} 

/***************************************以下为实现测字内容****************************************/

	var flag = 1;
	$('#test-sub').click(function(){

		//时间数组，0:00-12:00
		var cate11 = ['等会儿','过会儿','一会儿','待会儿','等会','过会','一会','待会',
					'上午','中午','晌午','下午'];
		//时间数组，12:00-18:00
		var cate12 = ['等会儿','过会儿','一会儿','待会儿','等会','过会','一会','待会',
					'下午','傍晚','黄昏','晚上','夜里','明天早上','明天上午','明天中午'];
		//时间数组，18:00-24:00
		var cate13 = ['等会儿','过会儿','一会儿','待会儿','等会','过会','一会','待会',
					'晚上','夜里','明天早上','明天上午','明天中午','明天下午','明天晚上'];
		//动词数组
		var cate2 = ['找人','找伴','寻人','寻伴','约人','约伴','相约'];
		//副词数组
		var cate3 = ['去','一齐','一起','一块','一同','一齐去','一起去','一块去','一同去','一块儿',
					'一块儿去'];
		//事件数组
		var cate4 = ['看电影','吃饭','唱歌','户外玩','桌游','玩游戏','三国杀','杀人','狼人杀','爬山',
					'划船','跑步','学习','上自习','看博物馆','看展览馆','郊游','骑车'];

		var test_cons = $('#test-cons').val();
		var d = new Date()
		var hours = d.getHours();
		var lengs = test_cons.length;
		var index11 = Math.floor(Math.random()*(cate11.length));
		var index12 = Math.floor(Math.random()*(cate12.length));
		var index13 = Math.floor(Math.random()*(cate13.length));
		var index2 = Math.floor(Math.random()*(cate2.length));
		var index3 = Math.floor(Math.random()*(cate3.length));
		var index4 = Math.floor(Math.random()*(cate4.length));

		if(flag<4){
			if(test_cons){
				if(hours>=0 && hours<12){
					$(".sr-test").append("<div class='sr-test-res'><p>"+"给您的建议"+flag+"："
					+cate11[index11]+cate2[index2]+cate3[index3]+cate4[index4]+"</p></div>");				
				}
				if(hours>=12 && hours<18){
					$(".sr-test").append("<div class='sr-test-res'><p>"+"给您的建议"+flag+"："
					+cate12[index12]+cate2[index2]+cate3[index3]+cate4[index4]+"</p></div>");				
				}
				if(hours>=18 && hours<24){
					$(".sr-test").append("<div class='sr-test-res'><p>"+"给您的建议"+flag+"："
					+cate13[index13]+cate2[index2]+cate3[index3]+cate4[index4]+"</p></div>");				
				}	
				flag++;
			}else{
				alert("请输入测试的内容");
			}
		}else{
			alert("最多只能测试三次！");
		}	
		//alert(flag);
		$('#test-cons').val(null);
	})




})

