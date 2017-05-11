<?php
	header("Content-type:text/html;charset=UTF-8");
	require_once("./sqlHelper.class.php");

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
		//var_dump($matches_c[1]);
		//echo $hot_con;
		$sqlHelper=new SqlHelper();
		$sql = "insert into hot_coll values('','$hot_title','$hot_con','北京交通大学')";	
		$sqlHelper->execute_dml($sql);	
		//exit;

	}