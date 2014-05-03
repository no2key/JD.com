<?php 
	include 'common.php';
	$a=get('a');

	switch($a){
		case 'over':
			$id=get('id');
			$sql="update order_info set status='2' where id='$id'";
			if (update($sql)) {
				header('loaction:'.$_SERVER['HTTP_REFERER']);
				exit;
			}

		break;
	}
