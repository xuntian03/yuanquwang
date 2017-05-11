<?php
	header("Content-type:text/html;charset=UTF-8");
	require_once("./sqlHelper.class.php");

    $content = file_get_contents('http://my.yingjiesheng.com/xuanjianghui_province_1.html');
	$reg = '/\<a\s+class=\"f14\"\s+href=\"\/(xjh.+?)\"/';
	preg_match_all($reg,$content,$matches);
	//var_dump($matches);
	$web_url = "http://my.yingjiesheng.com/";
	foreach($matches[1] as $url){
		$url = $web_url.$url;
		//$url = "http://my.yingjiesheng.com/xjh-000-473-619.html";
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

		//获得地点和时间
/*		$reg3 = '/\<p\>(.+)\<\/p\>/';
		preg_match_all($reg3,$con,$matches_a);
		
		$adr = $matches_a[1][1];
		$adr=iconv('gbk','UTF-8',$adr);

		$time = $matches_a[1][3];
		$time=iconv('gbk','UTF-8',$time);
*/
		//获得内容
	//	$reg4 = '/\<div\s+class=\"info\s+p_small\"\>([\s\S]+?)\<\/div\>/';
		$reg4 = '/\<div\s+class=\"xjh_detail_div\"\>([\s\S]+?)\<\/div\>\<\/li\>/';
		preg_match_all($reg4,$con,$matches_c);
	//	$cons = $matches_c[1][0];
	//	$cons=iconv('gbk','UTF-8',$cons);

		$cons="";
		foreach($matches_c[1] as $con){				

			//echo $cons;
			$cons.=$con;
			
		}	
		$cons=iconv('gbk','UTF-8',$cons);

		$sqlHelper=new SqlHelper();
		//$sql = "insert into work_coll values('','$title','$sch','$adr','$time','$cons')";	
		$sql = "insert into work_coll values('','$title','$cons')";	
		$sqlHelper->execute_dml($sql);
		//exit;

	}