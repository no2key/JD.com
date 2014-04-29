<?php 
	include '../common.php';

	$pid = (int)$_GET['pid'];
	$opath = $_GET['path'];

	if(empty($_GET['path'])){
		$path = '0,';
	}else{	//如果添加的不是一级分类
		$path = $_GET['path'];

		$path = $path.$pid.',';
		
	}
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
 	<title>Document</title>
 	<link rel="stylesheet" href="<?php echo dirname(URL)?>../css/admin.css">
 </head>
 <body class="main">
 	
 	<form action="./action.php?list=cateadd" method="post">
 			<input type="hidden" name="pid" value="<?php echo $pid ?>"/>
			<input type="hidden" name="path" value="<?php echo $path ?>"/>
			<input type="hidden" name="opath" value="<?php echo $opath ?>"/>
 		添加分类名称:
 			<input type="text" name="name">
 			<input type="submit" value="添加分类">

 	</form>
 </body>
 </html>