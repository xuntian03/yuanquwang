<?php
namespace Admin\Controller;
use Think\Controller;
header("Content-type:text/html;charset=utf-8");
header("Cache-Control:no cache");

class SaomaManController extends Controller{

	//显示二维码管理
	public function saomaShow(){

		//分页显示
		$total_rows = M()->table('saoma as s')->join('lists as l on s.sao_cate=l.id')
				->order('shijian desc')->count();												
		$page = new \Think\MyPage($total_rows,3);
		$page_info = M()->table('saoma as s')->join('lists as l on s.sao_cate=l.id')
				->order('shijian desc')->limit($page->firstRow.','.$page->listRows)->select();   
		$page_show = $page->show();													
		$this->assign('saoma',$page_info); 
		$this->assign('page_show',$page_show);

		//显示select所有不相同的二维码上传者
		$saoma = D('saoma');
		$sao_user = $saoma->distinct(true)->field('sao_user')->select();
		$this->assign('sao_user',$sao_user);
		$this->display();
	}

	//删除活动留言
	public function saomaDele(){
		$id = I("get.id");
		$saoma = D('saoma');
		$shuju = $saoma->where("sao_id='$id'")->field('sao_user')->select();
		$sao_user = $shuju[0]['sao_user'];
		$saoma->where("sao_id='$id'")->delete();
		$this->redirect('saomaEdit',array('sao_user'=>$sao_user),0.1,"<script>alert('删除成功！')</script>");
	}

	//显示二维码编辑界面
	public function saomaEdit(){
		$sao_user = I('get.sao_user');
		//显示二维码管理
		$saoma = M()->table('saoma as s')->join('lists as l on s.sao_cate=l.id')
				->where("sao_user='$sao_user'")->order('shijian desc')->select();
		$this->assign('saoma',$saoma);
		//显示select所有不相同的二维码上传者
		$saoma = D('saoma');
		$sao_user = $saoma->distinct(true)->field('sao_user')->select();
		$this->assign('sao_user',$sao_user);
		
		$this->display();	
	}
}