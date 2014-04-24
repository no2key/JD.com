<?php
function upload($name, $dir='./upload', $type=array('image','text')){
		//echo "<pre>";
		//	print_r($_FILES);
		//echo "</pre>";

		//1.限制文件上传的类型
		list($maintype, $suffix) = explode('/', $_FILES[$name]['type']);

		//1.1判断文件类型是否合法
		if(!in_array($maintype, $type)){
			//echo '文件类型不合法';
			$_FILES[$name]['error'] = 8;
			//return false;		//跳出函数，不执行下面的代码。
		}

		//2.判断错误
		if($_FILES[$name]['error'] > 0){


			switch($_FILES[$name]['error']){
				case 1:
					echo '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。';
					break;

				case 2:
					echo '上传的文件超过了 表单 中 MAX_FILE_SIZE 限制的值。';
					break;

				case 3:
					echo '文件部分被上传';
					break;

				case 4:
					echo '没有文件被上传';
					break;

				case 6:
					echo '找不到临时文件';
					break;

				case 7:
					echo '文件写入失败';
					break;

				case 8:
					echo '文件类型不合法';
					break;
			}

			return false;
		}

		
		
		//3.处理文件名
		//3.1拼接文件名加后缀
		if($suffix == 'jpeg'){
			$suffix = 'jpg'; 
		}

		//拼接好文件名
		$filename = date('Ymd').md5(uniqid()).'.'.$suffix;

		//判断保存文件的目录是否存在
		$dir = rtrim($dir,'/').'/'.date('Y').'/'.date('m');

		if(!file_exists($dir)){
			mkdir($dir,0777,true);
		}

		//拼接好完整的文件路径
		$file_path = $dir .'/'. $filename;

		//4.移动文件
		//4.1判断文件是不是http post 传递过来的文件
		if(!is_uploaded_file($_FILES[$name]['tmp_name'])){
			return false;
		}

		//4.2移动文件
		if(move_uploaded_file($_FILES[$name]['tmp_name'], $file_path)){
			return $filename;	//返回的这个文件名，未来我们要把它写入数据库
		}else{
			return false;
		}
	}



function watermark($back, $water, $alpha=100){
		$back_img = createImg($back);

		$water_img = createImg($water);

		if(
			($back_img['width'] < $water_img['width']) || 
			($back_img['height'] < $water_img['height'])
		){
			//echo '背景图片的宽或高小于水印图片的宽或高';
			return false;
		}

		//bool imagecopy ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h )
		
		imagecopymerge(
			$back_img['resource'],
			$water_img['resource'],
			$back_img['width']-$water_img['width']-10,
			$back_img['height']-$water_img['height']-10,
			0,
			0,
			$water_img['width'],
			$water_img['height'],
			$alpha
		);

		//保存图片
		//1.拼接函数名
		$func = 'image'.$back_img['suffix'];
		//2.图片名要处理一下吧？产生一个新的图片名
		//判断一下如果类型为jpeg - jpg

		if($back_img['suffix'] == 'jpeg'){
			$back_img['suffix'] = 'jpg';
		}

		$file_name = time() .'.'. $back_img['suffix'];

		//3.保存图片
		$result = $func($back_img['resource'], $file_name);
		

		//销毁图片资源
		imagedestroy($back_img['resource']);
		imagedestroy($water_img['resource']);



		echo "<pre>";
			print_r($back_img);
			print_r($water_img);
		echo "</pre>";
	}


	/*
	 *	剪切函数
	 *	@param String $img_path 操作的图片
	 *	@param Int 起始点坐标 $start_x $start_y 
	 *	@param Int 剪切的宽高 $width $height
	 */

	//cut('./pp.jpg',113,264,350,270);
	function cut($img_path, $start_x, $start_y, $width, $height){
		$info = createImg($img_path);		//得到图片信息

		$cut_img = imagecreatetruecolor($width, $height);	//创建剪切图片资源

		//剪切
		imagecopyresampled($cut_img, $info['resource'], 0,0,$start_x,$start_y,$width,$height,$width,$height);

		//保存图片
		//1.拼接函数名
		$func = 'image'.$info['suffix'];

		//2.图片名要处理一下吧？产生一个新的图片名
		//判断一下如果类型为jpeg - jpg

		if($info['suffix'] == 'jpeg'){
			$info['suffix'] = 'jpg';
		}

		$file_name = time() .'.'. $info['suffix'];

		//3.保存图片
		$result = $func($cut_img, $file_name);




		//销毁图片资源
		//关闭图片资源
		imagedestroy($info['resource']);
		imagedestroy($cut_img);

		return $result;
		
	}


	/*
	 *	缩放函数
	 *	@$img_path String $img_path 操作的图片路径
	 *	@param Int $width 缩放后的图片宽度
	 *	@param Int $height 缩放后的图片高度
	 *	操作成功返回true  失败返回false
	 */

	//zoom('./mm.png', './save/20140408',300,300);

	function zoom($img_path, $save_path='./', $width=200, $height=200){

		//判断用户传的保存目录是否存在
		if(!file_exists($save_path)){
			mkdir($save_path,0777,true);
		}

		$save_path = rtrim($save_path,'/').'/';
		
		//调用万能打开函数
		$info = createImg($img_path);

		//完成等比缩放
		if($info['width'] > $info['height']){		//宽不变，改变高的值
			$height = ($width/$info['width']) * $info['height'];
		}else{
			$width = ($height/$info['height'])*$info['width'];
		}


		//创建画布，目标图片
		$dest_img = imagecreatetruecolor($width,$height);

		//缩放
		imagecopyresampled($dest_img, $info['resource'], 0,0,0,0,$width, $height, $info['width'], $info['height']);

		//保存图片
		//1.拼接函数名
		$func = 'image'.$info['suffix'];

		//2.图片名要处理一下吧？产生一个新的图片名
		//判断一下如果类型为jpeg - jpg

		if($info['suffix'] == 'jpeg'){
			$info['suffix'] = 'jpg';
		}

		$file_name = time() .'.'. $info['suffix'];

		//3.保存图片
		$result = $func($dest_img,$save_path.$file_name);

		//关闭图片资源
		imagedestroy($info['resource']);
		imagedestroy($dest_img);

		/*if($result){
			return true;
		}
		
		return false;
		 */

		return $result;
		
	}





	/*
	 *	万能打开图片函数
	 *
	 *	@param String $img_path 传入一个图片路径
	 *
	 *	@return Array 图片宽 高 图片资源  图片类型
	 *
	 */

	function createImg($img_path){
		$info = getimagesize($img_path);

		//从新生成一个新数组，包含图片的宽高图片类型
		$img['width'] = $info[0];
		$img['height'] = $info[1];
		$img['suffix'] = ltrim(strrchr($info['mime'],'/'),'/');

		//拼接一个打开资源的函数名,拼接成不同的函数名
		$func = 'imagecreatefrom'.$img['suffix'];

		//将图片资源保存到数组中
		$img['resource'] = $func($img_path);

		//返回这个数组
		return $img;
	}

	//数据库查询,
	function  query($sql){
		$result=mysql_query($sql);
		if($result && mysql_num_rows($result)>0){
			$list=array();
			while($row=mysql_fetch_assoc($result)){
				$list[]=$row;
			}
		}
		return $list;
	}