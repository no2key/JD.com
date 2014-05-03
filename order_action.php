<?php 
	include 'common.php';
	$a=get('a');


	switch($a){
			case 'deladd':   //收获地址
					$step=get('step');
					$id=get('id');
					$sql="delete from user_address where id='$id' ";
					$result =mysql_query($sql);
					if ($result && mysql_affected_rows($link)) {
						if($step=='address_list'){
							header('location:center.php?act=address_list');
							exit;
						}else{
							header('location:order.php?step=consignee');
							exit;
						}
					}
			break;
			case 'edit':   //收获地址
				$step=post('step');
				$receiver=post('receiver');
				$email=post('email');
				$address=post('address');
				$zip=post('zip');
				$tel=post('tel');
				$uid=$_SESSION['home']['id'];
					$sql="update user_address set (receiver,email,address,zip,tel,user_id,`default`) values( $str) ";
					$result =mysql_query($sql);
					if (mysql_affected_rows($link)) {
						if ($step=='order') {
							header('location:order.php?step=checkout');
							exit;
						}else{
							header('location:center.php');
							exit;
						}
					}
			break;
			case 'pay':
				$uid=$_SESSION['home']['id'];
				$receiver=post('receiver');
				$email=post('email');
				$address=post('address');
				$zip=post('zip');
				$tel=post('tel');
				$total=post('total');
				$time=time();
				$order_num=date('ymdHis').substr(microtime(),2,4);
				$sql="insert into order_info(order_num,user_id,receiver,address,tel,email,zip,createtime,total) values('$order_num','$uid','$receiver','$address','$tel','$email','$zip','$time','$total') ";
				$result=mysql_query($sql);
				if ($result && $id=mysql_insert_id($link)) {

						foreach($_SESSION['cate']  as $key => $val){
							$sql="insert into order_goods(order_info_id,goods_id,goods_num,price) values('$id','$key','$val[num]','$val[price]') ";
							insert($sql);
							$sql="update goods set num=num-'$val[num]' where id='$key'";
							update($sql);
							unset($_SESSION['cate'][$key]);
					}
					$_SESSION['buy']['id']=$order_num;
					 header('location:buy.php');
				}else{
					//插入失败
				}
					//$result =mysql_query($sql);
					//if ($id=mysql_insert_id()) {
						//header('location:order.php?step=checkout&aid='.$id);
					//}
			break;
			case 'add':
				$step=post('step');
				$def=post('default');
				$receiver=post('receiver');
				$email=post('email');
				$address=post('address');
				$zip=post('zip');
				$tel=post('tel');
				$uid=$_SESSION['home']['id'];
					if($def=='0'){
						$sql="update user_address set `derault`=0 where user_id='$uid'";
						update($sql);
					}
					 $sql="insert into user_address(receiver,email,address,zip,tel,user_id,`derault`) values('$receiver','$email','$address','$zip','$tel','$uid','1') ";
					 
					$result =mysql_query($sql);
					if ($id=mysql_insert_id()) {
						if($step=='address_list'){
							header('location:center.php?act=address_list');
							exit;
						}else{
							header('location:order.php?step=checkout');
							exit;
						}

					}
			break;

	}


