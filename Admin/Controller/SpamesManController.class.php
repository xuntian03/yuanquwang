<?php
namespace Admin\Controller;
use Think\Controller;
header("Content-type:text/html;charset=utf-8");
header("Cache-Control:no cache");

class SpamesManController extends Controller{

	//显示空间留言管理
	public function spaMesShow(){

		//分页显示
		$spa_mess = D('spa_mess');
		$total_rows = $spa_mess->count();			//总行数
		$page = new \Think\MyPage($total_rows,10);
		$page_info = $spa_mess->limit($page->firstRow.','.$page->listRows)->select();   //显示内容
		$page_show = $page->show();			//显示分页
		$this->assign('spa_mes',$page_info); 
		$this->assign('page_show',$page_show); 

		//显示select所有不相同的留言者
		$spa_user = $spa_mess->distinct(true)->field('spa_sender')->select();
		$this->assign('spa_user',$spa_user);	
		$this->display();

	}

	//删除空间留言
	public function spaMesDele(){
		$id = I("get.id");
		$spa_mess = D('spa_mess');
		$shuju = $spa_mess->where("spa_id='$id'")->field('spa_sender')->select();
		$spa_user = $shuju[0]['spa_sender'];
		$spa_mess->where("spa_id='$id'")->delete();
		$this->redirect('spaMesEdit',array('spa_user'=>$spa_user),0.1,"<script>alert('删除成功！')</script>");
	}

	//空间留言操作界面
	public function spaMesEdit(){
		$spa_user = I('get.spa_user');
		//显示活动留言管理
		$spa_mess = D('spa_mess');
		$spa_mes = $spa_mess->order('spa_time desc')->where("spa_sender='$spa_user'")->select();
		$this->assign('spa_mes',$spa_mes);
		//显示select所有不相同的留言者
		$spa_user = $spa_mess->distinct(true)->field('spa_sender')->select();
		$this->assign('spa_user',$spa_user);
		
		$this->display();	
	}
}