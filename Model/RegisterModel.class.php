<?php
namespace Model;
use Think\Model;

class RegisterModel extends Model{
	protected $tableName="users";

	protected $patchValidate=true;

	//自动验证定义
	protected $_validate=array(
		//array(字段，验证规则，错误提示[，验证条件，附加规则，验证时间]),
		array('username','require','用户名不能为空'),
		array('username','','该用户名已存在！',1,'unique'),

		array('gender','require','性别不能为空'),

		array('birth','require','出生年份不能为空'),
		array('college','require','学校不能为空'),

		array('password','require','密码不能为空'),
		array('password','check_pwd','密码必须大于等于6位',1,'callback'),

		array('repwd','require','确认密码不能为空'),
		array('repwd','password','两次密码不一致',0,'confirm'),

		array('verify','require','验证码不能为空'),

	);
	function check_pwd(){
		$password=$_POST['password'];
		if(strlen($password)>=6){
			return true;
		}else{
			return false;
		}
	}

}
