<?php 
	include '../common.php';
	$a=get('a');

	switch($a){
		case 'status':
		$status=get('status');
		$id=get('id');

		if ($status=='0') {
				$sql="update order_info set status='1' where id='$id'";
				if (update($sql)) {
					header('location:index.php');
				}

		}


		break;
	}


