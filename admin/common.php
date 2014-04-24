<?php 
  include '../include/func.php';
	include '../config.php';
	//统一网址
	define('URL','http://'.dirname($_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']).'/');

	//统一文件处理路径
	define('PATH',str_replace('\\','/',dirname(__FILE__)).'/');

	//session开启
	session_start();

	//设置字符集
	header("content-type:text/html;charset=utf-8");

	//设置时区
	date_default_timezone_set('PRC');

	//连接数据库

	$link=mysql_connect(HOST,USER,PWD);

	if(mysql_errno()>0)exit(mysql_error());

	mysql_set_charset(CHAR);

	mysql_select_db(DB);

	//管理员登录判断

	/*if (basename($_SERVER['SCRIPT_NAME'])!='action.php') {
		if (empty($_SESSION['admin'])) {
			echo '<div class="">非法登录!! 3秒后返回</div><meta http-equiv="refresh" content="3;url=',URL,'login.php"/>';
			exit;
		}
	}*/