<?php
	include '../common.php';
	
	$a = $_GET['a'];

	switch($a){
		case 'add':
			echo "<pre>";
				print_r($_POST);
			echo "</pre>";
			//1.检测表单内容为不为空？
			foreach ($_POST as $value) {
					if ($value == "") {
						echo '你有内容还没有添加';
						exit;
					}
			}
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
			//2.判断用户有没有图片上传,
				echo "<pre>";
				print_r($_FILES);
			echo "</pre>";
			//2.1如果有要先执行文件上传，文件上传成功后，先执行缩放
			

			if((bool)exist('id','goods','name',$name)){
						echo '有相同产品,添加失败';
						exit;
					}else{
			$filename=upload('pic');
			if($filename){
				//echo '上传成功';
				$y = substr($filename,0,4);
				$m = substr($filename,4,2);

				$path = './upload/'.$y.'/'.$m.'/'.$filename;
				//echo '<img src="'.$path.'" />';

				$imgname=zoom($path,'./upload/'.$y.'/'.$m.'/');  //缩放
				if ($imgname) {
					//echo '缩放成功';
					
					$sql="insert into goods(cate_id,name,price,num,is_up,up_time,is_best,is_hot,is_new,`describe`) values('$cateid','$name','$price','$num','$isup','$time','$isbest','$ishot','$isnew','$describe')";
					if(insert($sql,$link)){
						$sql="select id from goods where name = '$name'";
						echo '<br>';
						$id_list=query($sql);
						foreach ($id_list as  $val) {
							$goods_id=$val['id'];
						}
						$sql="insert into goods_img(goods_id,name)values('$goods_id','$imgname')";
						if(insert($sql,$link)){
								echo '添加成功';
						}else{
								echo '添加失败';
							}
					}else{
						echo '添加失败';
					}
				
				}else{
					//echo '缩放失败';
					echo '上传处理失败';
				}
			}else{
				echo '上传失败';
			}		
			//2.1.1如果缩放成功，再把其它商品信息写入商品表，（文件上传成功之后会返回一个文件名）再把文件名写入googs_img（商品图片）表。如果没有上传图片不让其添加商品
			
			//2.1.2如果图片缩放失败，就不能添加商品

			//2.2如果上传图片失败就不能添加商品，终止掉程序，返回上个页面
				
			break;}
	}
