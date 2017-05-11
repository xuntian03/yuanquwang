<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type:text/html;charset=utf-8");
header("Cache-Control:no cache");
class SpaceController extends Controller {
	//个人空间
	public function space(){	
		//判断是否非法登录
		if(checkUserValidate()=='illegal'){
			$this->redirect('User/login');
		}	

		$users = D('users');
		$spa_mess = D('spa_mess');
		$friends = D('friends');
		$lists = D('lists');
		$username = $_SESSION['username'];
		$spacename = $_GET['spacename'];
		
		//得判断是自己访问自己空间，还是访问别人的空间
		if($spacename){
			if($username==$spacename){
				//访问自己空间
				$info = $users->where("username='$username'")->select();
				$mess = $spa_mess->where("spa_getter='$username'")->select();
				$fris = $friends->where("fri_user='$username' and fri_cate=0")->select();
				$list = M()->table("friends as a")->join("users as b on a.fri_post=b.username")
					->where("a.fri_user='$username' and a.fri_cate=1")->select();
				$act = M()->table('actives as a')->join('lists as b on b.id=a.ac_cate')
					->order("ac_time desc")->where("ac_user='$username'")->limit(5)->select();	
				$cre = $lists->order("shijian desc")->where("founder='$username'")->limit(3)->select();
			}else{
				//访问别人空间
				$info = $users->where("username='$spacename'")->select();
				$mess = $spa_mess->where("spa_getter='$spacename'")->select();	
				$list = M()->table("friends as a")->join("users as b on a.fri_post=b.username")
					->where("a.fri_user='$spacename' and a.fri_cate=1")->select();
				$state = $friends->where("fri_post='$spacename' and fri_user='$username'")->select();
				$act = M()->table('actives as a')->join('lists as b on b.id=a.ac_cate')
					->order("ac_time desc")->where("ac_user='$spacename'")->limit(5)->select();	
				$cre = $lists->order("shijian desc")->where("founder='$spacename'")->limit(3)->select();
			}
		}else{
			//访问自己空间
			$info = $users->where("username='$username'")->select();
			$mess = $spa_mess->where("spa_getter='$username'")->select();
			$fris = $friends->where("fri_user='$username' and fri_cate=0")->select();
			$list = M()->table("friends as a")->join("users as b on a.fri_post=b.username")
				->where("a.fri_user='$username' and a.fri_cate=1")->select();	
			$act = M()->table('actives as a')->join('lists as b on b.id=a.ac_cate')
				->order("ac_time desc")->where("ac_user='$username'")->limit(5)->select();	
			$cre = $lists->order("shijian desc")->where("founder='$username'")->limit(3)->select();
		}

		$this->assign('info',$info);		//显示个人信息

		$this->assign('mess',$mess);		//显示留言信息

		$this->assign('fris',$fris);		//显示请求添加好友的信息

		$this->assign('state',$state);		//显示解除好友

		$this->assign('list',$list);		//显示好友列表

		$this->assign('act',$act);		    //显示自己参加的活动

		$this->assign('cre',$cre);			//显示自己发起的活动


		$this->display();
	}
	
	//编辑个人资料
	public function edit(){		

		//判断是否非法登录
		if(checkUserValidate()=='illegal'){
			$this->redirect('User/login');
		}

		//显示注册时的个人信息
		$users = D('users');
		$username = $_SESSION['username'];
		$info = $users->where("username='$username'")->select();
		$this->assign('info',$info); 
		$this->display();
		if($_POST['sub-e']){
			$shuju = $users->create();
			$z = $users->where("username='$username'")->save($shuju);
			if($z){
				$this->redirect('edit',null,0.1,"<script type='text/javascript'>alert('修改成功！')</script>");
			}
		}
		if($_POST['sub-i']){
			//dump($_FILES['dir']);
			if($_FILES['dir']['error']<4){
				$config=array(
					'rootPath'=>'Public/uploads/favicon/',
				);
				$up = new \Think\Upload($config);
				$z = $up->uploadOne($_FILES['dir']);
				$icon = $up->rootPath.$z['savepath'].$z['savename'];
			}
			$_POST['favicon']=$icon;
			$shuju = $users->create();
			$z = $users->where("username='$username'")->save($shuju);
			if($z){
				$this->redirect('edit',null,0.1,"<script type='text/javascript'>alert('修改头像成功！')</script>");
			}
		} 
	}

	//获取空间留言的内容和接收者
	public function spaAjax(){
		$spa_mess = D('spa_mess');
		$spa_cons = $_POST['spa_cons'];
		$spa_getter = $_POST['spa_getter'];
		$_POST['spa_sender'] = $_SESSION['username'];
		$_POST['spa_time']=Date('Y-m-d H:i:s');

		$shuju = $spa_mess->create();
		$z = $spa_mess->add($shuju);
/*
		$arr=array(
			'time'=>$_POST['spa_time'],
			'sender'=>$_POST['spa_sender'],
			'cons'=>$spa_cons
		);
		echo json_encode($arr); */
		echo '{"res":"aa","info":"bb"}';
	}

	//请求添加好友
	public function makeAjax(){
		$_POST['fri_post'] = $_SESSION['username'];
		$_POST['fri_user'] = $_POST['fri_user'];
		$_POST['fri_cate'] = 0;
		$_POST['fri_state'] = "等待同意";
		$friends = D('friends');
		$shuju = $friends->create();
		$z = $friends->Add($shuju);
		echo "等待同意";
	}

	//删除“解除好友”
	public function deleAjax(){
		$dele_post = $_SESSION['username'];
		$dele_user = $_POST['dele_user'];	
		$friends = D('friends');
		$friends->where("fri_post='$dele_post'and fri_user='$dele_user'")->delete();
		$friends->where("fri_post='$dele_user'and fri_user='$dele_post'")->delete();
		echo "解除成功";
	}

	//同意添加好友，状态改为1
	public function agrAjax(){
		$friends = D('friends');
		$agr_post = $_POST['agr_post'];
		$user = $_SESSION['username'];
		$_POST['fri_cate']=1;
		$_POST['fri_state']='解除好友';
		//$z = $friends->where("fri_post='$agr_post' and fri_user='$user'")->field('fri_cate')->save($_POST);
		$data['fri_cate']=1;
		$data['fri_state']='解除好友';
		$z = $friends->where("fri_post='$agr_post' and fri_user='$user'")->save($data);
		//状态修改成功，则反向添加一条数据
		if($z){
			$_POST['fri_user'] = $agr_post;
			$_POST['fri_post'] = $user;
			$_POST['fri_cate'] = 1;
			$_POST['fri_state']='解除好友';
			$shuju = $friends->create();
			$z = $friends->Add($shuju);
		}
	}

	//忽略好友请求
	public function ignAjax(){
		$ign_user = $_SESSION['username'];
		$ign_post = $_POST['ign_post'];	
		$friends = D('friends');
		$friends->where("fri_post='$ign_post'and fri_user='$ign_user'")->delete();
	}

	//显示自己参加的所有活动页面
	public function active(){
		$user = $_GET['user'];;
		//联合查询
		$info = M()->table('actives as a')->join('lists as b on b.id=a.ac_cate')->
				order("ac_time desc")->where("ac_user='$user'")->select();		
		$this->assign('info',$info);
		$this->display();	
	}

	//显示自己发起的所有活动页面
	public function create(){
		$user = $_GET['user'];
		$lists = D('lists');
		$info = $lists->order("shijian desc")->where("founder='$user'")->select();
		$this->assign('info',$info);

		$this->display();
	}


}