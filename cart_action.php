<?php 
	include 'common.php';
	$a=get('a');

	switch($a){
		case 'del';
			$id=get('id');
			unset($_SESSION['cate'][$id]);
			header('location:'.$_SERVER['HTTP_REFERER']);


		break;
		case 'minus_one':
				$id=get('id');
				$num=1;
				if (isset($_SESSION['cate'][$id])) {
					$_SESSION['cate'][$id]['num']-=$num;
					if ($_SESSION['cate'][$id]['num']<=0) {
						$_SESSION['cate'][$id]['num'] =1;
					}
					header('location:cate_show.php');
					exit;
			}
		break;
		case 'add_one':
				$id=get('id');
				$num=1;
				if (isset($_SESSION['cate'][$id])) {
					$_SESSION['cate'][$id]['num']+=$num;
					header('location:cate_show.php');
					exit;
			}
		break;
		case 'add':
			$num=post('buy_num');
			$id=post('id');

			if ($num<0) {
				$num=1;
			}

			$sql="select g.name gn,g.price,g.is_up,g.num stock,gm.name gmn  from goods g,goods_img gm where gm.goods_id=g.id and g.id='$id'";
			$row=query($sql);
			$row=$row[0];
			if ($row['stock']<=0) {
				echo '此商品暂无货<meta http-equiv="refresh" content="1,url=',$_SERVER['HTTP_REFERER'],'"/>';
				exit;
			}
			if ($row['is_up']==0) {
				echo '此商品已下架<meta http-equiv="refresh" content="1,url=',$_SERVER['HTTP_REFERER'],'"/>';
				exit;
			}
			if ($row['stock']<$num) {
				$num=$row['stock'];
			}
			if (isset($_SESSION['cate'][$id])) {
				foreach ($row as $key => $value) {
					$_SESSION['cate'][$id][$key]=$value;
				}
					$_SESSION['cate'][$id]['num']+=$num;
					if ($row['stock']<$_SESSION['cate'][$id]['num']) {
							$_SESSION['cate'][$id]['num']=$row['stock'];
					}
					header('location:cate_show.php');
					exit;
			}
			foreach ($row as $key => $value) {
				$_SESSION['cate'][$id][$key]=$value;
			}
			$_SESSION['cate'][$id]['num']=$num;
			header('location:cate_show.php');
		break;




	}