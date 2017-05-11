<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type:text/html;charset=utf-8");
header("Cache-Control:no cache");
class ContentController extends Controller {

	//每个活动项目的内容介绍页面
	public function content(){

		//判断是否非法登录
		if(checkUserValidate()=='illegal'){
			echo "<script>alert('请登录之后再查看！')</script>";
			$this->redirect('Index/index');
		}
	
		//保存最近浏览的活动记录		
		$id = I('get.id');
		if(isset($_COOKIE['id'])){
			$ids = $_COOKIE['id'];
			$arr = unserialize($ids);
			$arr[] = $id;
			$arr = array_unique($arr);
			if(count($arr)>6){               //保存最近的5条浏览记录
				array_shift($arr);
			}
			$ids = serialize($arr);
			cookie('id',$ids,3600*24*14);
		}else{
			$arr[] = $id;
			$ids = serialize($arr);
			cookie('id',$ids,3600*24*14);
		}

		//显示某个活动的各个项目
		$lists = D('lists');
		$cons = $lists->where("id='$id'")->select();
		$this->assign('cons',$cons);

		//显示某个活动所有参与者
		$actives = D('actives');
		$mebs = $actives->where("ac_cate='$id'")->select();
		$this->assign('mebs',$mebs);

		//显示留言的信息
		$messages = D('messages');
		$mess = $messages->where("mes_cate='$id'")->select();
		$this->assign('mess',$mess);	
		
		//微信二维码上传
		$saoma = D('saoma');
		if(!empty($_POST)){
			if($_FILES['dir']['error']<4){
				$config=array(
					'rootPath'=>'./Public/uploads/saoma/',
				);
				$up = new \Think\Upload($config);
				$z = $up->uploadOne($_FILES['dir']);
				$big_img=$up->rootPath.$z['savepath'].$z['savename'];
				$big_img=ltrim($big_img,'./');
			}
			$_POST['sao_user']=$_SESSION['username'];
			$_POST['sao_dir']=$big_img;
			$id=$_GET['id'];
			$_POST['sao_cate']=$id;
			$info = $saoma->where("sao_cate='$id'")->select();
			if(empty($info)){
				$shuju = $saoma->create();
				$z = $saoma->add($shuju);
				$imgs = $saoma->where("sao_cate='$id'")->select();
			}else{
				//$saoma->where("sao_cate='$id'")->field('sao_dir')->save($_POST);
				$saoma->where("sao_cate='$id'")->save($_POST);
				$imgs = $saoma->where("sao_cate='$id'")->select();
			} 
			$this->assign('imgs',$imgs);
			$this->display();
		}else{
			$imgs = $saoma->where("sao_cate='$id'")->select();
			$this->assign('imgs',$imgs);
			$this->display();
		} 
	
	}
	
	//显示留言信息
	public function mesAjax(){
		$messages = D('messages');
		$mes_cons = $_POST['mes_cons'];
		$mes_cate = $_POST['mes_cate'];
		$_POST['mes_user'] = $_SESSION['username'];
		$_POST['mes_time']=Date('Y-m-d H:i');

		//将信息收集到数据表
		$shuju = $messages->create();
		$z = $messages->add($shuju);

		//json格式必须严格
		//echo '{"res":"$a","info":"$b"}';
		$arr=array(
			'time'=>$_POST['mes_time'],
			'user'=>$_POST['mes_user'],
			'cons'=>$mes_cons
		);
		echo json_encode($arr);
	}

}