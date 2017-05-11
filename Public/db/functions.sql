<!-- 创建一个函数，名字rand_string,可以随机返回我指定的个数字符串 -->

create function rand_string(n INT)
returns varchar(255) #该函数会返回一个字符串
begin
#定义了一个变量 chars_str，类型 varchar(100)
#默认给 chars_str 初始值 ''
declare chars_str varchar(100) default
'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
declare return_str varchar(255) default '';
declare i int default 0;
while i<n do 
#concat 函数：连接函数mysql函数
set return_str = concat(return_str,substring(chars_str,floor(1+rand()*62),1));
set i = i+1;
end while;
return return_str;
end $$

#使用方法：select rand_string(4)$$

create function rand_string(n INT)
returns varchar(255)
begin
declare chars_str varchar(100) default
'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
declare return_str varchar(255) default '';
declare i int default 0;
while i<n do 
set return_str = concat(return_str,substring(chars_str,floor(1+rand()*62),1));
set i = i+1;
end while;
return return_str;
end $$

<!-- 定义一个函数，返回一个随机的数字 -->
create function rand_num()
returns int(5)
begin
declare i int default 0;
set i = floor(rand()*1000);
return i;
end $$

<!-- 创建一个函数，名字rand_cons,可以随机返回我指定的个数字符串 -->
create function rand_cons(n INT)
returns varchar(255)
begin
declare chars_str varchar(100) default
'的一了是我不在人们有来他这上着个地到大里说去子，。得也和那要下看天时过出小么起你都把好还多没为又可家学天气以主会样年想能生同老中从自面前头到它后星期天六一二三四五周';
declare return_str varchar(255) default '';
declare i int default 0;
while i<n do 
set return_str = concat(return_str,substring(chars_str,floor(1+rand()*80),1));
set i = i+1;
end while;
return return_str;
end $$


<!-- 定义存储过程 -->
#随机添加雇员 max_num 条，雇员的编号从 start
#start 是雇员的开始编号，max_num 准备添加多少雇员
create procedure insert_emp(in start int(10),in max_num int(10))
begin
declare i int default 0;
#set autocommit=0 含义：不要自动提交
set autocommit = 0;
repeat
set i = i+1;
insert into emp values((start+i),rand_string(6),'','',rand_num());
until i = max_num
end repeat;
#commit 整体提交所有sql语句，提高效率
commit;
end $$

#使用：call insert_emp(1000,100000);
#删除存储过程：drop procedure procedurename;

<!-- 批量添加用户到 users 表 --> 
create procedure insert_users6(in start int(10),in max_num int(10))
begin
declare i int default 0;
set autocommit = 0;
repeat
set i = i+1;
insert ignore into users(id,username,gender,birth,college,password,grade,home,jifen) 
values((start+i),rand_string(4),'女','1997','对外经贸大学','123123','大四','四川',rand_num());
until i = max_num
end repeat;
commit;
end $$

#1、insert_users1 添加2万用户 
values((start+i),rand_string(5),'男','1994','北京交通大学','123123','研二','广东',rand_num());
#2、insert_users2 添加2万用户
values((start+i),rand_string(5),'女','1993','中央财经大学','123123','研三','湖南',rand_num());
#3、insert_users3 添加2万用户
values((start+i),rand_string(4),'女','1990','北京师范大学','123123','工作','浙江',rand_num());
#4、insert_users4 添加2万用户
values((start+i),rand_string(4),'男','1989','北京理工大学','123123','工作','安徽',rand_num());
#5、insert_users5 添加2万用户
values((start+i),rand_string(5),'男','1998','北京科技大学','123123','大三','河北',rand_num());
#6、insert_users6 添加2万用户
values((start+i),rand_string(4),'女','1997','对外经贸大学','123123','大四','四川',rand_num());

<!-- 解决 mysql 1418 错误 -->
set global log_bin_trust_function_creators=1;

<!-- 批量添加活动到 lists 表 -->
create procedure insert_lists7(in start int(10),in max_num int(10))
begin
declare i int default 0;
set autocommit = 0;
repeat
set i = i+1;
insert into lists(id,founder,title,content,riqi,dianzan,shijian,cate) 
values((start+i),'a3',rand_cons(7),rand_cons(76),'4月25日 星期二',rand_num(),now(),'other');
until i = max_num
end repeat;
commit;
end $$

#1、insert_lists1 添加100个trip活动 
values((start+i),'zs',rand_cons(6),rand_cons(76),'4月15日 星期六',rand_num(),now(),'trip','北京交通大学');
#2、insert_lists2 添加100个food活动 
values((start+i),'ls',rand_cons(7),rand_cons(76),'4月1日 晚上',rand_num(),now(),'food','中央财经大学');
#3、insert_lists3 添加100个movie活动
values((start+i),'ss',rand_cons(5),rand_cons(76),'4月15日 下午',rand_num(),now(),'movie','北京理工大学');
#4、insert_lists4 添加100个house活动
values((start+i),'ee',rand_cons(8),rand_cons(76),'4月12日-30日',rand_num(),now(),'house','北京科技大学');
#5、insert_lists5 添加100个study活动
values((start+i),'ss',rand_cons(7),rand_cons(76),'4月12日-9月30日',rand_num(),now(),'study','北京师范大学');
#6、insert_lists6 添加50个other活动
values((start+i),'a2',rand_cons(7),rand_cons(76),'4月23日 星期日',rand_num(),now(),'other','对外经贸大学');
#7、insert_lists7 添加50个other活动