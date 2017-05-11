<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type:text/html;charset=urf-8");
header("Cache-Control:no cache");

class DynamicController extends Controller{

	//显示自己学校发布的活动、好友关注的活动、好友发布的活动
	public function dynamic(){

		//判断是否非法登录
		if(checkUserValidate()=='illegal'){
			$this->redirect('User/login');
		}

		$user = $_SESSION['username'];
		//自己学校发布的活动
		$coll = M()->table("users as a")->join("lists as b on a.college=b.region")->where("username='$user'")->select();
		$this->assign('coll',$coll);

		//好友关注的活动
		$act = M()->table("friends as f")->join("actives as a on f.fri_user=a.ac_user")
			->join("lists as l on a.ac_cate=l.id")->where("fri_post='$user' and fri_cate=1")->select();
		$this->assign('act',$act);
		
		//好友发布的活动
		$cre = M()->table("friends as f")->join("lists as l on f.fri_user=l.founder")
			->where("fri_post='$user' and fri_cate=1")->select();
		$this->assign('cre',$cre);	
		
		$this->display();
	}

}