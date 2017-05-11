<?php
namespace Admin\Controller;
use Think\Controller;
header("Content-type:text/html;charset=utf-8");
header("Cache-Control:no cache");

class IndexController extends Controller{
	//管理员登录
	public function index(){
		if(empty($_POST)){
			$this->display();
		}else{
			$verify = new \Think\Verify();
			$z = $verify->check($_POST['verify']);
			if($z){
				$name = I('post.name');
				$pwd = I('post.pwd');		
				$login = new \Model\AdminLoginModel();
				$info = $login->check($name,$pwd);
				if($info){
					session('admin_name',$info['admin_name']);
					$this->redirect('Manage/manage');				
				}else{
					echo "<script type='text/javascript'>alert('密码输入错误！')</script>";
					$this->display();				
				}			
			}else{
				$this->assign('ver_err','验证码错误');
				$this->display();
			}
		}		
	}

	//管理员退出
	public function logout(){

		session(null);
		$this->redirect('index');	
	}


	//无刷新验证管理员账号是否存在
	public function userAjax(){
		$name = $_POST['name'];
				
		$admin_user = D('admin_user');
		$z = $admin_user->where("admin_name='$name'")->select();
		if($z){
			echo "1";   //用户名正确
		}else{
			echo '0';   //用户名错误
		}
		
		//echo '{"res":"aa","info":"bb"}';
		//file_put_contents("d:/mylog.log","ok".$name.'--'."\r\n",FILE_APPEND);
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