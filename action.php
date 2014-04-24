<?php 
	include 'common.php';

	$action=$_GET['list'];
	
	switch($action){
		case 'reg':
		//用户名不为空
		  $name=$_POST['name'];
			$name=htmlspecialchars(trim($name));
			if ($name =='') {
				echo '<div style="margin:100px auto 0 ; padding:5px; border:1px solid #ccc; text-align:center; width:200px; height:120px;">用户名不能为空<div><meta http-equiv="refresh" content="3;url='.$_SERVER[HTTP_REFERER].'"/>';
				exit;
			}
			$sql="select id from user where name='$name'";
			$result=mysql_query($ck);
			if ($re && mysql_num_rows($result)>0) {
				echo '<div style="margin:100px auto 0 ; padding:5px; border:1px solid #ccc; text-align:center; width:200px; height:120px;">此用户已存在</div><meta http-equiv="refresh" content="3;url='.$_SERVER[HTTP_REFERER].'"/>';
				exit;
			}
			$pwd=$_POST['password'];
			$repwd=$_POST['pwdRepeat'];
		//密码不相同
			if ($pwd != $repwd) {
				echo '<div style="margin:100px auto 0 ; padding:5px; border:1px solid #ccc; text-align:center; width:200px; height:120px;">两次密码输入不相同</DIV><meta http-equiv="refresh" content="3;url='.$_SERVER['HTTP_REFERER'].'"/>';
				exit;
			}
			//密码复杂度
			if(!preg_match('/[0-9]/',$pwd)||!preg_match('/[a-zA-Z]/',$pwd)){
				echo '密码太简单<meta http-equiv="refresh" content="3;url='.$_SERVER['HTTP_REFERER'].'"/>';
				exit;
			}
			//邮箱验证
			/*$email=$_POST['email'];
				if(!preg_match('/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/',$email)){
					echo '00000000000000';
					exit;
			}*/
			$yzm=$_POST['yzm'];
			$pwd=md5($pwd);
			$time=time();
			$statue= 1 ;
			$sql= "insert into user(name,password,reg_time,statue)
				values('$name','$pwd','$time','$statue')";

			 $result=mysql_query($sql);

			if (mysql_insert_id()>0) {
				$_SESSION['home']['id']=mysql_insert_id();
				$_SESSION['home']['name']=$name;
				echo '注册成功<meta http-equiv="refresh" content="3;url='.URL.'index.php"/>';
			}else{
				echo '注册失败<meta http-equiv="refresh" content="3;url='.$_SERVER['HTTP_REFERER'].'"/>';
				exit;
			}
		break;
		case 'log';
			$name=$_POST['name'];
			$name=htmlspecialchars(trim($name));
			$pwd=md5($_POST['password']);
			$logtime=time();
			$sql="select id,name,statue from user where name='$name'and password='$pwd'";
			$result=mysql_query($sql);
			$ip=$_SERVER['REMOTE_ADDR'];
			if ($result && mysql_num_rows($result)>0) {
				$row =mysql_fetch_assoc($result);
				if ($row['statue'] == 0) {
					echo '<div style="margin:100px auto 0 ; padding:5px; border:1px solid #ccc; text-align:center; width:200px; height:120px;">此账号已被和谐处理!!!</div><meta http-equiv="refresh" content="3;url='.$_SERVER['HTTP_REFERER'].'"/>';
					exit;
				}
				$sql="update user set log_time='$logtime' last_ip='$ip' where name = '$name'";
				$result=mysql_query($sql);
				$_SESSION['home']['id']=$row['id'];
				$_SESSION['home']['name']=$row['name'];
				echo '<div style="margin:100px auto 0 ; padding:5px; border:1px solid #ccc; text-align:center; width:200px; height:120px;">登录成功</div><meta http-equiv="refresh" content="3;url='.URL.'index.php"/>';
				
			}else{
				echo '登录失败<meta http-equiv="refresh" content="3;url='.$_SERVER['HTTP_REFERER'].'"/>';
			}

		break;
		case 'quit';
			unset( $_SESSION['home']);

			header('location:'.$_SERVER['HTTP_REFERER']);

		break;
	}

	//手动关掉数据库连接
	mysql_close($link);
