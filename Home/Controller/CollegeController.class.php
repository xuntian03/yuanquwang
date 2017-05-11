<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type:text/html;charset=utf-8");
header("Cache-Control:no cache");
class CollegeController extends Controller{
	
	//园趣校园主页面
	public function college(){		
		$coll = $_GET['coll'];	
		if($coll!=""&&$coll!="所有大学"){
			//显示选择学校后出现的tab
			$lists = D('lists');		
			$tab = $lists->where("id=1")->select();			
			$this->assign('tab',$tab);
		
			//学校热点新闻
			$hot_coll = D('hot_coll');		
			$news = $hot_coll->where("hot_cate='$coll'")->select();			
			$this->assign('news',$news);
			
			//学校所有活动
			//$lists = D('lists');
			$act = $lists->where("region='$coll'")->select();
			$this->assign('act',$act);
		}else{
			//显示未选择学校时的首页
			$lists = D('lists');		
			$shou = $lists->where("id=1")->select();			
			$this->assign('shou',$shou);

			//校园宣讲会
			$work_coll = D('work_coll');
			$work = $work_coll->order('work_time desc')->limit(30)->select();
			$this->assign('work',$work);

			//社会热点新闻
			$soci_coll = D('soci_coll');
			$soci = $soci_coll->order('soci_time desc')->limit(30)->select();
			html_entity_decode($soci, ENT_QUOTES, 'UTF-8');
			$this->assign('soci',$soci);
		}

		$this->display();
	}

	//学校新闻页面
	public function collNews(){
		$id = $_GET['id'];
		$hot_coll = D('hot_coll');	
		$info = $hot_coll->where("hot_id='$id'")->select();			
		$this->assign('info',$info);

		$this->display();		
	
	}

	//校园招聘页面
	public function collWork(){
		$id = $_GET['id'];
		$work_coll = D('work_coll');	
		$info = $work_coll->where("work_id='$id'")->select();			
		$this->assign('info',$info);

		$this->display();			
	}

	//社会热点新闻页面
	public function collSoci(){
		$id = $_GET['id'];
		$soci_coll = D('soci_coll');	
		$info = $soci_coll->where("soci_id='$id'")->select();			
		$this->assign('info',$info);

		$this->display();			
	}


}