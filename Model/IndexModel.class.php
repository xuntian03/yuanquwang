<?php
namespace Model;
use Think\Model;

class IndexModel extends Model{
	protected $tableName="lists";

	//获取分页内容和分页栏
	function getInfo($cate){
		$total_rows = $this->where("cate='$cate'")->count();			//总行数	
		$page = new \Think\MyPage($total_rows,10);						//实例化分页类
		$page_info = $this->where("cate='$cate'")
			->order('shijian desc')->limit($page->firstRow.','.$page->listRows)->select(); 
		$show_page = $page->show();
		//return $page_info;
		$arr[] = $page_info;
		$arr[] = $show_page;
		return $arr;
	}

}