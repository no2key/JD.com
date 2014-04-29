<?php 
	//session开启
	session_start();
	$_SESSION['admin']['id']=5;

	//设置字符集
	header("content-type:text/html;charset=utf-8");

	//设置时区
	date_default_timezone_set('PRC');

	//统一网址
	define('URL','http://'.dirname($_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']).'/');

	//统一文件处理路径
	define('PATH',str_replace('\\','/',dirname(__FILE__)).'/');

	include PATH.'config.php';
	include PATH.'include/func.php';
	
	//连接数据库

	$link=mysql_connect(HOST,USER,PWD);

	if(mysql_errno()>0)exit(mysql_error());

	mysql_set_charset(CHAR);

	mysql_select_db(DB);