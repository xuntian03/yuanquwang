<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type:text/html;charset=utf-8");
header("Cache-Control:no cache");
class UserController extends Controller {
	//用户登录
    public function login(){	
		if(!empty($_POST)){
			
			//判断是否选中保存用户名
			if($_POST['box']){
				cookie('save_name',$_POST['username'],3600*24*12);
				$this->assign('save_name','');
			}else{
				cookie('save_name',null);
				$this->assign('save_name','');
			}

			//验证验证码
			$verify = new \Think\Verify();
			$ver = $verify->check($_POST['verify']);
			if($ver){	
				//验证用户名和密码
				$login = new \Model\LoginModel();
				$info = $login->check($_POST['username'],$_POST['password']);
				if($info){
					//保存登录用户名
					session('username',$info['username']);
					$this->redirect('Index/main');
				}else{
					echo "<script type='text/javascript'>alert('用户名或密码错误！')</script>";
					$this->display();
				}
			}else{
				$this->assign('ver_err','验证码错误!!');
				$this->display();
			}
		}else{
			if(isset($_COOKIE['save_name'])){
				$save_name = cookie('save_name');
				$this->assign('save_name',$save_name);
			}else{
				$this->assign('save_name','');
			}
			$this->display();
		}
	}

	//用户安全退出
	function logout(){
		session(null);
		$this->redirect('login');
	}

	//用户注册
	function register(){
		if(!empty($_POST)){
			$reg = new \Model\RegisterModel();	
			$shuju = $reg->create();
			if(!$shuju){
				$this->assign('errorInfo',$reg->getError());
				$this->display();
			}else{
				$verify = new \Think\Verify();
				$ver = $verify->check($_POST['verify']);
				if($ver){
					$z = $reg->add($_POST);
					if($z){
						$this->redirect('login',array(),1,"<script type='text/javascript'>alert('恭喜你，注册成功！')</script>");

					}else{
						echo "<script type='text/javascript'>alert('注册失败！')</script>";
						$this->display();
					}
				}else{
					$this->assign('ver_err','验证码输入错误!');
					$this->display();
				}
			}
		}else{
			$this->display();
		}
	}

	//无刷新验证所注册的用户名是否存在
	public function regAjax(){
		$reg_name = $_POST['reg_name'];
				
		$users = D('users');
		$z = $users->where("username='$reg_name'")->select();
		if($z){
			echo "1";   //用户已经存在
		}else{
			echo '0';   //用户名可以用
		}
		//file_put_contents("d:/mylog.log","ok".$reg_name.'--'."\r\n",FILE_APPEND);
	}

	//无刷新验证用户名是否正确
	public function userAjax(){
		$name = $_POST['name'];
				
		$users = D('users');
		$z = $users->where("username='$name'")->select();
		if($z){
			echo "1";   //用户名正确
		}else{
			echo '0';   //用户名错误
		}		
	}


	//验证码
	function verifyImg(){
		$config=array(
			'useImgBg'  =>  false,           // 使用背景图片 
			'fontSize'  =>  16,              // 验证码字体大小(px)
			'useCurve'  =>  false,           // 是否画混淆曲线
			'useNoise'  =>  true,            // 是否添加杂点	
			'imageH'    =>  40,              // 验证码图片高度
			'imageW'    =>  130,             // 验证码图片宽度
			'length'    =>  4,               // 验证码位数
			'fontttf'   =>  '4.ttf',         // 验证码字体，不设置随机获取
		);
		$veri=new \Think\Verify($config);    //2. 完全限定名称方式
		dump($veri->entry());
		
	}
		
	
}