第20天
1.正则表达式：
 0.组成：定界符、原子、元字符、模式修正符

 1.定界符：除了a-z,A-Z,0-9,\,空格之外
 	一般使用/或者%；

 2.原子：
 	 组成正则表达式的最小单位

 	 \d: 0-9；
 	 \D: 非0-9；
 	 \w: 0-9,a-z,A-Z,_
 	 \W: 非0-9,a-z,A-Z,_
 	 \s: 一切空格
 	 \S: 非一切空格
 	 \b: 词边界 (\basd:表示以asd开头，asd\b:表示以asd结尾)
 	 \B: 非词边界
 	 []: 原子列表，匹配括号中任意一个原子
 	 [^]: 放在列表中位于原子前面表示取反的意思
 	 . : 匹配除\n \r \t以外的所有

 3.元字符：
 	 * : 任意次
 	 + : 至少一次
 	 ? : 至多一次
 	 {}: 指定次数
 	 	 {m,n}: 重复m到n次,闭区间
 	 	 {m,} : 重复至少m次
 	 	 {n}  : 指定n次
 	 	 {0,n}: 最多n(包含)次
 	 ^ : 写在外面且在开头表示以指定字符开头
 	 \A: 写在开头，表示以指定字符开头
 	 $ : 写在末尾，表示以指定字符结尾
 	 \Z: 写在末尾，表示以指定字符结尾
 	 | : 或，表示有最低的优先级
 	 (): 子模式（用来限制优先级）

 4.模式修正符：
 	 对正则表达式的限定和修饰，写在正则表达式的后面

 	 i: 不区分大小写
 	 m: 多行模式
 	 s: 让.能匹配\n
 	 x: 忽略正则表达式中的空格
 	 A: 表示以指定字符开头
 	 U: 禁用正则表达式中的贪婪模式

 	 贪婪模式：正则表达式匹配成功的时候尽可能的多匹配

 5.特殊组合：
 	 .* : 贪婪模式打印输出结果
 	 .*?: 取消(任意次数的)贪婪模式
 	 .+?: 取消(至少一次的)贪婪模式

 	 .*?和.+?的区别：
 	 	.*? 匹配0次或者1次
 	 	.+? 至少要匹配一次，不能为0

 6.函数<?php
 	 //preg_match()的二维模式,匹配所有符合的情况，取消贪婪模式下(有括号)也能出全部
 	 preg_match_all(pattern, str, matches)

 	 //与str_place类似，替换str中所有符合patten的情况
 	 preg_replace(pattern, replacement, str)

 	 //执行一个正则表达式搜索并且使用一个回调进行替换(返回值为数组)
 	 preg_replace_callback(pattern, 'callback', str)

 	 //通过一个正则表达式分割字符串为数组
 	 preg_split(pattern, str)

 	 //转译正则表达式字符（特殊字符有：. \ + * ? [ ] ^ $ ( ) { } = ! < > | : - ）
 	 preg_quote(str)
 	 ?>

2.常用正则表达式<?php
	邮箱：'/\w*@\w*.com$/';

	手机号码：'/^(138|158|183|187)\d{8}$/';

	网址：'/^((http|https):\/\/)?w{3}\.(\w+\.){0,}\w+\.(com|cn|top)$/';

	匹配ip地址：

	账号（字母开头，允许5至16字节，允许字母数字下划线)：

	匹配国内电话号码（0511-4405222 或 021-87888822）：
	?>



第21天
3.TPL模板引擎
 0.前期准备：
	⑴a.html界面：
		①变量,关键字部分为{}包裹，
		②其余html样式不变
		<!-- 例：<p>{title}<p>，{if $var}，{/foreach}等... -->

	⑵a.php(同名)文件：
		①包含模板文件，
		②处理需要传到html界面的值，
		③调用模板函数，传值

	⑶tpl.php：写模板函数处理;
 
 1.tpl.php
	核心思想：
		1.把{}的样式转化为符合php语法格式的样式；
		2.替换完成后要生成一个缓存文件；
		3.包含(include)生成的缓存文件；
	完善部分：


<?php
 function display($tplFile, $tplVars, $isInclude)
 {
  	//检测文件是否存在
  	if (!file_exists($tplFile)) {
  		exit('模板文件不存在');
  	}

  	//编译文件替换
  	$contents = compile($tplFile);

  	//改名生成缓存文件
  	$savePath = str_replace('.', '_', $tplFile) .'.php';

  	//往缓存文件写入内容
  	$contents = file_put_contents($savePath, $contents);

  	//处理传入的值
  	if (is_array($tplVars)) {
  		extract($tplVars);
  	}

  	//包含(include)缓存文件
  	if ($isInclude) {
  		include $savePath;
  	}
 }

 function compile($file)
 {
 	//打开文件
 	$contents = file_put_contents($file);

 	//写规则(数组形式)
 	$keys = [
 		'{$%%}' => '<?=$\1>',
 		'{if %%}' => '<?php ?>',
 		'{else if %%}' => '<?php elseif (\1): ?>',
 		'{elseif %%}' => '<?php elseif (\1): ?>',
 		'{/if}' => '<?php endif; ?>',
 		'{foreach %%}' => '<?php foreach (\1): ?>',
 		'{/foreach}' => '<?php endforeach; ?>',
 		'{include %%}' => '看下面',
 		];

 	//foreach数组
 	foreach ($keys as $key => $value) {
 		//加转译符
 		$key = preg_quote($key, '#');

 		//拼完整的$patten
 		$pattern = '#'. str_replace('%%', '(.*)', $key) .'#';

 		//替换文本内容(注意include问题)
 		if (stripos($key, 'include')) {
 			$contents = preg_replace_callback($pattern, 'dealInclude', $contents);
 		} else {
 			$contents = preg_replace($pattern, $values, $countents);
 		}
 	}
 	//return
 	return $countents;
 }

 function dealInclude($matches)
 {
 	//除去文件名两端的引号
 	$file = trim($matches[1], '\'"');

 	//调用display
 	display($file, null, false);

 	//重名为缓存文件(为了后面的return，display()中有但是上面的写法没调出来)
 	$cachePath = str_replace('.', '_', $file) .'.php';

 	//return缓存文件(符合php语法)
 	return "<?php include '$cachePath'; ?>"
 }
 注意事项：1.生成缓存文件注意拼接'.php';
 		2.display()的最后一步是包含缓存文件，不是return，return的话不显示任何东西；
 		3.compile()中规则$keys[]中的键值对后面接逗号；
 		4.$keys[]中 {else if %%} 对应替换的形式为 elseif ，值写法中不能用空格隔开；
 		5.compli()中规则的拼接和替换都是在 foreach 内完成的，然后foreach外return；
 		6.dealInclude()的形参实质是回调函数的特性（返回值），留意取下标；
 		7.dealInclude()的最后一步是 return 符合php语法格式的 include 缓存文件；

 ?>

4.gd库
 0.概述：php的扩展模块；
 	主用于：验证码，数据统计图，水印，缩放；

 1.图像处理六步骤<?php
	 1.创建画布
	 	$img = imagecreatetruecolor(width, height);

	 2.创建颜色
	 	$light = imagecolorallocate(image, red, green, blue);

	 3.图像处理
	 	............

	 4.设置header（告知类型）
	 	header('Content-Type:image/png');

	 5.发送或者保
	 	imagepng(image)  或者  imagepng(image, '路径');

	 6.销毁资源
	 	imagedestroy(image);
 	 ?>

 2.图像处理常用函数<?php
 	 //填充背景色
 	 imagefill(image, x, y, color);

 	 //一个像素点
 	 imagesetpixel(image, x, y, color);

 	 //一条线
 	 imageline(image, x1, y1, x2, y2, color);

 	 //一个空心矩形
 	 imagerectangle(image, x1, y1, x2, y2, color);

 	 //一个实心矩形
 	 imagefilledrectangle(image, x1, y1, x2, y2, color);

 	 //圆弧
 	 imagearc(image, cx, cy, width, height, start, end, color);

 	 //填充的圆弧
 	 imagefilledarc(image, cx, cy, width, height, start, end, color, style);

 	 //一个空心椭圆
 	 imageellipse(image, cx, cy, width, height, color);

 	 //实心椭圆
 	 imagefilledellipse(image, cx, cy, width, height, color);

 	 //多边形(边框)
 	 imagepolygon(image, points, num_points, color);

 	 //写入字符
 	 imagechar(image, font, x, y, c, color);

 	 //写入汉字
 	 imagettftext(image, size, angle, x, y, color, fontfile, text);
  ?>


第22天
5.随机产生验证码内容的几种方式
	思路：非汉字：range出范围，打乱，拼接，取出字符串中的一部分(substr、array_slice、array_chunk);
		  汉字：链接偏旁(176~214)和非偏旁(161~254)组成一个汉字，return iconv('gbk','utf-8',$str) 转码；
<?php
 function randString($len, $type)
  {
   	  switch ($type) {
   		case 0:
   			return randNum($len);
   		case 1:
   			return randAlpha($len);
   		case 2:
   			return randMixed($len);
   		case 3:
   			return randChinese($len);
   		}
  }

 function randNum($len)
  {

  }
 function randAlpha($len)
  {

  }
 function randMixed($len)
  {

  }
  function randChinese($len)
  {

  }
 ?>

6.封装验证码<?php
 1.创建画布
 2.准备颜色
 3.处理图片
     1.填充背景色
     2.生成字符
     3.传入字符（for）
 	  1.设置横向位置坐标x
 	  2.为汉字的情况
 	 	 1.设置字体的大小（高）
 	  	 2.处理纵向位置坐标y
 	  	 3.处理角度
 	  	 4.mb_substr取出汉字
 	  	 5.imagettftext写入汉字
 	  3.为字符的情况
 	  	 1.处理纵向位置坐标y
 	  	 2.imagechar写入字符
     4.添加干扰点 
     5.添加干扰线或圆弧（注意处理参数）
 4.设置header（告知类型）
 5.发送或保存
 6.销毁资源
 7.return验证码
 ?>



第23天
7.水印<?php  
	1.打开大、小图（openImg()）
	2.获取大、小图的宽高（用于计算位置，list）
	3.计算位置问题（1~9 或者随机）
		1.设置横向位置坐标x
		2.设置纵向位置坐标y
	4.imagecopymerge合并图
	5.拼接路径
		1.处理路径（参数传来的）
		2.重命名水印图
		3.处理后缀（参数传来的）
		4.拼接完整路径（形参中+重命名+后缀）
	6.用imgXXX保存文件（注意jpg的情况）
	7.释放大图，小图资源
	8.return绝对路径

	9.openImg()中：
		// 注意：bmp类型的mime为x-ms-bmp，处理的话需要转化类型，不能用函数 imagecreatefromwbmp()打开
	  方法一：
		  1.由 getimagesize() 获取图像信息
		  2.用 image_type_to_extension() 获取文件后缀（下标2，不用考虑转化）
		  3.return imagecreatefromXXX() 打开的图片
	  方法二：
		  1.由 pathinfo() 获取图像信息
		  2.由下标获取文件后缀（extension）
		  3.用 imagecreatefromXXX() 打开图片（注意jpg的情况）
		  4.return 打开的图像

 ?>
	

8.文件操作函数<?php
 1.路径相关的函数
  	 //解析详细的路径
  	 pathinfo(path);
  	  /*var_dump(pathinfo('./asd/fgh/a.php'));
		  array (size=4)
  			'dirname' => string './asd/fgh' (length=9)
  			'basename' => string 'a.php' (length=5)
  			'extension' => string 'php' (length=3)
 			'filename' => string 'a' (length=1) */

  	 //获取文件的详细名字
  	 basename(path);

  	 //获取路径名
  	 dirname(path);

  	 //转换为绝对路径的目录
  	 realpath(path);

  	 //目录分割符（\）
  	 DIRECTORY_SEPARATOR
 
 2.文件内容整体操作的函数
  	 //获取文件的内容
  	 file_get_contents(file);

  	 //写入文件内容
  	 file_put_contents(file, contents);

  	 //读取文件，返回值为全文字节总数
	 readfile(file); 

 3.具体操作函数
	 //打开文件，返回值为资源句柄($handle)
	 fopen(filename, mode)
		 /*[
			r : 只读方式打开，文件不存在报错
			r+: 读写方式打开，覆盖写，文件不存在报错
			w : 只写方式打开，覆盖写，文件不存在创建
			w+: 读写方式打开，覆盖写，文件不存在创建
			a : 只写方式打开，追加(append)写，文件不存在创建
			a+: 读写方式打开，追加(append)写，文件不存在创建
			x : 创建文件以只写方式打开，指针指向文件头，文件存在报错
			x+: 创建文件以读写方式打开，指针指向文件头，文件存在报错
	  	 ]*/

	 //读取指定长度的字节数
	 fread(handle, length);
		/*注意：当句柄为以w+模式打开时无效*/

	 //写入指定的位置
	 fwrite(handle, length);

	 //关闭资源
	 fclose(handle);

	 //读取一个字符
	 fgetc(handle);
		/*等价于fread($fp,1);*/

	 //读取一行数据
	 fgets(handle);

	 //读取一行数据，并过滤掉html标签
	 fgetss(handle);
	
 4.文件指针
	 //将文件指针指向开头
	 rewind(handle);

 	 //设置指针到指定位置
 	 fseek(handle, offset);

 	 //获取当前指针的位置(无操作为0,在开头)
 	 ftell(handle);

 	 //判断指针是否在结尾(禁用)
 	 feof(handle);

 5.文件判断相关
 	 //判断文件是否存在
 	 file_exists(filename);

 	 //判断是否是文件
 	 is_file(filename);

 	 //判断是否是目录
 	 is_dir(filename);

 	 //判断文件是否可读
 	 ia_readable(filename);

 	 //判断文件是否可写
 	 is_writeable(filename);

 6.文件整体相关
 	 //设置文件修改时间为当前
 	 touch(filename);

 	 //复制文件
 	 copy(old_path, new_path);

 	 //重命名文件(新名字不写路径就保存在当前目录下，原文件消失)
 	 rename(oldname_path, newname_path);

 	 //删除文件
 	 unlink(filename);

 7.目录相关
 	 //创建目录
 	 mkdir(pathname)
 	 
 	 //重命名目录
 	 rename(oldname, newname)
 	 
 	 //删除目录
 	 rmdir(dirname);

 	 //打开目录
 	 opendir(path);

 	 //关闭目录
 	 closedir([$path]);

 	 //读取目录(每个目录下面都有.和..两级目录)
 	 readdir([$path]);
 	 
 	 //浏览目录(只浏览显示下一级的所有内容)
 	 scandir(directory);

 8.文件属性相关
 	 //获取文件大小信息
 	 filesize(filename);

 	 //获取文件类型
 	 filetype(filename);

 	 //获取创建的时间
 	 filectime(filename);

 	 //获取修改的时间
 	 filemtime(filename);

 	 //获取访问的时间
  	 fileatime(filename);

 9.文件锁定flock
 	 LOCK_SH //共享
 	 LOCK_EX //锁定
 	 LOCK_UN //释放

 	例：访问次数
 	 if (file_exists('count.text')) {
 	 	 //打开文件
 	 	 $fp = fopen('count.text', 'r+');
 	 	 //开启共享
 	 	 flock($fp, LOCK_SH);
 	 	 //读取次数（）
 	 	 $num = fread($fp, 1000);
 	 	 $num += 1;
 	 	 //锁定
 	 	 flock($fp, LOCK_EX);
 	 	 //文件操作（写入次数）
 	 	 fwrite($fp, $num);
 	 	 //文件共享
 	 	 flock($fp, LOCK_SH);
 	 	 //文件关闭
 	 	 file_close($fp);

 	 	 echo "第 $num 次访问";

 	 } else {
 	 	 //第一次创建文件(含有共享的意思)
 	 	 $fp = fopen('count.text', 'w+');
 	 	 //锁定
 	 	 flock($fp, LOCK_EX);
 	 	 //文件操作（写入次数）
 	 	 fwrite($fp, 1);
 	 	 //释放（可以不用关闭）
 	 	 flock($fp, LOCK_UN);

 	 	 echo '第一次创建并访问文件';
 	 }
 ?>

 10.文件权限
 	 0.权限分类
 	 	可读权限：4；100
 	 	可写权限：2；010
 	 	执行权限：1；001
 	 	（7 = 4 + 2 + 1）

 	 chomd()：设置权限
 	 	 第一位：八进制标识 0
 	 	 第二位：所有者:chwon（1~7）
 	 	 第三位：所数组:charp（1~7）
 	 	 第四位：其他人（1~7）
		

	 	













 ?>