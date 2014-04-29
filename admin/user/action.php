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
			$id=post('id');
			$emile=post('emile');
			$birth=post('birth');
			$birth1=post('birth1');
			$birth2=post('birth2');
			$sex=post('sex');
			$tel=post('tel');
			$add=post('address');
			$statue=post('statue');
			$admin=post('admin');
			$file=post('path');

			$time=mktime(0,0,0,$birth1,$birth2,$birth);
			$sql="select admin from user where id=".$_SESSION['admin']['id'];
			$power=query($sql);
			foreach ($power as $val) {
				$min=$val['admin'];
			}
			if ($admin < $min) {
					echo '权限不足,无法更改所属权限<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/>';
					exit;
			}
			if ($_FILES['pic']['error']==0) {

					$link =PATH.'../upload/';
					$link .=substr($file,0,4).'/';
					$link .=substr($file,4,2).'/';
					$path[]=$link.$file;
					$path[]=$link.'50_'.$file;
					$path[]=$link.'120_'.$file;
					foreach($path as $val){
						if (file_exists($val)) {
							unlink($val);
						}
					}
				if($file_path=upload('pic',PATH.'../upload')){
							$path=dirname($file_path);
							$file=basename($file_path);
					//缩放一个50*50的图片
					if (!zoom($file_path,$path,'50_'.$file,50,50) ) {	
							echo '缩放失败<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/> ';
							exit;
					}
					if (!zoom($file_path,$path,'120_'.$file,120,120) ) {	
							echo '缩放失败<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/> ';		
							exit;
					}
					unlink($file_path);
				}

				}else{
						echo '编辑失败<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/>';
						exit;
				}

				$sql="update user set icon='$file', email='$email', birth='$time',sex='$sex',tel='$tel', address='$add',statue='$statue' where id='$id' ";

					if(update($sql)){
						echo '修改成功<meta http-equiv="refresh" content="1;url='.$_SERVER['HTTP_REFERER'].'"/>';
					}else{
						echo '修改失败<meta http-equiv="refresh" content="1;url='.$_SERVER['HTTP_REFERER'].'"/>';				
					}	

		break;
	}
