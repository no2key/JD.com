<?php
	include '../common.php';
	
	$a = $_GET['a'];

	switch($a){
		case 'del':
				$id=get('gid');
				$sql="select name from goods_img where id='$id'";
				$list=query($sql);
				$list=$list[0];

					$link  =PATH.'../upload/';
					$link .=substr($list['name'],0,4).'/';
					$link .=substr($list['name'],4,2).'/';

					$path[]=$link.$list['name'];
					$path[]=$link.'62_'.$list['name'];
					$path[]=$link.'180_'.$list['name'];
					$path[]=$link.'450_'.$list['name'];
					
					foreach ($path as $val) {
						var_dump($val);
						if (file_exists($val)) {
							unlink($val);
						}
					}
					exit;
				$sql="delete from goods_img where id='$id'";
				if (update($sql)) {
					echo '删除成功<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/>';
				}else{
					echo '删除失败<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/>';
				exit;

				}

		break;
		case 'edit';
			$id=post('id');
			$name=post('name');
			$cate=post('cate_id');
			$price=post('price');
			$num=post('num');

			$sql="update goods set name='$name',cate_id='$cate',price='$price',num='$num' where id='$id'";
			if (update($sql)) {
				echo '编辑成功<meta http-equiv="refresh" content="2,url='.$_SERVER['HTTP_REFERER'].'"/>';
			}
			break;
		case 'face';
			$id=get('id');
			$gid=get('gid');
			$is_face=get('is_face');
			$is_face=$is_face==1?0:1;

			$sql="update goods_img set is_face='$is_face' where id='$id'";
		  $sql1="update goods_img set is_face = '0' where id!='$id' and goods_id='$gid'";

			if (update($sql) && update($sql1)) {
				header('location:'.$_SERVER['HTTP_REFERER']);
				exit;
			}else{
				echo '修改失败<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/>';
				exit;
			}
			break;
		case 'deimg':
			$id=post('id');
			//2.判断用户有没有图片上传,
			
			if($_FILES['pic']['error']==4){
					echo '请上传图片<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/>';
					exit;
			}

			//2.1如果有要先执行文件上传，文件上传成功后，先执行缩放
			
			if($file_path=upload('pic',PATH.'../upload')){

						$path=dirname($file_path);
						$file=basename($file_path);
				//缩放一个62*62的图片
				if (!zoom($file_path,$path,'62_'.$file,62,62) ) {	
						echo '缩放失败<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/> ';		
						exit;
				}
				//缩放一个为180*255的图片
				if (!zoom($file_path,$path,'180_'.$file,180,255) ) {	
						echo '缩放失败<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/> ';		
						exit;
				}
				//缩放一个120*120的图片
				if (!zoom($file_path,$path,'450_'.$file,450,680) ) {	
						echo '缩放失败<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/> ';		
						exit;
				}

						$sql="insert goods_img(goods_id,name,is_face)values('$id','$file','0')";

						if(insert($sql)){
							
							echo '添加成功<meta http-equiv="refresh" content="1;url='.$_SERVER['HTTP_REFERER'].'"/>';

						}else{

							echo '添加失败<meta http-equiv="refresh" content="1;url='.$_SERVER['HTTP_REFERER'].'"/>';
						
						}	
				
			}else{
				//图片上传失败
				echo '上传失败<meta http-equiv="refresh" content="3;url='.$_SERVER['HTTP_REFERER'].'"/>';
				exit;
			}		
			break;
		case 'new';
			$id=get('id');
			$is_new=get('is_new');
			$is_new=$is_new==1?0:1;

			$sql="update goods set is_new=$is_new where id=$id ";
			if (update($sql)) {
				header('location:'.$_SERVER['HTTP_REFERER']);
				exit;
			}else{
				echo '修改失败<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/>';
				exit;
			}
			break;
		case 'hot';
			$id=get('id');
			$is_hot=get('is_hot');
			$is_hot=$is_hot==1?0:1;

			$sql="update goods set is_hot=$is_hot where id=$id ";
			if (update($sql)) {
				header('location:'.$_SERVER['HTTP_REFERER']);
				exit;
			}else{
				echo '修改失败<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/>';
				exit;
			}
			break;
		case 'best';
			$id=get('id');
			$is_best=get('is_best');
			$is_best=$is_best==1?0:1;

			$sql="update goods set is_best=$is_best where id=$id ";
			if (update($sql)) {
				header('location:'.$_SERVER['HTTP_REFERER']);
				exit;
			}else{
				echo '修改失败<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/>';
				exit;
			}
			break;
		case 'up';
			$id=get('id');
			$is_up=get('is_up');
			$time=time();
			$is_up=$is_up==1?0:1;
			if ($is_up==1) {
				$sql="update goods set is_up=$is_up,up_time=$time,down_time='' where id=$id ";
			}
			if ($is_up==0) {
				$sql="update goods set is_up=$is_up,down_time=$time,up_time='' where id=$id ";
			}
			if (update($sql)) {
				header('location:'.$_SERVER['HTTP_REFERER']);
				exit;
			}else{
				echo '修改失败<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/>';
				exit;
			}
			break;
		case 'add':

			$name=post('name');
			$cateid=post('cate_id');
			$price=post('price');
			$num=post('num');
			$isup=post('is_up');
			$isbest=post('is_best');
			$ishot=post('is_hot');
			$isnew=post('is_new');
			$describe=post('describe');
			$time=time();

			//1.检测表单内容为不为空？
		foreach ($_POST as $value) {
					if ($value == "") {
						echo '你有内容还没有添加';
						exit;
					}
			}
			//2.判断用户有没有图片上传,
			
			if($_FILES['pic']['error']==4){
					echo '请上传图片<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/>';
					exit;
			}

			//2.1如果有要先执行文件上传，文件上传成功后，先执行缩放
			
			if($file_path=upload('pic',PATH.'../upload')){

						$path=dirname($file_path);
						$file=basename($file_path);
				//缩放一个62*62的图片
				if (!zoom($file_path,$path,'62_'.$file,62,62) ) {	
						echo '缩放失败<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/> ';		
						exit;
				}
				//缩放一个为180*255的图片
				if (!zoom($file_path,$path,'180_'.$file,180,255) ) {	
						echo '缩放失败<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/> ';		
						exit;
				}
				//缩放一个120*120的图片
				if (!zoom($file_path,$path,'450_'.$file,450,680) ) {	
						echo '缩放失败<meta http-equiv="refresh" content="1,url='.$_SERVER['HTTP_REFERER'].'"/> ';		
						exit;
				}

					$sql="insert into goods(cate_id,name,price,num,is_up,up_time,is_best,is_hot,is_new,`describe`) values('$cateid','$name','$price','$num','$isup','$time','$isbest','$ishot','$isnew','$describe')";

					$result=mysql_query($sql);

					if ($id=mysql_insert_id($link)) {

						$sql="insert goods_img(goods_id,name,is_face)values('$id','$file','1')";

						if(mysql_query($sql)){
							
							echo '添加成功<meta http-equiv="refresh" content="1;url='.$_SERVER['HTTP_REFERER'].'"/>';

						}else{

							echo '添加失败<meta http-equiv="refresh" content="1;url='.$_SERVER['HTTP_REFERER'].'"/>';
						
						}
				

					}else{
						echo '数据库处理失败<meta http-quiv="refresh" content="1,url='.$_SERVER['HTTP_REFERERE'].'"/>';
						exit;
					}
					
						//$sql="insert into goods_img(goods_id,name)values('$goods_id','$imgname')";
						
				
			}else{
				//图片上传失败
				echo '上传失败<meta http-equiv="refresh" content="3;url='.$_SERVER['HTTP_REFERER'].'"/>';
				exit;
			}		
			//2.1.1如果缩放成功，再把其它商品信息写入商品表，（文件上传成功之后会返回一个文件名）再把文件名写入googs_img（商品图片）表。如果没有上传图片不让其添加商品
			
			//2.1.2如果图片缩放失败，就不能添加商品

			//2.2如果上传图片失败就不能添加商品，终止掉程序，返回上个页面
				
			break;
	}
