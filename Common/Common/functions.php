 <?php
//function.php 会和验证码冲突

//验证非法登录管理员
function checkAdminValidate(){
	if(!$_SESSION['admin_name']){
		return 'illegal';
	}
}

//验证非法登录用户
function checkUserValidate(){
	if(!$_SESSION['username']){
		return 'illegal';
	}
}