<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type:text/html;charset=utf-8");
header("Cache-Control:no cache");
class IndexController extends Controller {

	//游客浏览页面
    public function index(){
		//展示热门的活动，前五名
		$lists = D('lists');
		$info1 = $lists->order('dianzan desc')->limit(1)->select();
		$this->assign('info1',$info1);
		$info2 = $lists->order('dianzan desc')->limit(1,3)->select();
		$this->assign('info2',$info2);		
		$info3 = $lists->order('dianzan desc')->limit(4,8)->select();
		$this->assign('info3',$info3);
		
		//仅显示“结伴出游”的页数，其它不做分页
		$Fenye = new \Model\IndexModel();	
		$trips = $Fenye->getInfo("trip");
		$trip_info = $trips[0];
		$trip_page = $trips[1];
		
		//展示每个活动选项卡里的内容
		$coll = $_GET['coll'];
		if(empty($coll) or $coll=="所有大学"){
			$cons = $_GET['cons'];
			if(empty($cons)){
				$this->assign('trip_info',$trip_info);			//显示每页内容
				$this->assign('trip_page',$trip_page);			//显示分页栏
				$food=$lists->order('shijian desc')->where("cate='food'")->select();
				$this->assign('food',$food);
				$movie=$lists->order('shijian desc')->where("cate='movie'")->select();
				$this->assign('movie',$movie);
				$house=$lists->order('shijian desc')->where("cate='house'")->select();
				$this->assign('house',$house);
				$study=$lists->order('shijian desc')->where("cate='study'")->select();
				$this->assign('study',$study);	
				$other=$lists->order('shijian desc')->where("cate='other'")->select();
				$this->assign('other',$other);			
			}else{
				//如果搜索框有值传过来
				$trip = $lists->where("cate='trip' and title like '%$cons%'")->select();
				$this->assign('trip_info',$trip);
				$food=$lists->where("cate='food' and title like '%$cons%'")->select();
				$this->assign('food',$food);
				$movie=$lists->where("cate='movie' and title like '%$cons%'")->select();
				$this->assign('movie',$movie);
				$house=$lists->where("cate='house' and title like '%$cons%'")->select();
				$this->assign('house',$house);
				$study=$lists->where("cate='study' and title like '%$cons%'")->select();
				$this->assign('study',$study);	
				$other=$lists->where("cate='other' and title like '%$cons%'")->select();
				$this->assign('other',$other);	
			}
		}else{
			$trip=$lists->where("cate='trip' and region='$coll'")->select();
			$this->assign('trip_info',$trip);
			$food=$lists->where("cate='food' and region='$coll'")->select();
			$this->assign('food',$food);
			$movie=$lists->where("cate='movie' and region='$coll'")->select();
			$this->assign('movie',$movie);
			$house=$lists->where("cate='house' and region='$coll'")->select();
			$this->assign('house',$house);
			$study=$lists->where("cate='study' and region='$coll'")->select();
			$this->assign('study',$study);	
			$other=$lists->where("cate='other' and region='$coll'")->select();
			$this->assign('other',$other);		
		} 
		
		//计算全网排名
		$users = D('users');
		$paixu_a1 = $users->order("jifen desc")->limit(3)->select();
		$this->assign('paixu_a1',$paixu_a1);
		$paixu_a2 = $users->order("jifen desc")->limit(3,7)->select();
		$this->assign('paixu_a2',$paixu_a2);

		$this->display(); 		
    }

	//用户登录后的主界面
	public function main(){
		//echo "<br><br>---<br>";

		//判断是否非法登录
		if(checkUserValidate()=='illegal'){
			$this->redirect('User/login');
		}
		
		//匹配出cookie里边的活动id
		$content = $_COOKIE['id'];
		$reg = '/\"(\d+)\"/';
		preg_match_all($reg,$content,$matches);
		//取出每个活动id对应的标题
		$lists = D('lists');
		foreach($matches[1] as $v){
			$scan_id = $lists->where("id='$v'")->select();	
			$arr[] = $scan_id[0];
		}
		$this->assign('scan_id',$arr);

		//展示热门的活动，前五名
		$lists = D('lists');
		$info1 = $lists->order('dianzan desc')->limit(1)->select();
		$this->assign('info1',$info1);
		$info2 = $lists->order('dianzan desc')->limit(1,3)->select();
		$this->assign('info2',$info2);		
		$info3 = $lists->order('dianzan desc')->limit(4,4)->select();
		$this->assign('info3',$info3);
		
		//仅显示“结伴出游”的页数，其它不做分页
		$Fenye = new \Model\IndexModel();	
		$trips = $Fenye->getInfo("trip");
		$trip_info = $trips[0];
		$trip_page = $trips[1];
		
		//展示每个活动选项卡里的内容
		$coll = $_GET['coll'];
		if(empty($coll) or $coll=="所有大学"){
			$cons = $_GET['cons'];
			if(empty($cons)){
				$this->assign('trip_info',$trip_info);			//显示每页内容
				$this->assign('trip_page',$trip_page);			//显示分页栏
				$food=$lists->order('shijian desc')->where("cate='food'")->select();
				$this->assign('food',$food);
				$movie=$lists->order('shijian desc')->where("cate='movie'")->select();
				$this->assign('movie',$movie);
				$house=$lists->order('shijian desc')->where("cate='house'")->select();
				$this->assign('house',$house);
				$study=$lists->order('shijian desc')->where("cate='study'")->select();
				$this->assign('study',$study);	
				$other=$lists->order('shijian desc')->where("cate='other'")->select();
				$this->assign('other',$other);			
			}else{
				//如果搜索框有值传过来
				$trip = $lists->where("cate='trip' and title like '%$cons%'")->select();
				$this->assign('trip_info',$trip);
				$food=$lists->where("cate='food' and title like '%$cons%'")->select();
				$this->assign('food',$food);
				$movie=$lists->where("cate='movie' and title like '%$cons%'")->select();
				$this->assign('movie',$movie);
				$house=$lists->where("cate='house' and title like '%$cons%'")->select();
				$this->assign('house',$house);
				$study=$lists->where("cate='study' and title like '%$cons%'")->select();
				$this->assign('study',$study);	
				$other=$lists->where("cate='other' and title like '%$cons%'")->select();
				$this->assign('other',$other);	
			}
		}else{
			$trip=$lists->where("cate='trip' and region='$coll'")->select();
			$this->assign('trip_info',$trip);
			$food=$lists->where("cate='food' and region='$coll'")->select();
			$this->assign('food',$food);
			$movie=$lists->where("cate='movie' and region='$coll'")->select();
			$this->assign('movie',$movie);
			$house=$lists->where("cate='house' and region='$coll'")->select();
			$this->assign('house',$house);
			$study=$lists->where("cate='study' and region='$coll'")->select();
			$this->assign('study',$study);	
			$other=$lists->where("cate='other' and region='$coll'")->select();
			$this->assign('other',$other);		
		} 

		//获取messages表的留言数量，1:1转换成积分
		$user = $_SESSION['username'];
		$mess = D('messages');
		$shuju1 = $mess->where("mes_user='$user'")->select();
		$jifen1 = count($shuju1);

		//获取spa_mess表的留言数量，1:2转换成积分
		$spa_mess = D('spa_mess');
		$shuju2 = $spa_mess->where("spa_sender='$user'")->select();
		$jifen2 = count($shuju2)*2;

		//获取lists表的发起活动数量，1:10转换成积分
		$lists = D('lists');
		$shuju3 = $lists->where("founder='$user'")->select();
		$jifen3 = count($shuju3)*10;

		//将积分存入users表，并显示积分	
		$users = D('users');		
		$jifen = $jifen1+$jifen2+$jifen3;
		$_POST['jifen'] = $jifen;
		$users->where("username='$user'")->field('jifen')->save($_POST);
		$goals = $users->where("username='$user'")->select();
		$this->assign('goals',$goals);

/*		//计算个人排名，如果排名在一百则显示排名，否则显示“暂无排名”
		$paixu_p = $users->order("jifen desc")->limit(100)->select();
		for($i=0;$i<count($paixu_p);$i++){
			if($paixu_p[$i]['username']==$user){
				$mingci = $i+1;
			}
		}
		if(!$mingci){
			$mingci = "暂无排名";
		}
*/
		//计算个人排名
		$paixu_p = $users->where("username='$user'")->field('jifen')->select();
		$jifen_p = $paixu_p[0]['jifen'];
		$mingci = $users->where("jifen>'$jifen_p'")->count(1)+1;
		$this->assign('mingci',$mingci);
		
		//计算全网排名
		$paixu_a1 = $users->order("jifen desc")->limit(3)->select();
		$this->assign('paixu_a1',$paixu_a1);
		$paixu_a2 = $users->order("jifen desc")->limit(3,7)->select();
		$this->assign('paixu_a2',$paixu_a2);

		//显示消息提示
		$friends = D('friends');
		$show = $friends->where("fri_user='$user' and fri_cate=0")->select();
		$show_num = count($show);
		if($show_num!=0){
			$this->assign('show_num',$show_num);			
		}

		$this->display(); 
	}

	//点赞增加
	public function getAjax(){		
		$lists = D('lists');
		$actives = D('actives');
		$panduan = $_SESSION['username'];
		$id=$_POST['id'];
		$res = $actives->where("ac_cate='$id' and ac_user='$panduan'")->select();
		//点赞判断，如果点过赞则不能再点
		if($res){
			$dianzan=$_POST['dianzan'];
			echo $dianzan;
		}else{
			$dianzan=$_POST['dianzan'];
			$dianzan=$dianzan+1;
			$_POST['dianzan']=$dianzan;
			$id=$_POST['id'];
			$lists->where("id='$id'")->field('dianzan')->save($_POST);
			echo $dianzan;
			//file_put_contents("d:/mylog.log","ok".$dianzan.'--'.$id."\r\n",FILE_APPEND);
			
			//新增数据到数据表 actives			
			$_POST['ac_user']=$_SESSION['username'];
			$_POST['ac_cate']=$id;
			$_POST['ac_time']=Date('Y-m-d H:i');
			$shuju = $actives->create();
			$z = $actives->add($shuju);
		}
	}

	//发起活动界面
	public function play(){
		//判断是否非法登录
		if(checkUserValidate()=='illegal'){
			$this->redirect('User/login');
		}

		if(!empty($_POST)){
			$_POST['founder'] = $_SESSION['username'];
			$_POST['shijian'] = Date('Y-m-d H:i');
			$temp_u = $_SESSION['username'];
			$temp_t = Date('Y-m-d H:i'); 
			$lists = D('lists');
			$shuju = $lists->create();
			$z = $lists->Add($shuju);
			if($z){
				$get_id = $lists->where("shijian='$temp_t' and founder='$temp_u'")->select();
				foreach($get_id as $v){
					$new_id=$v['id'];
				}
				//echo $new_id;
				$this->redirect('Content/content?id='.$new_id);
			}
		}else{
			$this->display();
		}
		
	}


}