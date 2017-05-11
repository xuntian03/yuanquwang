<?php
namespace Admin\Controller;
use Think\Controller;
header("Content-type:text/html;charset=utf-8");
header("Cache-Control:no cache");

class ActmesManController extends Controller{

	//显示活动留言管理
	public function actMesShow(){

		//分页显示
		$total_rows = M()->table('messages as m')->join('lists as l on m.mes_cate=l.id')
				->order("mes_time desc")->count();												//总行数
		$page = new \Think\MyPage($total_rows,10);
		$page_info = M()->table('messages as m')->join('lists as l on m.mes_cate=l.id')			//显示内容
				->order("mes_time desc")->limit($page->firstRow.','.$page->listRows)->select();   
		$page_show = $page->show();																//显示分页
		$this->assign('mess',$page_info); 
		$this->assign('page_show',$page_show);

		//显示select所有不相同的留言者
		$messages = D('messages');
		$mes_user = $messages->distinct(true)->field('mes_user')->select();
		$this->assign('mes_user',$mes_user);
		$this->display();

	}

	//删除活动留言
	public function actMesDele(){
		$id = I("get.id");
		$messages = D('messages');
		$shuju = $messages->where("mes_id='$id'")->field('mes_user')->select();
		$mes_user = $shuju[0]['mes_user'];
		$messages->where("mes_id='$id'")->delete();
		$this->redirect('actMesEdit',array('mes_user'=>$mes_user),0.1,"<script>alert('删除成功！')</script>");
	}

	//显示活动留言编辑界面
	public function actMesEdit(){
		$mes_user = I('get.mes_user');
		//显示活动留言管理
		$mess = M()->table('messages as m')->join('lists as l on m.mes_cate=l.id')
				->where("mes_user='$mes_user'")->order("mes_time desc")->select();
		$this->assign('mess',$mess);
		//显示select所有不相同的留言者
		$messages = D('messages');
		$mes_user = $messages->distinct(true)->field('mes_user')->select();
		$this->assign('mes_user',$mes_user);
		
		$this->display();	
	}
}