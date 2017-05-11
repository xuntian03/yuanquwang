<?php
namespace Admin\Controller;
use Think\Controller;
header("Content-type:text/html;charset=utf-8");
header("Cache-Control:no cache");

class EmptyController extends Controller{

	public function _empty(){
		echo "你是怎么找到我的？";
	
	}


}