第14天
1.数据库组成：
	库服务器 -> 库 -> 表 -> 字段 -> 数据行

2.关系型数据库和非关系型数据库
	关系型：(MySQL)
		Oracle：商品化关系型数据库
		SqlSever：
		DB2：（金融系统中运用最突出的数据库，医院，旅游等常用）
	非关系型：(NoSQL)
		SQLite
		redis：本质为key-value类型的内存数据库
		mongodb：满足海量存储需求和访问的面向文档的数据库
	二者区别:
		1.非关系型数据库依靠减少部分关系型数据库的功能来提高产品性能；
		2.非关系型数据库都是免费的，比较有名气的关系型数据库收费(Ocace,DB2)；
		3.关系型数据库优势
			a.方便于一个表内或多个表之间做复杂的数据查询。
			b.由于事物支持可以实现对安全性能很高的数据进行访问。
		4.非关系型数据库优势
			a.也是键值对应，但不需要SQL层解析，性能高。
			b.数据之间没有耦合性，容易水平扩展。
		
3.SQL分类(关键字最好大写)
	1.DDL：数据(库模式)定义语言
		create创建 	DROP删除 	ALTER修改 
	2.DML：数据(表)操作语言
		INSERT插入 	UPDATE修改 	DELETE删除
	3.DQL：数据查询语言
		SELECT查询
	4.DCL：数据控制语言
		GRANT赋权限 	REVOKE移除权限
	5.DTL：数据事务语言
		BEGIN开始 	COMMIT提交 	ROLLBACK回滚

4.数据库连接
	1.找到mysql的安装目录下的bin，复制整个路径
	2.我的电脑->属性->高级系统设置->环境变量->path->加分号后粘贴路径
	3.保存(关闭)，cmd再次进入;
		另：win10系统下双击path->新建->粘贴

5.进入数据库的方式(留意没有分号)
	1.mysql -uroot -p （回车输密码） 
	2.mysql -uroot -p密码
	3.mysql -h主机地址 -uroot -p密码

	另改密码：
		localhost->phpmyadmin->用户root,密码无->主页(左侧小房子进入)->修改密码->输入密码->切记不要点击生成->执行

<!--dos命令继续加-->
6.简单的dos命令(不是数据库内的)
	cls 清屏
	cd 进入某个文件夹

7.字符集
	0.常见字符集：
		gbk，gbk312，utf8，latin1

	1.创建表时指定字符集：create table 表名(字段 类型...) default charset=utf8;
		<!-- create table user(name varchar(20), sex tinyint(1)) default charset=utf8 -->

	2.在my.ini内设字符集：
		1.找到my.bin文件
			wamp64->bin->mysqli->mysqli5.9->my.ini(和小绿中的一样)
		2.在[client]中添加default_character_set=utf8，
			<!-- 改变character_set_database的默认值latin1 -->
		3.在[wampmysqld64]中添加character_set_server=utf8，
			<!-- 改变character_set_server的默认值latin1-->

查看部分配置变量的值(模糊查询)：
	show variables like 'character_set_%';

8.引擎：
	1.查看当前支持的引擎：show engines;

	2.创建表时指定引擎：create table 表名(字段 类型...) engine=引擎名;
		<!-- create table user(name varchar(20), sex tinyint(1)) engine=InnoDB; -->

	3. my.ini内可统一设置引擎：default-storage-engine=InnoDB

	<!--加引擎对比-->		
	4.常用引擎对比：
		MyISAM：支持表锁	支持全文索引	读的速度快	不支持外键	不支持事务
		InnoDB：支持行锁	不支持全文索引	写的速度快	支持外键	支持事务

		Archive:归档引擎，压缩比高达1:10，用于数据归档
		<!--名词解释
		 	行锁：写入、更新时将一行锁起来，不让他人操作
		 	表锁：写入、更新时将表锁起来，不让他人操作
		 	事务：同时操作多个数据，若其中一个失败可回滚到之前-->



第15天
9.数据库命令
	\h 查看帮助
	\c 结束当前命令
	\g 执行，相当于分号
	quit 退出，不关闭界面
	exit 退出，关闭界面

10.DDL
 ⑴库：
	查看库：show databases;
		<!-- show database; -->

	创建库：create database 库名;
		<!-- screate database php1714; -->

	使用库：use 库名;
		<!-- use php1714; -->

	删除库：drop database 库名;
		<!-- drop database php1714; -->

 ⑵表：
	查看表：show tables;
		<!-- show tables; -->

	创建表：create table 表名(字段1 类型, 字段2 类型, ...);
		<!-- create table user(name varchar(45), password char(32), sex tinyint(1)); -->

	查看建表(结构)：show create 表名;
		<!-- show create user; -->

	删除表：drop table 表名;
		<!-- drop table user; -->

	重命名表：alter table 原表名 rename 新表名;
		<!-- alter table user remane bbs_user; -->

	查看表字段：desc 表名;
		<!-- desc user -->

 ⑶增,删,改：<!--对于数据库中表和字段-->
	修改表字段名字；
		alter table 表名 change 原字段 新字段 新字段类型 [first|after];
			<!-- alter table user change name username varchar(50); -->

	修改表字段的类型：
		alter table 表名 modify 原字段 新类型 [first|after];
			<!-- alter table user modify name varchar(40); -->

	删除一个表字段：
		alter table 表名 drop 要删的字段名;
			<!-- alter table user drop sex; -->

	添加一个表字段：
		alter table 表名 add 新字段 新字段类型;
			<!-- alter table add regtime timestamp; -->

	在‘字段1’后插入一个字段：
		alter table 表名 add 新字段 新字段类型 after 字段1名;
			<!-- alter table user add province char(20) after name; -->

	在表中第一位置插入字段：
		alter table 表名 add 新字段 新字段类型 first;
			<!-- alter table user add id int(11) first; -->

11.数据类型:
	char()：	0~255字节	定长,空余用空格自动补,超出被截断,查询速度快；
	varchar()：0~655355字节	不定长；空余不管

	tinyint()：	1字节	取值-128~127；
	int()：		4字节	取值-2^31~（(2^31)-1）；

	datetime：	8字节	日期时间(插入记录时写为字符串)，样式:2017-01-05 22:02:02; 
	timestamp：	4字节	当默认值为current_timestamp可以自动存储记录修改的时间
		<!-- alter table user add create_time timestamp default current_timestamp;  -->

	float(m,d)：4字节	单精度浮点,m总位数(不含小数点),d小数位 double为双精度
	decimal(m,d)：	储存为字符串的浮点数，使用于金额,钱等数据
		
	text：0~65535字节	长文本数据,不区分大小写,有字符集,用于存储文本或图像块
	blob：0~65535字节 长文本数据,区分大小写,无字符集,用于存储文本或图像块

	set：集合类型，集合中任意取多个set('num1','num2'....)
	enum：枚举类型，集合中取一个enum('num1','num2'....)

	unsigned：无符号型；

	default：设置默认值；

	auto_increment：自动增加，为整型，默认为从1开始，
		常用于：auto_increment, add primary key(id) ;

12.索引
	0.查看全部索引
		show index from 表名;
			<!-- show index from user; -->

	1.普通索引index（基本索引，无限制）
		alter table 表名 add index(字段);
			<!-- alter table user add index(age); -->

	2.唯一索引unique（所在字段具有唯一性，不能重复）
		alter table 表名 add unique(字段);
			<!-- alter table user add unique(name); -->

	3.主键索引primary key（特殊的唯一索引，不允许有空值）
		alter table 表名 add primary key(字段);
			<!-- alter table user add primary key(id); -->

	4.全文索引fulltext（用于全局搜索）<!-- 基本不用 -->
	 <!-- ????加不上???? alter table 表名 add fulltext(字段); -->

	5.删除索引
		alter table 表名 drop index 字段;
			<!-- alter table user drop index name;  -->

13.创建一个表，带主键带自增带默认值&&
	create table user2(
		id int(11) unsigned zerofill auto_increment , 
		name varchar(45) not null,
		sex enum ('1','2','3'),
		time datetime,
		creat_time timestamp default current_timestamp,
		primary key(id),
		unique(name)
	 ) engine=Innodb default charset=utf8;

14.DML(增，删，改)
 1.插入数据：
	a、insert into 表名 values(值1,值2...值n);
		<!-- inserect into user value('张三',12,2); -->

	b、insert into 表名(字段1,字段2,...字段n) values(值1,值2,...值n),(值1,值2,...值n),...;
		<!-- inserect into user(name, age, sex, province) values
				('张三',20,1,'河北'),('李四',22,0,'河南'),('王五',18,1,'山西'); -->

	注：添加总数和顺序需要和建表时的字段一一对应；
		可以插入多条数据，若表中某字段有设置自增、存在默认值、允许为空的情况可以不传值(字段也就不用写)

 2.删除记录：
	一般做伪删除：表中建一字段辅助标记，查询时不显示；	
	
	真实删除delete<!--条件必加，否则全数据丢失-->
		delete from 表名 where 条件;
			<!-- delete from user where id=6; -->
			
 3.修改记录：
	a、update 表名 set 修改字段1=改值1, 修改字段2=改值2,... where 条件;
		<!-- update user set name='阿呆', age='18' where id=10; -->

	b、update 表名 set 字段=字段+-*/ where 条件;
		<!-- update ueser set price=price*1.5 where id=12; -->

	c、update 表1, 表2 set 表1.字段1=改值1, 表2.字段2=改值2 where 条件1 and 条件2;
	 <!-- 一定留意and
		例1：两个表各自修改各自的；
		 update user,goods set user.name='试试', goods.name='玩具' where user.id=1 and goods.gid=10;
		
		例2：注意条件2，表aa中修改的aa.gid为a表中原来的a.id=1的记录的gid值
		 update a, aa set a.gid=10, aa.province='秘密' where a.id=1 and a.gid=aa.gid;
	 -->

15.DQL
 0.当前当前表在哪个库下面
	select database();

 1.基础查询(所有)：<!--(效率低,工作中不建议使用)-->
	select * from 表名; 
		<!-- select * from user; -->

 2.查指定字段
	select 字段1, 字段2,.... from 表名;
		<!-- select id,name from user; -->

 3.指定字段去重
	select distinct(字段) from 表名;
		<!-- select distinct(province) from user; -->

 4.条件查询where
 	⑴关系：>,<=,!=, <> 等
 	 select * from 表名 where 字段=值;
		<!-- select * from user where name='阿呆'; -->

	⑵逻辑：and 和 or
	 <!-- 两个都满足才显示 -->
	 select * from 表名 where 条件1 and 条件2;
		<!-- select * from user where name='阿呆' and age='12'; -->

	 <!--or显示满足条件的一方,都满足显示两个-->
	 select * from 表名 where 条件1 or 条件2;
		<!-- select * from user where name='阿呆' or age='12'; -->

	⑶集合：in 和 not in
	 <!--in表示显示值在这里面的数据-->
	 select * from 表名 where 字段 in('值1','值2',...);
		<!-- select * from user where id in(2,5,10,15); -->

	 <!--not in 表示不显示值在这里面的数据-->
	 select * from 表名 where 字段 not in('值1','值2',...);
		<!-- select * from user where id not in(2,5,10); -->

 	⑷区间：between and
	 <!--大部分用于区间，注意where后还要跟要比较区间的字段-->
	 select * from 表名 where 字段 between 值1 and 值2;
		<!-- select * from user where id between 2 and 10; -->

 	⑸.模糊查询like
 	 <!--查找时_占一个字符,必须匹配；%表示可有可无；不写的话，表示以查找字开头或结尾-->
	 select * from 表名 where 字段 like'_字%';
		<!-- select * from user where name like '_海%'; -->

 5.排序order by ；desc
	select 字段1, 字段2,... from 表名 order by 排序字段1 desc, 排序字段2 asc, ....;
		<!-- select id,name,content from user order by istop asc, lasttime desc; -->

 6.分组group by；having
	select 字段1, 字段2,... from 表名 group by 分组字段1,分组字段2;
		<!-- select id,name from user group by sex,age; -->

	分组后的过滤having<!-- 一般放在最后面 -->
		select 字段... from 表名 group by 分组字段 having 条件;
		 <!-- select province from user group by province having count(province)>3; -->
 
 7.分页limit<!-- 偏移量不写默认为0，公式:(页数-1)*条数，条数-->
	select * from 表名 limit 偏移量,条数
		<!-- select * from user limit 0,5 -->

 8.别名as<!-- 别名在同一语句中可以用在排序分组等中,有些可以不写as -->
	select 字段 as 别名 from 表名;
		<!-- select province as pro from user;  -->

 9.其他
	sum()；  max()； min()； 平均数vag();	总数count()；
	 select sum(字段) from 表 where 条件;
	 	<!-- select max(price) from goods where gid=12; -->



第十六天
16.使用客户端建库和建表
	1.打开localhost->phpmyadmin->登录->新建->库名，字符集；
	2.打开Navicat->链接->写新的链接名->确定后双击链接名->鼠标右键新建；

17.DQL(多表联合查询):
 <!-- 注意：多表查询查所有字段,只写一个*，单独字段写：表名.字段，
	不然遇到同名字段报ambiguous(模棱俩可)的错误 -->
 1.内连接： 
 	隐式内连接：(常用)
	 select 表1.字段1,表1.字段2..., 表2.字段1,表2.字段2... from 表1, 表2 where 条件（表1.字段x = 表2.字段y）;
		<!-- select user.id, user.username, user.age, 
			goods.name, goods.price, goods.id
			from user, goods 
			where user.gid=goods.gid; -->

	显示内链接：(不常用)
	 select 表1.字段1,..., 表2.字段1,... from 表1 inner join 表2 on 条件1（表1.字段x = 表2.字段y） where 条件2 having 条件3;
	 	<!-- select user.id, user.username, user.age, 
		goods.name, goods.price, goods.id
	 	from user inner join goods 
	 	on user.gid=goods.gid
	 	where user.age>30;  -->

 2.外链接：
 	左联接：<!-- 以左表为基准,右边不对应左边的补null -->
 	 select 表1.字段1,..., 表2.字段1,... from 表1 left join 表2 on 条件（表1.字段x = 表2.字段y）where 条件2 having 条件3;
 	 	<!-- select user.id, user.username, user.age, 
		goods.name, goods.price, goods.id
	 	from user left join goods 
	 	on user.gid=goods.gid
	 	where user.age>30;  -->

	右链接：<!-- 以右表为基准,左边不对应左边的补null -->
	 select 表1.字段1,..., 表2.字段1,... from 表1 right join 表2 on 条件（表1.字段x=表2.字段y）;
	 	<!-- select user.id, user.username, user.age, 
		goods.name, goods.price, goods.year, goods.id
	 	from user right join goods 
	 	on user.gid=goods.gid
	 	where goods.year>40; -->

 3.嵌套查询(也可以是一个表里面)
	select 字段1 from 表1 where 字段2 in(select 字段2 from 表2);
	 <!--
	  1. select province,count(province) from aa
	 	 group by province having count(province)=
			(select distinct count(province) as pro from aa
			group by province order by pro desc limit 1,1);

	 2.	select * from goods where gid not in (select gid from user); -->
	
 4.	联合查询union
 	union：将两个表查询出来的合到一块显示，并去重；
 	union all：将两个表查询出来的合到一块显示，不去重；

 	select 语句1 union select 语句2;
 	 <!-- 	select * from a left join aa on a.id=aa.id 
	 		UNION
	 		select * from a right join aa on a.id=aa.id; -->

18.清空表记录
	truncate table 表名;
		<!-- truncate table user; -->
	 注：truncate 删除数据之后自增项从1开始；
	 	delete删除数据后自增项在原基础上增加；

19.表的导入导出
	0.复制表<!-- 包括原表的结构和数据 mysql小黑框内-->
		create table 新表名 select * from 旧表名;
			create table user2 select * from user;

 <!-- dos命令下，路径斜线为正斜线(路径不写到主盘下)，回车后输密码，包括原来数据-->
	1.导出单张表
		mysqldump -uroot -p 库名 表名 > 路径
		enter password:
			<!-- mysqldump -uroot -p php1714 user > D:a/aql/user.sql -->
		
	2.导入单张表<!--导入表只写库名,重名则覆盖-->
		mysql -uroot -p 库名 < 表路径
		enter password:

	3.导出库
		mysqldump -uroot -p 库名 > 路径
		enter password:
		
	4.导入库<!--导入库需要有一个新的库名-->
		mysql -uroot -p 新库名 < 库路径
		enter password:

	5.mysql下导入数据
		use 库名;
		source 数据路径

	6.导出表的结构<!--没有数据-->
		mysqldump -uroot -p --add -drop -table 库名 > 路径
		enter password:	

20.DCL
 用户：
	1.创建用户
	 create user '用户名'@'127.0.0.1' identified by '密码';
		<!-- create user 'nana'@'127.0.0.1' identified by '123'; -->

	2.删除用户
	 drop user '用户名'@'127.0.0.1';
	 	<!-- drop user 'nana'@'127.0.0.1'; -->

 权限：<!-- 权限包括增删改查,全部直接写all -->
	1.赋予权限
	 grant 权限1, 权限2,... on 库名.表名 to '用户名'@'127.0.0.1';
	 	<!-- grant select, delete on *.* to 'nana'@'127.0.0.1'; -->

	2.移除权限
	 revoke 权限1,权限2,... on 库名.表名 to '用户名'@'127.0.0.1';
	 	<!-- revoke all on *.* to 'nana'@'127.0.0.1'; -->

21.DTL事务(回滚)
	1.确定引擎开启innodb;(设计表中查看 || alter table 表名 engine=innodb)
	2.自动提交改为手动提交
		set autocommit = 0;
	3.开启一个事务
		begin
	4.写sql语句(增删改查)
	5.确认就commit提交;
		否则rollback回滚;



第17天
22.天龙八步<?php
 	//1.创建连接：mysqli_connect('主机名', '用户名', '密码') 
		$link = mysqli_connect('localhost', 'root', '');

	 //2.判断连接是否成功：不成功退出并输出错误消息
	 	if (!$link) {
	 		exit('error('. mysqli_connect_errno() .':'. mysqli_connect_error() .')');
	 	}
		
 	//3.设置字符集
		mysqli_set_charset($link, 'utf8');

	//4.选择数据库：没有该库输出错误号，错误信息->关闭数据库->断点退出
		if (mysqli_select_db($link, 'aa')) {
			echo 'error('. mysqli_errno($link) .':'. mysqli_error($link) .')';
			mysqli_close($link);
			die;
		}

	//5.准备sql语句(根据需求写)
		$sql='...';

	//6.发送sql语句
		$result = mysqli_query($link, $sql);

	//7.处理结果集：判断是否有值->利用while循环输出->将结果存在数组里
		if ($result && mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$data[] = $rows;
			}
		}

	//8.释放资源，关闭数据库
		mysqli_free_result($result);
		mysqli_close($link);
		
	?>

23.部分数据库函数<?php
	注：函数可能扩展模块没开不支持，打开选项（除去前面的'#'）
		php.ini->extension=php_mysqli.dll

	//返回链接时的错误号，无参数
	mysqli_connect_errno();
	
	//返回链接时的错误信息，无参数
	mysqli_connect_error();

	//返回最近一次函数调用时产生的错误号
	mysqli_errno($link);

	//返回最近一次函数调用时产生的错误信息
	mysqli_error($link);


 	//返回受影响的行数
	mysqli_affected_rows($link);

	//返回查询记录的总条数
	mysqli_num_rows($result);


	//返回读取一行数据的索引数组，一行一行的读,读完返回null
	mysqli_fetch_row($result);

	//返回读取一行数据的关联数组，一行一行的读,读完返回null
	mysqli_fetch_assoc($result);

	//返回读取一行数据的既有关联又有索引的数组，一行一行往下读,读完返回null
	//参数MYSQLI_ASSOC为显示关联数组，MYSQLI_NUM为显示关联数组，BOTH为显示两种
	mysqli_fetch_array($result, MYSQLI_ASSOC);

	//返回读取所有数据的二维数组，读取的是sql语句中的所有数据
	mysqli_fetch_all($result);


	//返回当前插入数据的自增的id值，只获取单个第一次插入的值
	mysqli_insert_id($link);
 ?>

24.需求(显示用户信息并实现增删改查)：
	1.创建用户信息表，包括以下字段：
	id(主键)，username，password，email，createtime，regip，
		<!--create table user(
			id int(11) auto_increment,
			username varchar(45), 
			password char(32), 
			email varchar(30),
			creattime timestamp default CURRENT_TIMESTAMP,
			regip int(11),
			primary key(id)
			) engine=InnoDB default charset=utf8; -->
 
	2.利用table表格显示user表的用户信息，显示如下字段：
	id(id)，用户名(username)，邮箱(email)，注册时间(createtime)，注册ip(regip)；
		<!-- userlist.php中：1.查找，2.遍历显示 ip部分用long2ip -->

	3.添加注册界面，显示如下注册信息：
		用户名，密码，确认密码，邮箱

	4.实现注册功能，并添加以下限制：
		用户名长度大于4位(不包含任意空格)；
		密码长度不能小于4位，不能为纯数字；
		添加注册时的ip
		 <!-- 本机注册的ip为'::1'，转为127.0.0.1才能用ip2long转换 -->

	5.table表格中添加‘编辑’字段，让每条记录显示有‘删除’和‘修改’两种情况并实现其操作；
		1.删除用url传参获取id，注意a链接写法href="del.php?id=$data['id']"，并注意拼接和解析变量，
		  <!-- del.php中用$_GET(不考虑批量删除)获取id确定删除哪条记录 -->

		2.1显示修改界面：
		 <!-- 1.用url传参获取id，注意拼接和变量解析，a链接意思:href="update.php?id=$data['id']"，
			  2.根据$_GET获取的id进行查找，遍历显示修改项(可以有密码)，
		 重点：3.在from表单中用hidden隐藏修改记录的id值，或者在action(提交文件doUpdate.php?id=)中用url传参确定修改记录的id， -->
		2.2执行修改：
			<!-- 根据from中hidden传过来的值确定要修改的记录id; -->

	6.table表格中id前添加‘多选’字段让每条记录有选择标识显示,以及一个多选按钮实现批量删除；
		1.传递到del.php中，用$_REQUSET接收；
		2.根据$_REQUEST接收来的数据类型判断是单独删除还是批量删除；
		3.处理批量删除的条件问题
		  <!-- 1. checkbox传过来的是数组，用join拼接为字符串；
			   2. sql语句利用where id in(); -->


第18天
25.分页
	1.获取总条数；
	2.定义每页显示数；
	3.计算总显示页数(向上取整);
	4.获取当前页:$page；
	5.定义偏移量；
	6.定义上一页下一页；
		$prev = $page-1;
		$next = $page+1;
	7.补充完整sql语句；

	<!--注意：1.注意判断$prev和$next的极限值；
		2.html中a标签中href的写法： -->

26.封装函数：链接,增,删,改,查（mysql_func.php）
 1.链接：dbConnect()
	 1.链接得到$link;
	 2.判断是否链接成功；
	 3.设置字符集；
	 4.选择数据库；
	
	 <!-- 注意：0.参数：
		1.return $link;
		2. 出错不用返回错误号，直接return false； -->

 2.增加：dbInsert()
	 0.传入参数中$data为数组形式['字段'=>'值', ...]；
	 <!-- 1.注释给出对照sql语句:$sql= insert into $table ($fileds) values($values); -->
	 1.处理字段问题：$fileds;
	 2.处理值的问题：$values;
		 0.由于字符串形式的值需要加上单引号；
		 1.方法一：<!-- array_values(parseValue_a($data)) -->
			 ①直接对$data进行foreach遍历，
			 ②判断$value是否为字符串，是的话拼接单引号；
			 ③return $data;
		 2.方法二：<!-- parseValue_b(array_values($data)) -->
		 	 注意外部要先取出$data中的值$value；
		 	 ①判断值是否为字符串，是的话拼接单引号；
		 	 ②不是判断值是否为数组，是的话用array_map('parseValue_b', $value)回调继续；
		 	 ③还不是判断值是否为空，是的话赋值为空；
		 	 ④return $values;

	 3.写sql语句；
	 4.执行sql语句返回结果集；
	 5.对结果集进行判断返回true或false，并判断是否返回插入的id；

		注意：0.参数：
			1.处理后的字段和值都是字符串形式，要用join进行拼接；
			2.处理值的情况选一个方法进行使用，留意函数的嵌套不能写反；
			3.留意parseValue()中的返回值问题；
			4.留意dbInsert()的返回值;

 3.删除：dbDelete()
 	 0.传入的条件为字符串形式('id=...');
 	 <!-- 1.注释给出对照sql语句:$sql= delete from $table where $where; -->
 	 1.判断条件是否为字符串形式，不是的话返回false，<!-- 考虑传入数组的情况,多条数据？ -->
 	 2.是的话直接拼接sql语句
 	 3.执行sql语句返回结果集；
 	 4.判断结果集返回true或false；

		注意：0.参数：
			1.外部要提前处理$where, 批量删除有同一字段时用：id in()；
			<!-- 2.输入为数组的话是否意味多条数据，
				 3.若多条数据的删除没有同一字段:
					 要么在dbDelete()外部查出统一字段后用id in()；
					 要么在dbDelete()内部使用foreach遍历数组，在内部：
						1.拼装$sql->执行删除->判断结果集(不能return true或false；)
						2.判断结果集时，根据true或false输出相应的提示语句
						3.把提示语句存在数组里，作为dbDelete()的返回值输出； -->

 4.修改：dbupdate()
 	 0.传入的参数为数组形式$set['字段'=>'值']
 	 1.处理值为字符串要加引号的问题；
 	 2.处理$set的问题；
 	 	 0.处理添加等号的问题：<!-- $set=parseSet($set); -->
 		 ①foreach遍历$set，
 		 ②判断$value为标量后拼接等号'='；(留意先赋值$set为空数组)
 		 ③返回拼接好等号后的$set；

 	 3.拼接sql语句；
 	 4.执行sql语句返回结果集；
 	 5.判断结果集：返回true或false；
 	
 5.查询：dbselect()
 	 0.注意条件参数的传入，赋初始值为null；
 	 1.写出sql语句；
 	 2.sql语句拼接条件；
 	 3.执行sql语句返回结果集；
 	 4.判断结果集以数组形式返回查询的内容
		<!-- $data = mysqli_fetch_all($result); -->

mysql_func.php
 <?php
 	function dbConnect($host, $user, $pwd, $dbNmae)
 	 {
 		@$link = mysqli_connect($host, $user, $pwd);

 		if (!$link) {
 			return false;
 		}

 		mysqli_set_charset($link, 'utf8');

 		if (!mysqli_select_db($link, $dbNmae)) {
 		 	mysqli_close($link);
 		 	return false;
 		 } 
 	 }

 	function dbInsert($link, $table, $data, $getId=false)
 	 {
 		//$sql = insert into $table($fileds) values($values);
 		
 		$fileds = join(',', array_keys($data));

 		//$values = join(',', array_values(parseValue_a($data)));

 		$values = join(',', parseValue_b(array_values($data))); 

 		$sql = "insert into $table ($fileds) values ($values)";

 		$result = mysqli_query($link, $sql);

 		if ($result && mysqli_affected_rows($link)) {
 			if ($getId) {
 				return mysqli_insert_id($link);
 			}
 			return true;
 		}
 		return false;
 	 }
 
 	function parseValue_a($data)
 	 {
 		foreach ($data as $key => $value) {
 			if (is_srting($value)) {
 				$data[$key] = '\''. $value .'\'';
 			}
 		}
 		return $data;
 	 }

 	function parseValue_b($values)
	 {
	 	if (is_string($values)) {
	 		$values = '\''. $values .'\'';
	 	} else if (is_array($values)) {
	 		$values = array_map('parseValue_b', $values);
	 	} else if (is_null($values)) {
	 		$value = null; 
	 	}
	 	return $values;
	 }

	function dbDelete($link, $table, $where)
	 {
	 	//$sql = delete from $table where $where

	 	if (is_string($where)) {
	 		$sql = "delete from $table where $where";
	 	} else {
	 		return false;
	 	}

	 	$result = mysqli_query($link, $sql);

	 	if ($result && mysqli_affected_rows($link)) {
	 		return true;
	 	}
	 	return false;
	 }

	function dbUpdate($link, $table, $set, $where)
	 {
	  	//$sql = update $table set $set where $where;
	  	
	  	if (is_array($set)) {
	  		$set = parseSet($set);
	  	}

	  	$sql = "update $table set $set where $where";

	  	$result = mysqli_query($link, $sql);

	  	if ($result && mysqli_affected_rows($link)) {
	  		return true;
	  	}
	  	return false;
	 }

	function parseSet($set)
	 {

	 	$set = parseValue_a($set);
	 	foreach ($set as $key => $value) {
	 		if (is_scalar($value)) {
	 			$set = $key .'='. $calues;
	 		}
	 	}
	 	return join(',', $set);
	 }

	function deSelect($link, $flieds, $table, $where=null, $order=null, $group=null, $having=null, $limit=null)
	 {
	 	// $sql = select $fileds from $table where ...;
	 	
	 	$sql = "select $flieds from $table";

	 	if ($where) {
	 		$sql .= ' where '. $where;
	 	}
	 	if ($order) {
	 		$sql .= ' order by '. $order;
	 	}
	 	if ($group) {
	 		$sql .= ' group by '. $group;
	 	}
	 	if ($having) {
	 		$sql .= ' having '. $having;
	 	}
	 	if ($limit) {
	 		$sql .= ' limit '. $limit;
	 	}

	 	$result = mysqli_query($link, $sql);

	 	if ($result && mysqli_affected_rows($link)) {
	 		return mysqli_fetch_all($result, MYSQLI_ASSOC);
	 	}
	 	return false;
	 }

	//处理分页
	 //（$link, 查询的字段，表名，每页显示数，获取当前页，统计的数）
	 //返回值(使用时记得取下标)：查询的内容，上一页，下一页
	 //注意获取当前页（$page = empty($_GET['page']) ? 1 : $_GET['page'];）
	function paging($link, $fileds, $table, $num=3, $page, $countFiled='uid')
	 {
		//获取总记录数
		$count = dbSelect($link, "count($countFiled) as count", $table);
		$counts = $count[0]['count'];
		//var_dump($counts);
		
		//获取总页数
		$pageCount = ceil($counts / $num);

		//注意这个条件
		//$page = empty($_GET['page']) ? 1 : $_GET['page'];

		//偏移量
		$offset = ($page-1) * $num;

		//上一页
		$prev = $page - 1;
		 	if ($prev<1) {
		 	 	$prev = 1;
		 	 } 

		//下一页
		$next = $page + 1;
		 	if ($next > $pageCount) {
		 		$next = $pageCount;
		 	}

		//查询limit的结果
		$result = dbSelect($link, 'uid,uname,gold,regtime,utype,islock', 'user', null, null, null, null, "$offset , $num"); 
		//var_dump($result);

		//返回值：结果，上一页，下一页
		return $data = [$result, 'prev'=>"$prev", 'next'=>"$next"];
	 }

 ?>



27.简易发帖回帖：
 0.先建立帖子表，包括以下字段：
 	id，title，contents，createtime，rid
 	 <!-- 注：发帖的rid固定为0，回帖的rid对应贴子的id -->

 1.建立显示帖子(标题)列表界面

 2.创建界面显示帖子详情，显示如下内容：
 	 帖子内容，发贴时间；
 	 回帖内容，回帖时间；
	 发表回帖；



第19天
28.HTTP
	1.通讯流程：
		建立连接->发送请求->响应请求->关闭链接

	2.特点：
		无链接,无状态的协议，不记录上一个链接的登录状态

	3.组成：
		协议报文：报文头部，报文主体
			报文头部：请求行/状态行、空行、头部信息
				头部信息：包括cookie在内的多种，$_SERVE['HTTP_HOST'];

	4.状态码
		100段：继续
		200段：成功
		300段：重定向，300,301重定向；
		400段：请求错误
			400:语义或参数有误
			401:需要用户验证
			403:服务器拒绝执行(forbidden)
			404:请求失败，页面未找到(not found)
		500段(含600)：服务器错误
			502:网关错误
			504:请求超时未响应

	5.域名：
		一级域名：www.baidu.com
		二级域名：www.fanyi.baidu.com

29.回话控制
 1.COOKIE
	 设置：setcookie('键', '值', 有效期);
	 获取：$_COOKIE['键'];
	 销毁：setcookie('键', '', 有效期-1);
	 	   unset($_COOKIE['键']);
	 查看：F12->network->F5->header(cookie);

 2.SESSION
	 <!--使用前必须开启（seeeion_start()），而且前面不能有任何输出-->
	 设置：$_SESSION['键']='值';
	 获取：$_SESSION['键'];
	 销毁：unset($_SESSION);
		   setcookie(session_name(), '', time()-1);
		   session_destory();
	 查看：从php.ini->session.save_path查看存储路径，找路径下的内容<!-- session_id() -->

 3.区别
 	 cookie：放在客户端  安全性不高  过多不太影响服务器性能  存放一般信息
	 session:放在服务器  相对安全    过多影响服务器性能		 存放重要信息
	
