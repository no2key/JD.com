<?php 
	include 'common.php';

	$action=$_GET['list'];
	
	
	
	
	
	switch($action){
		case 'reg':
		//用户名不为空
		  $name=$_POST['name'];
			$name=htmlspecialchars(trim($name));
			if ($name == '') {
				echo '用户名不能为空<meta http-equiv="refresh" content="3;url='.$_SERVER[HTTP_REFERER].'"/>';
				exit;
			}
			$pwd=$_POST['password'];
			$repwd=$_POST['pwdRepeat'];
		//密码不相同
			if ($pwd != $repwd) {
				echo '两次密码输入不相同<meta http-equiv="refresh" content="3;url='.$_SERVER['HTTP_REFERER'].'"/>';
				exit;
			}
			//密码复杂度
			if(!preg_match('/[0-9]/',$pwd)||!preg_match('/[a-zA-Z]/',$pwd)){
				echo '密码太简单<meta http-equiv="refresh" content="3;url='.$_SERVER['HTTP_REFERER'].'"/>';
				exit;
			}
			//邮箱验证
			$email=$_POST['email'];
				if(!preg_match('/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/',$email)){
					exit;
			}
			$yzm=$_POST['yzm'];
			$pwd=md5($pwd);
			$time=time();
			$sql= "insert into user(name,password,reg_time)
				values('$name','$pwd','$time')";

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
			$sql="select id,name from user where name='$name'and password='$pwd'";
			$result=mysql_query($sql);
			if ($result && mysql_num_rows($result)>0) {
				$row =mysql_fetch_assoc($result);
				$_SESSION['home']['id']=$row['id'];
				$_SESSION['home']['name']=$row['name'];
				echo '登录成功<meta http-equiv="refresh" content="3;url='.URL.'index.php"/>';
				
			}else{
				echo '登录失败<meta http-equiv="refresh" content="3;url='.$_SERVER['HTTP_REFERER'].'"/>';
			}

		break;
	}

	//手动关掉数据库连接
	mysql_close($link);
