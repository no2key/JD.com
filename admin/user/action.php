<?php 
	include '../common.php';
	$action=$_GET['list'];
	switch($action){
		case 'statue';
			$statue=$_GET['statue']==1?0:1;
			$id = $_GET['id'];
			$sql="update user set statue='$statue' where id = '$id'";
			if (mysql_query($sql)) {
				echo '<div style="margin:0 auto; border:1px solid #ccc; text-align:center; width:200px; height:120px;">修改成功,3秒后返回!!<p>立即返回</p></div><meta http-equiv="refresh" content="1;url='.$_SERVER['HTTP_REFERER'].'"/>';
			}else{
				echo '修改失败';
			}
		break;
		case 'edit';
			$

		break;
	}
