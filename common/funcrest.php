<?php 
	header("content-type:text/html;charset=utf-8");
	/**
	 * 文件上传函数
	 * @param string $name 文件域中的name
	 * @param string dir 指定文件保存目录
	 * return 文件名
	 */
	
	function upload($name,$dir='/upload',$type=array(jpg,png,gif)){

		list($filename,$suffix)=explode('/',$_FILES['$name']['type'])

		if (!in_array($filename,$type)) {
			$_FILES['$name']['error']=8;
		}

		if ($_FILES['$name']['error']>0) {
			switch ($_FILES['$name']['error']) {
				case '1':
					echo '文件大小超过了upload_max_files中限制的值';
					break;
				case '2':
					echo '文件大小超过了MAX_FILES_SIZE选项';
					break;
				case '3':
					echo '文件只有部分被上传';
					break;
				case '4':
					echo '没有文件被上传';
					break;
				case '6':
					echo '找不到临时文件';
					break;
				case '7':
					echo '文件写入失败';
					break;
				case '8':
					echo '文件类型不符合';
				break;
			}
			return false;
		}

		$suffix=$suffix=='jpeg'?'jpg':$suffix;

		//拼接文件名

	}
