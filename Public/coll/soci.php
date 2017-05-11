<?php

header("Content-type:text/html;charset=UTF-8");
require_once('./sqlHelper.class.php');

function getAllNews($url){
	//获得每篇文章的链接
	$cons=file_get_contents($url);
	$reg='/\/article\/\d+/';
	preg_match_all($reg,$cons,$matches);
	$matches[0]=array_unique($matches[0]);
	$flag = 0;
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
		//echo $titles.'<br \>';

		//获得段落contents
		$reg_con='/\<p\>[^\<](.+?)\<\/p\>/';
		preg_match_all($reg_con,$cons_dir,$matches_con);
		unset($matches_con[0][count($matches_con[0])-1]);
		$strs='';
		foreach($matches_con[0] as $str){
			$strs.=$str;	
		}
		//var_dump($matches_con);
		//echo $strs;
		
		//获取时间
		$time = date('Y-m-d H-i-s');

		//存入数据库
		$sqlHelper=new SqlHelper();
		$sql="insert into soci_coll values('','$titles','$strs','$time')";
		$sqlHelper->execute_dml($sql);
		$flag++;
		if($flag==10){
			exit;
		}
	//	exit;
	} 
}

	$web="http://www.shixunwang.net/";

	getAllNews($web);




?>