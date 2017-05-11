<?php
namespace Admin\Controller;
use Think\Controller;
header("Content-type:text/html;charset=utf-8");
header("Cache-Control:no cache");

class ManageController extends Controller{

	public function manage(){
		//echo "<br><br><br>---<br>";
		//判断是否非法登录
		if(checkAdminValidate()=='illegal'){
			$this->redirect('Index/index');
		}

		//判断上次是否登录，显示最后一次登录时间
		if(!isset($_COOKIE['last_time'])){
			cookie('last_time',date('Y-m-d H:i:s'));
			$this->assign('time','你是第一次登录');
		}else{
			$this->assign('time',cookie(last_time));
			cookie('last_time',null);
			cookie('last_time',date('Y-m-d H:i:s'),3600*24*14);
		}
		$this->display();
	}

	public function test(){
		$mes_user = $_POST['mes_user'];
		echo $this->ajaxReturn($mes_user);
		echo $mes_user;
		file_put_contents("d:/mylog.log","ok".$mes_user.'--'."\r\n",FILE_APPEND);
	}

}