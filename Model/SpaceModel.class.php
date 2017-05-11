<?php
namespace Model;
use Think\Model;

class SpaceModel extends Model{
	protected $tableName="lists";
	//隐藏文字的函数
	function hideText($user){
		$con_arr = array();
		$lists = $this->where("founder='$user'")->select();
		foreach($lists as $arr){
			$str0 = $arr['content'];
			$str1 = substr($str0,0,6);
			$str2 = $str1."...";
			$con_arr[] = $str2;
		}
		return $con_arr;		
	}
}