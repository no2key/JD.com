<?php include '../common.php';?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=utf-8">
		<title>后台管理页面</title>
			<link rel="stylesheet" href="../css/admin.css"/>
	</head>
	
		<frameset rows="120,*" frameborder="0">
			<frame name="top" src="top.php"/>
			<frameset cols="200,*">
				<frame name="menu" src="menu.php"/>
				<frame name="main" src="main.php"/>
		  </frameset>
		</frameset>
	
</html>