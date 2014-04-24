<?php 
	include '../common.php';

	$param= $_GET['list'];

	switch($param){
		case 'add';
			$pid = $_POST['pid'];
			
			$path = $_POST['path'];

			$name = $_POST['name'];

			if(empty($name)){
				echo '分类名称不能为空<meta http-equiv="refresh" content="1;url='.$_SERVER['HTTP_REFERER'].'"/>';
				exit;
			}

			$sql = "insert into cate(name,pid,path) values('$name','$pid','$path')";

			$result = mysql_query($sql);

			if($result && mysql_insert_id()>0){
				echo '添加成功<meta http-equiv="refresh" content="1;url=index.php?pid='.$pid.'"/>';
			}else{
				echo '添加失败<meta http-equiv="refresh" content="1;url='.$_SERVER['HTTP_REFERER'].'"/>';
			}


		break;
		case 'edit':

		break;
		case 'del':
		$id=$_GET['id'];
		$sql= "select id from cate where pid ='$id'";
		if (mysql_num_rows(mysql_query($sql))>0) {
			echo '此目录下还有文件,不能删除<meta http-equiv="refresh" content="1;url='.$_SERVER['HTTP_REFERER'].'"/>';
			exit;
		}
		$sql="delete from cate where id='$id'";
		$result=mysql_query($sql);
		if (mysql_affected_rows()) {
			echo '删除成功<meta http-equiv="refresh" content="1;url='.$_SERVER['HTTP_REFERER'].'"/>';
		}else{
		echo '删除失败<meta http-equiv="refresh" content="1;url='.$_SERVER['HTTP_REFERER'].'"/>';
		}
		break;
	}

	mysql_close($link);
 ?>