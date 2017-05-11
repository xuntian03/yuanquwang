<?php
namespace Admin\Controller;
use Think\Controller;
header("Content-type:text/html;charset=utf-8");
header("Cache-Control:no cache");

class UserManController extends Controller{
	
	//显示用户管理
	public function userShow(){

		//分页显示
		$users = D('users');
		$total_rows = $users->count();												 //总行数
		$page = new \Think\MyPage($total_rows,100);
		$page_info = $users->limit($page->firstRow.','.$page->listRows)->select();   //显示内容
		$page_show = $page->show();													 //显示分页
		$this->assign('user',$page_info); 
		$this->assign('page_show',$page_show); 
		$this->display();

		//echo "<br><br><br>";
		//通过输入用户名查询用户
		$sou_user = I('post.sou_user');
		if($sou_user){
			$sou_info = $users->where("username='$sou_user'")->select();
			if(!$sou_info){
				$this->redirect('userShow',array(),0.1,"<script>alert('用户名不存在！')</script>");
			}else{
				$id = $sou_info[0]['id'];	
				$this->redirect('UserMan/userEdit',array('id'=>$id));
			}								
		}
	}	

	//删除用户
	public function userDele(){
		$id = $_GET['id'];
		$users = D('users');
		$users->where("id='$id'")->delete();
		$this->redirect('userShow',array(),0.1,"<script>alert('删除成功！')</script>");
	}

	//编辑用户
	public function userEdit(){
		echo "<br><br><br>";
		$id = I('get.id');
		$users = D('users');
		//显示用户信息
		$info = $users->where("id='$id'")->select();
		$this->assign('info',$info); 
		//保存用户信息
		$shuju = $users->create();
		$z = $users->where("id='$id'")->save($shuju);
		if($z){
			$this->redirect('userShow',array('id'=>$id),0.1,"<script>alert('修改成功！')</script>");
		}

		$this->display();	
	}
}