<?php
namespace Admin\Controller;
use Think\Controller;
header("Content-type:text/html;charset=utf-8");
header("Cache-Control:no cache");

class ActiveManController extends Controller{
	
	//显示活动管理
	public function activeShow(){	

		$sou_user = I('post.sou_user');
		$lists = D('lists');
		if(empty($sou_user)){
			//分页显示
			$total_rows = $lists->count();			//总行数
			$page = new \Think\MyPage($total_rows,100);
			$page_info = $lists->order('shijian desc')->
						limit($page->firstRow.','.$page->listRows)->select();		//显示内容
			$page_show = $page->show();			//显示分页
			$this->assign('list',$page_info); 
			$this->assign('page_show',$page_show);
			$this->display();
		}else{
			//通过输入用户名查出用户活动
			$sou_info = $lists->order('shijian desc')->where("founder='$sou_user'")->select();
			if(!$sou_info){
				$this->redirect('activeShow',array(),0.1,"<script>alert('该用户不存在！')</script>");
			}else{
				$founder = $sou_info[0]['founder'];	
				
				$this->assign('list',$sou_info);
				$this->display();
			}								
		}

	}

	//删除活动
	public function activeDele(){
		$id = $_GET['id'];
		$lists = D('lists');
		$lists->where("id='$id'")->delete();
		$this->redirect('activeShow',array(),0.1,"<script>alert('删除成功！')</script>");
	}

	//修改活动
	public function activeEdit(){
		$id = $_GET['id'];
		$lists = D('lists');
		//显示活动内容
		$info = $lists->where("id='$id'")->select();
		$this->assign('info',$info); 

		//保存修改的活动信息
		$shuju = $lists->create();
		$z = $lists->where("id='$id'")->save($shuju);
		if($z){
			$this->redirect('activeShow',array('id'=>$id),0.1,"<script>alert('修改成功！')</script>");
		}

		$this->display();	
	}
}