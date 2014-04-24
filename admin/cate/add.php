<?php 
	include '../common.php';

	$pid = (int)$_GET['pid'];

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
 </head>
 <body>
 	
 	<form action="./action.php?list=add" method="post">
 			<input type="hidden" name="pid" value="<?php echo $pid ?>"/>
			<input type="hidden" name="path" value="<?php echo $path ?>"/>
 		添加分类名称:
 			<input type="text" name="name">
 			<input type="submit" value="添加分类">

 	</form>
 </body>
 </html>