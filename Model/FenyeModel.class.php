<?php
namespace Model;
use Think\Model;

class FenyeModel extends Model{
	
	//获取分页内容和分页栏
	function getPage($list_rows){
		
		$total_rows = $table_name->count();			//总行数	
		$page = new \Think\MyPage($total_rows,$list_rows);						//实例化分页类
		$page_info = $table_name->limit($page->firstRow.','.$page->listRows)->select(); 
		$show_page = $page->show();
		
		$arr[] = $page_info;
		$arr[] = $show_page;
		return $arr;
	}

}