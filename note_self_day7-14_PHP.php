第七天
1.PHP概述
	1.运行在服务器端，可以内嵌在html中的语言
	2.wampsever集成环境：PHP7.0，mysql，apache，(database)
	3.访问路径(地址)：localhost/php文件（或127.0.0.1/php文件）
	4.开发工具：notepad++，sublime，phpstrom
	5.PHP信息：phpinfo(); 显示php所有的信息
	6.PHP的运行机制及原理
		客户端(PC端)->服务器->引擎处理->数据库信息交互(引擎处理)->界面显示

2.wampserver环境配置
	1.修改访问路径：安转文件夹->www->index.php
		64位改482行和484行为:
			$projectContents .= 'http://localhost/' .$file.$UrlPort.'/"';
		32位改407行和409行为：
			$projectContents .= 'http://localhost/' .$file.$UrlPort.'/"';

		注意：localhost后面记得加/

	2.php版本：
		小绿->php->Version->7.0.0

	3.modules开启(特别是64位的系统)：
		小绿->Apache->Apache modules->autoindex_module  前面打√

	4.配置变量(mysql用)：
		1.复制文件夹路径：
			安装文件->bin->mysql->mysql5.7.9->bin
		2.打开配置(粘贴)位置
			我的电脑->(右键)属性->高级系统设置->环境变量->系统变量->Patch
		3.粘贴文件夹路径
		(双击Patch后)末尾加英文分号->粘贴复制好的文件夹路径->确定->确定(不是点击关闭)

3.localhost
	浏览器中输入localhost相当于转到：安装文件/www/
		注意index.php：域名自动加载目录下的index.php文件，
		若路径中某级有inde.php则遇到就加载，不会转到指定的文件夹下(设置虚拟站点时注意)
	
	区别：
		127.0.0.1相当于IP地址;利用它访问需要有网卡驱动的支持；
		localhost相当于域名;利用它访问可以不用网卡驱动的支持；

4.相互访问局域网
	1.查询本机ip地址
		win+r(运行)->cmd->(输入)ipconfig->(回车)->IPv4地址；

	2.关闭防火墙(全关)
		控制面板->系统安全->windows防火墙

	3.修改require
		32位：wamp/bin/apach/apach2.4.17/conf/http-vhost.conf(395行)
		64位：wamp64/bin/apache/apach2.4.17/conf/httpd.conf(285行)
			改 Require local 为 Requir granted

5.文件格式（不能用浏览器直接打开）
	0.设置字符集：
		header("Content-Type:text/html;charset=utf-8");

	1.常用格式
		<?php
			php代码;
		?>
		注：纯php代码中末尾的?>必须省去
		
	2.短标签格式
		<?
			php代码;
		?>
	设置php.ini中short_open_tag=On 打开这种格式，off关闭

	3.简写打印格式（tpl模板的转译形式用）
		输出变量：<?=$a;?>

	另：
	if格式：<?php if (): ?>
				执行体;
			<?php endif; ?>
		
			<?php if (): ?>
					执行体
				else if (): 
					执行体;
				else if ():
					执行体;
				else:
					执行体;
			<?php endif; ?>

	foreach格式:<?php foreach (): ?>
				执行体;
			<?php endforeach; ?>

	注意：1.代码写完加英文半角分号;
		2.简写格式中：if和小括号间有空格
		3.替代语法的基本形式:
			①是把左花括号（{）换成冒号（:），
			②把右花括号（}）分别换成endif; 、endwhile; 、endfor; 、endforeach; 以及 endswitch;


6.变量
	1.命名规则：
		1.必须以$开头；
		2.等号两边加空格，注意'='是赋值；
		3.只能由数字，字母，下划线组成；
		4.不能以数字开头;
		5.严格区分大小写；
		6.不能使用除下划线之外的特殊字符；
		7.变量名语义化；
		8.遵循小驼峰命名法和以下划线为连接的标准写法；
		9.遵循公司规范；

	2.变量操作：
		1.赋值(=)：$a = 18;
		2.变量输出：echo ;
		3.判断一个变量是否存在：isset();
		4.销毁一个变量：unset();
		5.获取一个变量的类型：gettype();

	3.打印输出<?php
		echo ; var_dump();  print(); print_r();   ?>

		四者区别：
			1.echo 为语言结构，用于输出数值变量或者是字符串，可输出多个变量，输出数组时只输出数组名字；
			2.print比echo慢、只能输出一个变量；print()是语言结构，可以不用小括号；
			3.print_r() 为函数，有一个返回值；
			4.var_dump()返回表达式的类型与值,并能打印多个变量，而print_r仅返回结果；


7.注释
	1.单行注释
		// 或者 #
	2.多行注释
		/* 注释内容  */

8.数据类型
	标量 4个
		整型：int（integer）
			十进制：基数0~9;
			二进制：基数0,1;  前缀0b；
			八进制：基数0~7;  前缀0；
			十六进制：基数0~9,a~f; 前缀0x；

		浮点型：float（float/double）
			标准型：$float = 3.14;
			科学计数：$float = 3.14e3;
		
		布尔型：bool（boolean）	
			值为true或false；

		字符串：string
		
	混合类 2个
		数组：array
		对象：object
	特殊类 2个
		空：null
		资源：resource
	
9.单双引号区别
	1.单引号不解析变量，双引号解析变量；
	2.双引号效率低于单引号；
	3.双引号中有变量，变量后有字符需要加{}或者空格隔开才解析；
	4.单引号不能套单引号，双引号不能套双引号，但是可以相互嵌套；
	5.双引号解析转译字符，单引号不解析除 \' 、\\ 外的转译字符；
	6.字符串的拼接（.）；
	7.双引号内有单引号，单引号内有变量，变量解析并套有单引号；

10.简介合集：
	1.流程控制：
		if - else ;
		for ;
		while ;
		do while ;

	2.数组：
		一组数据的有效合集；
		$arr = [];

	3.对象：
		一类事物的具体的个数；

	4.资源：
		resource；

11.空类型
	1.赋值变量为空 $num=null;
	2.unset()一个变量后
	3.声明变量没有赋值

12.常用的函数<?
	is_int()/ is_long() / is_integer() / 
	is_float()/ is_real() / is_double() /
	is_string()
	is_bool()
	is_array()
	is_object()
	is_null()
	is_resource()

	is_scalar()		//判断是否是标量(4个)
	unset()			//消除一个变量
	

	//判断是否是纯数字
	is_numeric()

	isset()		//检测变量是否设置
		/*变量不存在返回false；
		变量存在但变量的值为null,返回false；
		变量存在且变量不为null返回true；
		 */
	
	empty()		//判断变量是否为空：
		/*为空返回true,不为空返回false;
		为空的情况：1.变量不存在；
			2.变量存在但值为:空字符串('')、0、'0'、null、false、空数组
		 */
	?>

13.类型转换
	1.强制类型转换<?
		intval($val)	或 	(int)$var
			//强制准换为int型，字母在前变为0，数字在前只保留整数；

		floatval($var)	或 	(float)$var
			//强制准换为float型，字母或汉字在前变为0，只保留前面的数字；

		strval($var)	或 	(string)$var
			//强制转换为string型；

		boolval($var)	或 	(bool)$var
			//强制转换为bool型，只有true或false；
		
		注意：
			1.val样式的有四个；
			2.前面加小括号的不能放null和resource,可以有array和object,一共六个；
			3.settype不能有resource，一共七个；

		settype($var, 'type')
			//强制转化为指定类型，类型要加引号；资源无效；会改变原来的值?>
			
		强制转换总结：
			1.使用null转换为int，结果为int型的0；
			2.使用null转换为float，结果为float型的0；
			3.使用null转换为string，结果为空字符串(没有任何字符的字符串)；
			4.string转换为int，结果舍去小数点后面的东西；
			5.string转换为float，结果保留小数，去掉字符串；
			6.settype($a, 'null') 等价于 $a=null ；
			7.intval($var)和(int)$val样式的不会改变原来的值，但settype()会改变原来的值；

	2.自动类型转换：
		进行+-*/计算时，运算的变量会自动转换为数值型，再计算；
			1.运算时true为1，false为0；
			2.字符串前面数字后面字符，只保留数字进行计算；
			3.字符串开头是字母，转换为进行0计算；

	3.自动转换(为false的)类型
		1.int型的0；(非0整数为true)
		2.float型的0.0；(小数点后只要有一位非零数即为真)
		3.string型的0；(但是string型的0.0为true)
		4.空字符串；(连空格都不含有的空字符串)
		5.空数组；(连空格都不含有的空数组)
		6.null；
		7.未成功申明的变量；

14.常量和特殊变量：
	定义：在程序的运行过程中，其值不可改变的量；
	格式：define('常量名' , '值');
	规则：
		常量值只能为标量；
		常量名一般大写；
		常量名建议只用字母和下划线；
		常量名定义时需要加上引号；
		调用时不能用任何的引号包裹，也不带$；
		常量全局有效；
	意义：
		提高代码可读性；
		提高代码移植性；
		降低维护成本；
	
	常用(9个)系统常量：<?php
		__LINE__		//获取当前行
		__FILE__		//获取当前文件(带后缀的)
		__DIR__			//获取当前路径(文件夹)
		PHP_OS 			//获取当前操作系统
		PHP_VERSION		//获取当前php版本
		M_PI 			//获取圆周率PI
		__CLASS__		//获取当前类名
		__FUNCTION__	//获取当前函数名
		__METHOD__		//获取当前方法名(类::方法名)
		__NAMESPACE__	//获取当前的命名空间
		//？？？ __TRAIT__	获取当前的trait(代码复用机制)名字
		?>
		
	超全局变量：<?php
		$GLOBALES
		$_GET
		$_POST
		$_REQUEST
		$_SERVER
		$_COOKIE
		$_SESSION
		$_FILES
		$_ENV

		服务器的环境变量$_ENV
		/*为空可能是php.ini中variables_order的值缺少E，不接受外部环境变量；
		改为variables_order="EGPCS"后能启用，但可能会有些性能缺失*/

		另：面试题目
		$_SERVER['DOUNMENT_ROOT']	//获取当前脚本所在文档的根目录
		$_SERVER['HTTP_HOST']		//获取当前请求文件的host：头部信息
		$_SERVER['SERVER_NAME']		//获取当前脚本文件运行的服务器主机名字
		$_SERVER['SERVER_ADDR']		//获取服务器的id
		$_SERVER['REMOTE_ADDR']		//获取当前浏览用户的id
		$_SERVER['HTTP_REFERER']	//获取上一个界面的url

		$_FILES 		//获取所有的上传文件信息
		$_FILE['userfile']['name'] 	//获取客户端机器文件的原名称
		$_FILE['userfile']['type']	//获取上传文件的MIME类型
		$_FILE['userfile']['size']	//获取上传文件的大小，单位为字节
		$_FILE['userfile']['tmp_name'] 	//获取上传文件在服务器中临时存储的名字
		$_FILE['userfile']['error']	//获取上传文件的错误号
		?>

15.变量的引用
	取地址(&)：（变量存储机制留意php垃圾回收机制）
		多个变量指向同一个地址，
		其中一个变量改变(改变地址内数据)
		则指向该地址的所有变量值均改变；

	可变变量($)：<?php
		$name = 'test';
		$test = 'zk';
		$zk = 'd';
		echo $$$name;  //显示d
		?>

	变量的引用和传值的区别：
		1.传值需要重新构造一份原参数的拷贝；传引用则不用；
		2.传值不会改变原参数的值；传引用可以直接修改原参数
		3.当拷贝数据比较大的时候，传值需要的内存比较大，对性能会有一定影响；传引用不会存在这个问题

16.运算符
	⑴=， -=， +=， *=， /=， %=， .=，
		其中.=为连接符(字符串)

	⑵++:自增；	--:自减
		++--在后面：先进行其他运算，再进行自增自减
		++--在前面：先进行自增自减，再进行其他运算
	<?php
		$a=1; $b=3;
		$sum = $a++ + $b++ - $a - $b + ++$a - --$b + $a++;
		//		1 	+  3   - 2  - 4  +  3   -   3  +   3
		echo $sum, $a, $b;
		//	   1    4   3
	?>
	

	⑶>=， <=， !=， ===， !==， 		 	
		其中===为绝等于(还要比较类型)
	
	⑷三目运算符(三元运算符)
		条件 ? 真区间 : 假区间;
		$a>$b ? ($c<$d ? 1 : 2) : 3

	⑸ 逻辑运算
	||：或者，有一个为真就是真；(or) 	
	&&：两者为真才是真；(and)
	! ：取反；
	& ：按位与；
			1&1=1；1&0=0；0&0=0；
	| ：按位或；
			1|1=1；1|0=1；0|0=0；
	^ ：按位异或；
			1^1=0；1^0=1；0^0=0；
	<<：左移；基数<<位数：
			简记为：基数*2^位数；
			实质：基数转换为2进制，移几位后面加几个零，再计算结果；
	>>：右移；基数>>位数：
			简记为：基数/(2^位数),向下取整；
			实质：基数转为2进制，移几位去除末尾的几位，移动位数大于原长度为0；

	短路原则：
		&&：前面表达式为假的话，就是假，后面的表达式不参与运算；
		||：前面表达式为真的话，就为真，后面的表达式不参与运算；

	⑹  @：错误抑制符(警告错误抑制，变量未定义之类)
		=>：数组访问符；
		->：对象访问符；

	随机数函数：
		rand();		mt_rand();


17.定界符<?
	$str=<<<"ABC"
		php的"代码";
ABC
echo $str;
 ?>
	
	注意：1.好处是双引号可以套双引号
		2.定界用大写，首尾一致
		3.结束的时候顶格写
		4.解析变量


第九天
16.分支结构<?pph
	⑴
	if (条件) {
		(真区间)执行体;
	}

	⑵
	if (条件) {
		(真区间)执行体1;
	} else {
		(真区间)执行体2;
	}

	⑶
	if (条件1) {
		(真区间)执行体1;
	} else if (条件2) {
		(真区间)执行体2;
	} else if (条件3){
		(真区间)执行体3;
	} else {
		执行体;
	}

	⑷
	switch (条件) {
		case 值1:
			执行体;
			break;
		case 值2:
			执行体;
			break;
		case 值3:
			执行体;
			break;
		default :
			执行体;
			break;
	}
	?>
	总结：
	0.注意空格；
	1.运行原理：如果条件为真走真区间如果为假走假区间；
	2.else if 可以写多个没有上限，从上往下走，满足条件走执行体不满足继续往下走，都不满足走else；
	3.switch中case没有上限，后面的值为标量；
	4.break表示结束当前情况的执行体，部分情况下可以不写；
	5.default等价于else，没有对应执行体可不写；	

17.循环<?php
	⑴for	//(初始条件;比较条件;自增自减条件);
		for ($i=0; $i < ; $i++) { 
			循环体;
		}
	// 执行流程：初始化条件->比较条件(不成立结束)->循环体->自增自减条件->比较条件(不成立结束)->循环体->自增自减条件->.....

	⑵while
		while (条件) {
			循环体;
			自增自减条件;
		}
	// 执行流程：条件(成立)->循环体->自增自减条件->条件(成立)->循环体->自增自减条件->条件(成立)->......

	⑶do-while
		do{
			循环体;
			自增自减条件;
		}while(条件);
	// 执行流程：循环体->自增自减条件->条件(成立)->循环体->自增自减条件->条件(成立)->......
		?>
	
	注意：break;countinue
		break：跳出此次循环并结束当前循环体；
		continue：跳出此次循环并继续后面的循环；

例子1：for写99乘法表(有表格)：
<?php
	echo '<table border="1" width="600">';
	for ($i = 1; $i <= 9; $i++) {
		echo '<tr>';
			for ($j = $i; $j <= 9; $j++) {
				echo '<tr>'. $i .'*'. $j .'='. $i*$j .'</tr>';
			}
		echo '</tr>';
	}
	echo '</table>';
 ?>

例子2：while写99乘法表(有表格隔列变色)：
<?php
	echo '<table border="1">';
	$i = 1;
	while ($i <= 9) {
		echo '<tr>';

		$j = 1;
		while ($j <= $i) {
			if ($j % 2 == 0) {
				echo '<td bgcolor="pink">'. $i .'*'. $j .'='. $i*$j .'</td>';			
			} else {
				echo '<td >'. $i .'*'. $j .'='. $i*$j .'</td>';	
			}
			$j++;
		}

		echo '</tr>';
		$i++;
	}
	echo '</table>';
 ?>

例子3：do-whil写99乘法表(有表格隔行变色)：
<?php
	echo '<table border="1">';
	$i = 1;
	do {
		if ($i % 2 == 0) {
			echo '<tr bgcoloe="pink">';
		} else {
			echo '<tr>';
		}

			$k = 1;
			do{
				if($k < $i){
					echo '<td></td>';
				}
				$k++;
			} while ($k < $i);	

			$j = $i;
			do {
				echo '<td>'. $i .'*'. $j .'='. $i*$j .'</td>';
				$j++;
			} while ($j <= 9);
		
		echo '</tr>';
		$i++;
	} while ($i <= 9);
	echo '</table>';
 ?>

例子4：人在江湖漂
<?php
	//规则：
	// 	玩家a: 1 2 3 4 5 1 1 1
	// 	玩家b: 2 3 4 5 1 1 3 4
	// 	赢家： b b b b b - - -
	$i = 1;
	while (true) {
		$a = mt_rand(1,5);
		$b = mt_rand(1,5);
		$res = $b-$a;

		if($res == 1 || $res == -4){
			echo '第'. $i .'次pk玩家a:'. $a .'---玩家b:'. $b .'<br />';
			echo '玩家b赢<br />';
			break;
		} else if ($res == -1 || $res == 4){
			echo '第'. $i .'次pk玩家a:'. $a .'---玩家b:'. $b .'<br />';
			echo '玩家a赢<br />';
			break;
		} else {
			echo '第'. $i .'次pk玩家a:'. $a .'---玩家b:'. $b .'<br />';
			echo '平局<br />';
		}

		$i++;
	}
 ?>



第十天
18.函数 funtion
	类型：
		系统函数：php本身语言自带的功能模块；
		自定义函数：自己封装的功能模块；

	优点：提高代码利用率；
		减少开发时间；
		减少冗余；
		增加可维护性；
		代码方便调用；

	定义：
		基本样式：
			function 函数名()
			{
				函数体;
			}

		标准定义样式：(参数带中括号表示可有可无)
			function 函数名([形参1,形参2, ...])
			{
				函数体;
				return;
			}

		注：1.返回值一般有，视情况而定；
			2.函数可以调用无限次；
			3.函数调用与定义的顺序无关但变量不是
		
19.函数的注意事项
	1.定义以function开头；
	2.命名规则和变量相同；
	3.函数的调用直接使用函数名()；
	4.函数的定义可以在调用前；
	5.函数名不区分大小写，但一般不这么干；
	6.形参可以有有可无，根据需要添加；
	7.形参可以有默认值，但必须是一一对应；
		1.有传参数实际值为传来的值；
		2.形参有默认值的一般放到后面；
		3.有形参没有默认值必须穿参数；
	8.function后接空格，空格后接函数名；
	9.函数定义处的参数是形参，函数调用时的参数为实参；
	10.函数可以有返回值，使用return关键字；
	11.使用return时后面的代码不执行；
	12.return作用范围：函数体内只对内部有效，函数体外全局有效；
	13.函数不能被重定义（redeclaer）；

20.作用域：
	定义：一个变量或者一个函数的作用范围，有成为生命周期
	
	1.内部变量：
		在函数体内声明的变量，只在函数体内有效，程序结束后自动销毁；（内部变量一般不在外部使用）
	2.外部变量：
		外部变量就是在函数体外声明的变量，全局有效，但是函数体内不能使用；（利用超全局变量则可以）

21.global关键字：
	global修饰的变量全局有效，函数体内能调用，若在内部改值会覆原运来的值；
	区别于$GLOBALES[''], 超全局变量函数体内也可以使用，但是函数体内重新赋值不覆盖外部变量；
	<?php
		$a = 2;
		$b = 3;
		function test()
		{
			global $a;
			echo $a;

			$c = $GLOBALS['b'];
			echo $c;
		}
			test();
	 ?>

22.静态变量 static
	用static定义的变量只初始化一次，再次运行时会记录上一次的值；

	例：<?php
	function add_self()
	 {
		static $a=1;
		echo $a;
	 }
	 add_self();		//1
	 add_self();		//2
	 add_self();		//3
	 add_self();		//4
	 add_self();		//5
	 ?>

23.内部函数的调用：
	1.加一个静态变量(标识判断是否被声明过,记得自增)；
	<?php
		function out()
		{
			#...;

			static $bFlag = 0;
			if ($bFlag == 0) {
				function in()
				{
					#...;
				}
			}
			$bFlag++;
		}
	 ?>

	2.用function_exit()判断是否被声明过；
	<?php 
		function out()
		{
			#...;
			
			if (!function_exists('in')){
				function in()
				{
					#...
				}
			}
		}
	 ?>

	3.用is_callable()判断是否能被调用；
	<?php
		function out()
		{
			#...;
			
			if (!is_callable('in')){
				function in()
				{
					#...;
				}
			}
		}
	 ?>

24.变量函数：
	function aaa(){};
	$a = aaa;
	$a();

	可以把一些复杂的功能提取出来
	<?php
		function calc($num1, $func, $num2)
		{
			return $func($num1, $num2)
		}
		function jia($num1, $num2)
		{
			return $num1 + $num2;
		}

		echo clac(1, 'jia', 2);
	 ?>


例子：
1.函数封装正反三角；
<?
	function printX($rows)
	{
		for ($k=1; $k <= $rows ; $k++) { 
			for ($i=1; $i < $k ; $i++) { 
				echo '&nbsp;';
			}
			for ($j=1; $j <= (2*$rows - 2*($i-1)-1); $j++) { 
				echo '*';
			}
			echo '<br />';
		}
	}
	printX(5);

	echo '<hr/>';
	function printXi($sum)
	{	
		echo '<table>';
		for ($k=1; $k <= ceil($sum/2) ; $k++) { 
			echo '<tr>';
			for ($i=$k; $i <= floor($sum/2); $i++) { 
				echo '<td></td>';
			}
			for ($j=1; $j <= $k*2-1; $j++) { 
				echo '<td>*</td>';
			}
			echo '</tr>';
		}
		echo '<table>';
	}
	printXi(11);
	 ?>

2.简单的计算器
<?php

//???????????????????????????????????????????????????????????????????????????????????????????????????????????????

 ?>



第十一天
25.回调函数
	call_user_func($func, $val)：
	小括号里面的就是回调函数,函数未定义则报错；
	例子。。。。。。。。。（等找个合适的。。。。。）
//???????????????????????????????????????????????????????????????????????????????????????????????????????????????



26.匿名函数
	1.没有名字的函数，使用时必须赋值给一个变量或者call_user_func()
	2.要调用外部变量时配合use使用
		1.use的外部变量值不传给匿名函数的形参；传递到匿名函数的内部；
		2.use外部的值在内部改变，只作用于函数内部（&符除外）；
	例子：
	<?php
		//匿名函数调用1
		$func = function()
		 {
			echo '赋值给变量,调用时变量名后加小括号';
		 }
		 $func();

		//匿名函数调用2
		call_user_func(function()
		 {
			echo '直接写在call_user_func()里';
		 });

		//匿名函数调用外部变量
		$a = '外部变量';
		$c = 1;
		$d = '后续不用我的值，用我的地址';		
		$fun = function($formal_parameter) use ($c, &$d){
			var_dump($formal_parameter);
			$c = '各是各的';
			var_dump($c);
			$d = '改值是因为取地址符';
			var_dump($d);
		 }
		 $fun($a);
		 var_dump($c);
		 var_dump($d);

	?>


27.递归函数
	递归：函数自己使用自己的算法成为递归；

	语法结构：由递归前进段、边界条件（包括调用自己）、递归返回段
		注意：位置可能会有变动；
	<?php //一般情况下的结构
		function digui($parameter)
		{
			递归前进段;

			（边界条件
				...
				if () {
					...;
					digui($parameter);	
			  	} else {
			  		...;
			  	}
			）

			递归返回段;
		}
		/*思维：1.函数由上自下执行；
			2.当条件成立调用自己之后，从头开始执行；
			3.调用后函数体_2部分未能执行，依次放入栈中等待；
			4.直至不调用自己之后，从栈中取出未执行的函数体_2依次执行；
		 */		
	 ?>
	
	例子：<?php
	function digui($i)
	 {	
		//函数体_1
		echo $i;

		//判断何时调用
		if($i>=0){
			digui(5);
		}else{
			echo '------<br />';	
		}

		//函数体_2
		echo $i;
	 }


	递归删除目录
	function rm($patch)
	 {
	 //递进:（打开目录；跳过两级特殊目录）
		 $dir = readdir($patch);
		 readdir($dir);
		 readdir($dir);

	 /*边界条件:
		 while判断是否循环路径：用 !== 来解决无法删除文件名为0的情况
		 拼接路径；
		 判断是否是文件；
			是文件删除；
			不是文件调用自己（注意参数）*/
		while(false !== ($newPath = readdir($dir))){
			$newPatch = $patch . '/' . $newPatch;		
			if (is_file($newPatch)) {
				unlink($newPatch);
			} else {
				rm($newPatch);
			}
		 }

	 //递回:(删除目录；关闭目录句柄)
		 rmdir($path);
		 closedir($patch);

	 }


	递归写累加
	function add($num) 
	 {	
		if($num == 1){
			return 1;
		} else {
			return $num + add($num-1);
	 	}
	 }
	(上面的解释语句：)
	function add($num) 
	 {
	 	//边界条件
		if($num == 1){
			echo 1 .'<br />';
	 	} else {
			echo $num .'+';		//递进段
			add($num-1);		

			//递出段：执行累加；				
	 	}
	 }

	?>


28.可变参数长度
	1.获取传入函数的所有实际参数（数组形式存储）
		func_get_args();	

	2.根据下标获取传入函数的值
		func_get_arg($num);

	3.获取传入函数的实际参数的总个数
		func_num_args();

	<?php  
		function args()
		{
			func_get_args();	
			//array = ['0'=>'1', '1'=>2, '2'=>'asd', '3'=>'例子']

			fun_get_arg(2);
			// 'asd'

			fun_num_args();
			// 4
		}
		args('1', 2, 'asd', '例子');
	 ?>


29.包含：
	1.include 一般情况下用它
		0.格式：include '文件路径';
		1.包含文件不存在报警告错误，后续代码执行；
		2.include_once();只能包含一次，重复写多次不报错；

	2.require
		0.格式：require '文件路径';
		1.包含文件不存在报致命错误，后续代码不执行；
		2.require_once();能对程序做判断，包含过了就不再包含，但是效率略低，重复写多次不报错；

	3.函数：include()

//???????????????????????????????????????????????????????????????????????????????????????????????????????????????


????
????
????
30.类型约束(php7.0下才可以执行)
	1.限定传入的参数
	<?php
		function sum(int $num1 , float $num2)
		{
			var_dump($num1, $num2);//int  float
			$sum = $num1 + $num2;	//float
			return $sum;			//float
		}
		sum(2, '2.4');		？？'2.4'行，'2.4ds'不行。。。。。
	 ?>

	2.限定返回值的类型
	<?php
		function sum($num1, $num2):string
		{
			var_dump($num1, $num2);	//原类型
			$num = $num1 + $num2;	 
			return $num;			//string
		}
		sum(1, 2.2);
	 ?>

	3.严格限定返回值类型。。。。。
	 <?php
	 	// 限定返回值的类型必须是设定的类型，全局有效
	 	declare(strict_types = 1); 

	 	function sum($num1, $num2):设定的类型
	 	{
	 		var_dump($num1, $num2);	//原类型
	 		$sum = $num1 + $num2;	//
	 		return $sum;
	 	}
	 	sum(1, 2.4);	//
	  ?>
????
????
????




第十二天
31.数组
	1.定义：一组数据的集合；
	2.包括：元素， 键=>值；(组成数组的最小单位)
	3.键就是你数组的值对应的下标，不允许有重复（重复的话后面的会覆盖前面的）
	4.值就是键对应的东西

32.数组的分类：
	1.索引数组
		1.下标是数字并且是连续的数字；
		2.数组的添加方式：
			$arr[] = 值;
			$arr[指定下标] = 值;
				注：下标一样值会被覆盖(修改)；
			array();
		3.数组的获取：
			var_dump($arr);
			echo $arr['指定下标'];
		4.删除元素：
			unset($arr['值对应的下标']);

	2.关联数组
		1.有指定的下标：
			$arr = [
					'a' => 1,
					'b' => 'hello',
					'c' => 'true'
					];
		2.获取值：
			echo $arr['指定下标'];
		3.添加元素：
			$arr['你要的下标'] = '值';
		4.删除元素：
			unset($arr['下标']);
		5.注意：
			1.关联数组中没有下标为数字时，添加不带下标的值时，默认下标为0；有数字的话在原来基础上+1；
			2.下标一般不设字符串形式的数字；会被转为int型的下标，往后添加不带下标的值时，下标在数字基础上+1；

	3.二维数组：
		$arr_0 = [1, 'a'=>2, 3];
		$arr = [
				array(1, 'a'),
				$arr0,
				array('a'=>1, 'c'=>'b')
			   ];

	4.多维数组：
		$arr_0 = [1, array(1, 'a'=>'a'), 2];
		$arr = [
				1,
				array(	'a', 
						array(1,3,2),
						$arr_0,
						$arr_0
					),
				3
			   ];

	例子：靠下标找值<?php


	?>


33.数组的遍历
	1.list只能用于索引数组
	例子：<?
		$arr = ['a', 'b', 'c'];
		list($one, $two, $three) = $arr;
		var_dump($one, $two, $three); 
	 ?>

	2.each返回既有关联又有索引(提供两对来选择)
	例子：<?
		$arr = ['键1'=>'值1', '键2'=>'值2'];
		var_dump(each($arr));
			/*array (size=4)
  				1 => string '值1' (length=4)
  				'value' => string '值1' (length=4)
  				0 => string '键1' (length=4)
  				'key' => string '键1' (length=4)*/

		var_dump(each($arr));
			/*array (size=4)
 				1 => string '值2' (length=4)
  				'value' => string '值2' (length=4)
  				0 => string '键2' (length=4)
  				'key' => string '键2' (length=4)*/

		var_dump(each($arr));
			//boolean false
	 ?>
	注意：走一次读一次，读完后返回null，适用于做条件来判断

	3.用while配合list和each可以把键值输出出来
	例子：<?
		$arr = ['a'=>'值1', 'b'=>'值2', 1];
		while(list($key, $value) = each($arr)){
				echo $key .'------'. $value .'<br/>';
		}
			/*
				a------值1
				b------值2
				0------1
			 */
		//注$key可以省略不写，但,必须保留
	 ?>

	4.foreach遍历
	例子：<?
		$arr = ['a'=>'值1', 'b'=>'值2', 1];
		foreach ($arr as $key => $value) {
			echo $key .'------'. $value .'<br/>';
		 }

		foreach ($arr as $value) {
			echo $value .'<br/>';
		 }
	 ?>
	

例子：用foreach和while-list-each分别遍历table并有限制条件；




第十三天
34.时间函数
	1.应用场景：
		帖子的发表时间回复时间，注册时间等等

	2.时间戳
		自1970年1月1日0是0分到现在的秒数

		获取当前时间的时间戳
			time();		无参数，为interface型的整数

		获取标准的时间格式：(由于时区的关系有八小时的误差；)
			date('Y-m-d H:i:s', '$tmie');
				常用形式，参数1内容可按需要更改，具体的查手册；
				第二个参数不传以即时的时间戳转换；

	3.调整时区
		0.获取当前时区：
			date_default_timezone_get();
		1.当前页面中：
			date_default_timezone_set('PRC');
		2.php.ini中修改设置
			date.timezone = 'PRC';

	4.其他常用时间函数<?
		//根据字符串时间(英文文本的时间)返回时间戳
		//部分参数可省略，时间从0来算
		strtotime('年-月-日 时:分:秒');

		//手动设置时间返回这个时间的时间戳
		//参数可以从右向左省略，任何省略的参数会被设置成本地日期和时间的当前值。 
		mktime(时, 分, 秒, 月, 天, 年);

		//获得日期的详细信息:
		//参数为时间戳形式，不写的话为即时时间
		getdate();

		//返回给出时间的具体信息
		//参数为str型的日期
		date_parse('2017-11-12 23:23:23');

		//检查由参数构成的日期的合法性；成功返回true，失败返回false
		checkdate(month, day, year);
	 ?>


35.错误处理
	1.错误级别：
		notice，warning，error
	2.产生错误：
		1.系统错误：代码错误；
		2.手动设置错误：trigger_error()
	3.抑制错误：
		1. @：单行抑制，
			抑制notice，warning级别的错误，但不能抑制致命错误；
		2.在php.ini中设置：
			display_errors=off关闭所有错误显示，开发时候均设为on；
		3.抑制一部分错误：error_reporting
			error_reporting(0)不报错
	4.配置相关：
		ini_get();	获取php.ini中配置的值
		ini_set();	设置php.ini中配置的值
	5.错误日志：
		1.是否生成错误日志：php.ini中找log_errors=on；
		2.生成的错误日志位置：php.ini中error_log='路径'；


36.url相关函数：<?
	//将url的参数字符串转换变量
	$str = 'name=ss&pwd=123';
	parse_str($str);
	echo $name;

	//解析url，返回其组成成分
	$url = 'http://www.baidu.com:80/index.html?username=cc&sex=2';
	var_dump(parse_url($url));
	/*
	array (size=5)
  		'scheme' => string 'http' (length=4)
  		'host' => string 'www.baidu.com' (length=13)
 		'port' => int 80
 	 	'path' => string '/index.html' (length=11)
  		'query' => string 'username=cc&sex=2' (length=17)
	 */


  	//将数组形式的键值对转化为URL参数
	$arr = ['username'=>'zz','pwd'=>123];
	echo http_build_query($arr);

	//编码url字符串
	echo urlencode('看不懂啊') .'<br/>';

	//解码url字符串
	echo urldecode('%E7%9C%8B%E4%B8%8D%E6%87%82%E5%95%8A');

	//使用MIME base64对数据进行编码
	echo base64_encode($str);
	
	//使用MIME base64对数据进行解码
	echo base64_decode($str);
	
	//对变量进行json编码
	$arr = ['name'=>'aa', 'sex'='0', 'age'='18'];
	echo json_encode($arr);
	//{"name":"aa", "sex":"0", "age":"18"}
	
	//对json格式的字符串进行编码,
	//第二参数为true返回数组，否则返回对象
	$str='{"name":"aa", "sex":"0", "age":"18"}'
	echo json_decode($str);

	?>












































第十三天
1.超全局数组：
	1.$_GET
		表单里面用get 发送，就用$_GET接收
		get是通过url地址传参；
	2.$_POST
		表单里你用post发送你就用$_POST获取
		post是通过header头取发送数据的
			<?//页面中查看post传输的数据：?>
	3.$_REQUEST
		可以接收get也可以接收post；
		一般用什么传就用什么接收

	三者的区别：
				$_GET 										$_POST
	从指定资源请求数据(访问结果幂等的)			向指定资源提交被处理的数据
	url传参(一个TCP数据包)						header头传参(两个TCP数据包)
	不改变服务器端的数据						可能改变服务器端的数据(比如发帖之后刷新显示)
	安全性不高(密码等不用)						安全性相对较高
	可被缓存，被收藏作为书签					不能被缓存，不能被作为书签

		$_REQUEST支持的$_GET和$_POST两种传值方式，显示看用什么方式传值



