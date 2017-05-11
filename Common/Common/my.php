<?php

//验证非法登录管理员
function checkAdminValidate(){
	if(!$_SESSION['admin_name']){
		return 'illegal';
	}
}

//验证非法登录用户
function checkUserValidate(){
	if(!$_SESSION['username']){
		return 'illegal';
	}
}

//抓取校园招聘宣讲
function spiderWork(){
    $content = file_get_contents('http://my.yingjiesheng.com/xuanjianghui_province_1.html');
	$reg = '/\<a\s+class=\"f14\"\s+href=\"\/(xjh.+?)\"/';
	preg_match_all($reg,$content,$matches);
	$web_url = "http://my.yingjiesheng.com/";
	foreach($matches[1] as $url){
		$url = $web_url.$url;
		$con = file_get_contents($url);

		//获得标题
		$reg1 = '/\<a\s+href=\"\/xuanjianghui_cid_\d+\.html\"\s+\>(.+)/';
		preg_match_all($reg1,$con,$matches_t);
		foreach($matches_t[1] as $title){
			$title=iconv('gbk','UTF-8',$title); //获取的页面为gbk时，转换成utf8
		}		

		//获得学校
		$reg2 = '/\<a\s+href=\"\/xuanjianghui_school_\d+\.html\"\s+\>(.+)\<\/a\>\<\/div\>/';
		preg_match_all($reg2,$con,$matches_s);		
		foreach($matches_s[1] as $sch){			
			$sch=iconv('gbk','UTF-8',$sch);
		}

		//获得内容
		$reg4 = '/\<div\s+class=\"xjh_detail_div\"\>([\s\S]+?)\<\/div\>\<\/li\>/';
		preg_match_all($reg4,$con,$matches_c);

		$cons="";
		foreach($matches_c[1] as $con){				
			$cons.=$con;		
		}	
		$cons=iconv('gbk','UTF-8',$cons);

		//存放数组
		$arr_title[] = $title;
		$arr_cons[] = $cons;
		$time[] = date('Y-m-d H-i-s');
	}
	//存放二维数组
	$arrs[] = $arr_title;
	$arrs[] = $arr_cons;
	$arrs[] = $time;

	return $arrs;
}

//抓取社会热点新闻
function spiderSoci(){
	$url="http://www.shixunwang.net/";
	//获得每篇文章的链接
	$cons=file_get_contents($url);
	$reg='/\/article\/\d+/';
	preg_match_all($reg,$cons,$matches);
	$matches[0]=array_unique($matches[0]);
	//仅取出数组前面的一部分
	$matches[0] = array_slice($matches[0],0,30);	
	foreach($matches[0] as $dir){
		$dir="http://www.shixunwang.net".$dir;
		$cons_dir=file_get_contents($dir);
		//获得titles
		$reg_title="/\<title\>(.+?)\<\/title\>/";
		preg_match_all($reg_title,$cons_dir,$matches_title);
		foreach($matches_title[1] as $title){
			$titles=$title;	
		}
		$titles=str_replace('- 时讯网','',$titles);

		//获得段落contents
		$reg_con='/\<p\>(.+?)\<\/p\>/';
		preg_match_all($reg_con,$cons_dir,$matches_con);
		unset($matches_con[0][count($matches_con[0])-1]);
		$strs='';
		foreach($matches_con[0] as $str){
			$strs.=$str;	
		}
	
		//存放数组
		$arr_title[] = $titles;
		$arr_strs[] = $strs;
		$time[] = date('Y-m-d H-i-s');

	} 
	//存放二维数组
	$arrs[] = $arr_title;
	$arrs[] = $arr_strs;
	$arrs[] = $time;
	return $arrs;
}

//抓取学校热点新闻
function spiderHot(){
    $content = file_get_contents('http://news.bjtu.edu.cn/jdyw.htm');
	$reg = '/(info\/1044\/\d+\.htm)\"\s+title=\"(.+?)\"/';
	preg_match_all($reg,$content,$matches);
	
	$web_url = "http://news.bjtu.edu.cn/";
	foreach($matches[1] as $url){
		$url = $web_url.$url;
		$con = file_get_contents($url);

		//获得标题
		$reg1 = '/\<div\s+class=\"list_bt\s+nei_1\"\>(.+?)\<br\>/';
		preg_match_all($reg1,$con,$matches_t);
		foreach($matches_t[1] as $titles){
			$hot_title = $titles;			
		}		
		
		//获得段落内容
		$reg2 = '/\<p\>(.+?)\<\/p\>/';
		preg_match_all($reg2,$con,$matches_c);
		unset($matches_c[0][count($matches_c[0])-1]);
		$hot_con = "";
		foreach($matches_c[0] as $cons){			
			$hot_con.= $cons;
		}

		//存放数组
		$arr_title[] = $hot_title;
		$arr_cons[] = $hot_con;
		$time[] = date('Y-m-d H-i-s');
	}
	//存放二维数组
	$arrs[] = $arr_title;
	$arrs[] = $arr_cons;
	$arrs[] = $time;
	return $arrs;

}