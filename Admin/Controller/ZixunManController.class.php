<?php
namespace Admin\Controller;
use Think\Controller;
header("Content-type:text/html;charset=utf-8");
header("Cache-Control:no cache");

class ZixunManController extends Controller{

	//显示资讯获取界面
	public function zixunShow(){
		//echo "<br><br><br>---<br>";	
		$cate = I('get.cate');
		if($cate=='work'){
			//校园招聘宣讲
			$arrs_work = spiderWork();
			for($i=0;$i<count($arrs_work[0]);$i++){
				$_POST['work_title'] = $arrs_work[0][$i];		
				$_POST['work_cons'] = $arrs_work[1][$i];		
				$_POST['work_time'] = $arrs_work[2][$i];	
				$Work_coll = D('work_coll');
				$shuju = $Work_coll->create();
				$z = $Work_coll->Add($shuju);	
			}
			if($z){
				echo "<script>alert('成功获取最新校园招聘宣讲！')</script>";
			}else{
				echo "<script>alert('获取最新资讯失败！')</script>";
			}
		}elseif($cate=='soci'){
			//抓取社会热点新闻
			$arrs= spiderSoci();
			for($i=0;$i<count($arrs[0]);$i++){
				$_POST['soci_title'] = $arrs[0][$i];		
				$_POST['soci_cons'] = $arrs[1][$i];
				$_POST['soci_time'] = $arrs[2][$i];			
				$Soci_coll = D('soci_coll');
				$shuju = $Soci_coll->create();
				$z = $Soci_coll->Add($shuju);	
			}	
			if($z){
				echo "<script>alert('成功获取最新校园招聘宣讲！')</script>";
			}else{
				echo "<script>alert('获取最新资讯失败！')</script>";
			}			
		}elseif($cate=='hot'){
			//学校热点新闻
			$arrs_hot = spiderHot();
			for($i=0;$i<count($arrs_hot[0]);$i++){
				$_POST['hot_title'] = $arrs_hot[0][$i];		
				$_POST['hot_cons'] = $arrs_hot[1][$i];
				$_POST['hot_time'] = $arrs_hot[2][$i];			
				$_POST['hot_cate'] = '北京交通大学';			
				$Hot_coll = D('hot_coll');
				$shuju = $Hot_coll->create();
				$z = $Hot_coll->Add($shuju);	
			}	
			if($z){
				echo "<script>alert('成功获取最新校园招聘宣讲！')</script>";
			}else{
				echo "<script>alert('获取最新资讯失败！')</script>";
			}			
		}
		$this->display();
	}

	
}