<?php
class SqlHelper{
	public $dbname="yiqi";
	public $host="localhost";
	public $name="root";
	public $pwd="";
	public $conn;

	function __construct(){
		$this->conn=mysql_connect($this->host,$this->name,$this->pwd);
		if(!$this->conn){
			die("连接失败".mysql_error());
		}else{
		//	echo "链接成功<br />";
		}
		mysql_select_db($this->dbname,$this->conn);
		mysql_query("set names utf8");
	}
	function execute_dml($sql){
		$bool=mysql_query($sql) or die("增删改失败".mysql_error());
		if(!$bool){
			echo "执行失败";
			return "0";
		}elseif(mysql_affected_rows()==0){
			echo "没有影响到行";
			return "1";
		}else{
			echo "执行成功<br />";
			return "2";
		}
	}
	function execute_dql($sql){
		$res=mysql_query($sql,$this->conn) or die("查询失败".mysql_error());
		return $res;
	}
	function execute_dql2($sql){
		$res=mysql_query($sql,$this->conn) or die("查询失败".mysql_error());
		while($row=mysql_fetch_assoc($res)){
			$arr[]=$row;
		}
		mysql_free_result($res);
		return $arr;
	}
}
?>
