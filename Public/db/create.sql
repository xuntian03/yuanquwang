create database yiqi charset=utf8;

<!-- 活动项目表 lists -->
create table lists(
  id int primary key auto_increment,
  founder varchar(8) not null,
  title varchar(32) not null,
  content varchar(65535) not null,
  riqi varchar(16),
  dianzan int not null default '0',
  shijian datetime not null,
  cate varchar(8) not null,
  region varchar(16) default 'all_coll' not null
);
insert into lists values(1,'admin','天安门一日游','由于活动场地和时间有限，鉴于目前报名人数已超过预期，所以将提前一天截止报名，即活动报名截止到3月17日晚24点。如有对同学们带来不便，我们深表歉意。','3月3日 星期五',0,now(),'trip');
insert into lists values(2,'admin','八达岭长城','这是一项伟大的工程','3月5日 星期日',0,now(),'trip');
insert into lists(id,founder,title,content,riqi,dianzan,shijian,cate,region) 
		values(null,'ls','呷哺呷哺','一起去吃呷哺','4月11日 星期六',0,now(),'food','北京交通大学');
#更改default的值
alter table lists alter column region drop default;
alter table lists alter column region set default '所有大学';

ALTER TABLE users ADD UNIQUE KEY(username);
alter table student drop constraint 约束名;
ALTER TABLE users ADD PRIMARY KEY(id);
alter table users add index index_jifen(jifen);
alter table users drop index index_jifen;


<!-- 用户信息表 users -->
create table users(
  id int primary key auto_increment,
  username varchar(16) not null,
  gender varchar(4) not null,
  birth varchar(32) not null,
  college varchar(32) not null,
  password varchar(32) not null,
  grade varchar(8) not null,
  home varchar(8) not null,
  favicon varchar(64) default 'Public/img/default-icon.jpg' not null,
  jifen int(8) not null default '0' 
);
insert into users values(null,'zss','男','1990','北京交通大学','123','学生','福建',null,null);
insert into users(id,username,gender,birth,college,password,grade,home) 
		values(null,'ls','女','1992','中国人民大学','123','大三','浙江');

<!-- 附件上传表 saoma -->
CREATE TABLE saoma(
  sao_id int not null primary key auto_increment,
  sao_user varchar(16) not null,
  sao_dir varchar(128) not null,
  sao_cate int unique not null	
);
insert into saoma values('1','zs','Public/uploads/saoma/','trip1');

<!-- 我的活动表 actives -->
CREATE TABLE actives(
  ac_id int not null primary key auto_increment,
  ac_user varchar(16) not null,
  ac_time datetime not null,
  ac_cate int not null
);

<!-- 留言信息表 messages -->
CREATE TABLE messages(
  mes_id int not null primary key auto_increment,
  mes_user varchar(16) not null,
  mes_time datetime not null,
  mes_cons varchar(256) not null,
  mes_cate int not null
);

<!-- 空间留言表 spa_mess -->
CREATE TABLE spa_mess(
  spa_id int not null primary key auto_increment,
  spa_sender varchar(16) not null,
  spa_getter varchar(16) not null,
  spa_time datetime not null,
  spa_cons varchar(256) not null
);

<!-- 选择大学表 sel_coll -->
CREATE TABLE sel_coll(
  sel_id int not null primary key auto_increment,
  sel_name varchar(16) not null
);
insert into sel_coll values(1,'all_coll');

<!-- 添加好友表 friends -->
CREATE TABLE friends(
  fri_id int not null primary key auto_increment,
  fri_post varchar(16) not null,
  fri_user varchar(16) not null,
  fri_cate tinyint not null,
  fri_state varchar(16) default '加为好友' not null
);
insert into friends values(null,'ss','ls',0,'等待同意');
insert into friends values(null,'zs','ls',0,'等待同意');
insert into friends values(null,'ww','ls',0,'等待同意');

<!-- 学校热点表 hot_coll -->
CREATE TABLE hot_coll(
  hot_id int not null primary key auto_increment,
  hot_title varchar(32) not null,
  hot_cons varchar(65536) not null,
  hot_cate varchar(16) not null
);
insert into hot_coll values(null,'【交大智慧】中国交建•中国路桥携手','aa','bb');

<!-- 学校招聘表 work_coll -->
CREATE TABLE work_coll(
  work_id int not null primary key auto_increment,
  work_title varchar(32) not null,
  work_sch varchar(16) not null,
  work_adr varchar(32) not null,
  work_time varchar(32) not null,
  work_cons varchar(65536) not null
);
CREATE TABLE work_coll(
  work_id int not null primary key auto_increment,
  work_title varchar(32) not null,
  work_cons varchar(65536) not null,
  work_time datetime not null
);

<!-- 社会热点新闻 soci_coll -->
CREATE TABLE soci_coll(
  soci_id int not null primary key auto_increment,
  soci_title varchar(32) not null,
  soci_cons varchar(65536) not null,
  soci_time datetime not null
);

<!-- 管理员用户表 admin_user -->
CREATE TABLE admin_user(
  admin_id int not null primary key auto_increment,
  admin_name varchar(16) not null,
  admin_pwd varchar(16) not null
);
insert into admin_user values(null,'admin','123123');
