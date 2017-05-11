<?php
namespace Model;
use Think\Model;

class AdminLoginModel extends Model{
	protected $tableName="admin_user";

	function check($iuser,$ipwd){
		$info=$this->where("admin_name='$iuser'")->find();
		if($info){
			if($info['admin_pwd']===$ipwd){
				return $info;
			}
			return null;
		}else{
			return null;
		}
	}

}