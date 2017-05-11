<?php
namespace Model;
use Think\Model;

class LoginModel extends Model{
	protected $tableName="users";

	function check($iuser,$ipwd){
		$info=$this->where("username='$iuser'")->find();
		if($info){
			if($info['password']===$ipwd){
				return $info;
			}
			return null;
		}else{
			return null;
		}
	}

}