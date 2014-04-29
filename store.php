<?php 
	include 'common.php';
	$id=$_GET['id'];//获取ajax发送的问题id或者问题名称
	$sql="select num from goods where id='$id'";
	$num=query($sql);
	$num=$num[0];
	//print_r($num);

	$answer=$num['num'];
	echo $answer;
