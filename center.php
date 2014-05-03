<?php 
	session_start();
	if ($_SESSION['home']=='') {
		header('location:login.php?target=http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']);
	}
	include 'header.php';
	$act=get('act');
	$id=$_SESSION['home']['id'];

		$sql="select count(id) num from order_info ";
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		$total=$row['num'];    //总条数
		$num=5;			//每页条数
		$amout=ceil($total/$num);  //可分页数
		$page=$_GET['p'];
		$page=max($page,1);
		$page=min($amout,$page);
		$offest=($page-1)*$num;  //初始量
	
	$sql="select u.name usern,u.icon,u.password,u.email,u.birth,u.sex,u.tel,u.log_time,u.address useadd,ori.order_num,ori.id,ori.receiver,ori.createtime,ori.total,ori.status from user u,order_info ori where ori.user_id=u.id and u.id='$id' limit $offest,$num";
	$user_list=query($sql);

	$sql="select id,receiver,address,email,zip,tel from user_address where user_id='$id' ";
	$add_list=query($sql);

 ?>
<div class="userlist Comw clearfix">
	<div class="userMenu fl">
		<div class="userbox">
			<a href="center.php">欢迎页</a>
			<a href="center.php?act=profile">用户信息</a>
			<a href="center.php?act=address_list">收货地址</a>
			<a href="center.php?act=order_list">我的订单</a>
			<a href="center.php?act=comment_list">我的评论</a>
		</div>
	</div>
	<div class="write fl">
		<div class="box_1">
			<div class="userCenterBox boxCenterList clearfix" style="_height:1%;">
				<?php if ($act==''): ?>	
						<div class="fl">
							<p class="f5">
							<span class="f4"><?php echo $user_list['0']['usern'] ?></span>
							欢迎您回到 马尚购！
							</p>
						</div>
						<?php 
							$dir=URL.'upload/';
							$dir.=substr($user_list['0']['icon'],0,4).'/';
							$dir.=substr($user_list['0']['icon'],4,2).'/';
							$path=$dir.'120_'.$user_list['0']['icon'];
						 ?>
						<div class="fr">
							<div class="headimg"><img src="<?php echo $path; ?>" width="120" height="120" alt=""></div>
						</div>
				<?php elseif($act=='profile'): ?>  <!-- 编辑用户信息-->
					<form action="action.php?list=edit" method="post" enctype="multipart/form-data">
				 		<table width="100%" class="">
				 			<tr>
				 				<td class="label" width="28%" align="right">会员姓名:</td>
				 				<td clospan="2"> <?php echo $user_list['0']['usern']; ?> </td>
				 			</tr>
				 			<tr>
				 				<td class="label" width="28%" align="right">会员头像:</td>
				 				<?php 
									$path =URL.'upload/';
									$path .=substr($user_list['0']['icon'],0,4).'/';
									$path .=substr($user_list['0']['icon'],4,2).'/';
									$pathname=$path.'120_'.$user_list['0']['icon'];
						 		?>
				 				<td><img src="<?php echo $pathname ?>"  width="120" height="120" alt=""><input type="hidden" name="path" value="<?php echo $user_list['0']['icon'] ?>"></td>
				 				<td><input type="file" name="pic"></td>
				 			</tr>
				 			<tr>
				 				<td class="label" width="28%" align="right">邮箱地址:</td>
				 				<td clospan="2"><input type="text" name="email" value="<?php echo $user_list['0']['useadd']; ?>"></td>
				 			</tr>
				 			<tr>
				 				<td class="label" width="28%" align="right">生日:</td>
				 				<td clospan="2">
				 					<input type="text" size="4" name="birth" value="<?php echo date('Y',$user_list['0']['birth']); ?>">年
				 					<input type="text" size="2" name="birth1" value="<?php echo date('m',$user_list['0']['birth']); ?>">月
				 					<input type="text" size="2" name="birth2" value="<?php echo date('d',$user_list['0']['birth']); ?>">日

				 				</td>
				 			</tr>
				 			<tr>
				 				<td class="label" width="28%" align="right">性别:</td>
				 				<td clospan="2"><input type="radio" name="sex" value="1" <?php echo $user_list['0']['sex']==1?checked:''; ?>>男<input type="radio" name="sex" value="0" <?php echo $user_list['0']['sex']==0?checked:''; ?>>女</td>
				 			</tr>
				 			<tr>
				 				<td class="label" width="28%" align="right">电话/手机:</td>
				 				<td clospan="2"><input type="text" name="tel" value="<?php echo $user_list['0']['tel']; ?>"></td>
				 			</tr>
				 			<tr>
				 				<td class="label" width="28%" align="right">地址:</td>
				 				<td clospan="2"><input type="text" name="add" value="<?php echo $user_list['0']['address']; ?>"></td>
				 			</tr>
				 			<tr>
				 				<td class="label" width="28%"></td> 
				 				<td clospan="2"><input type="submit" value="修改"></td>
				 			</tr>
				 		</table>
				 	</form>
				 	<form onsubmit="return editPassword()" method="post" action="user.php" name="formPassword">
						<table class="password" width="100%" border="0" >
							<tbody>
								<tr>
									<td width="28%" class="label" align="right">原密码:</td>
									<td width="76%"  align="left">
										<input class="inputBg" type="password" size="25" name="old_password">
									</td>
								</tr>
								<tr>
									<td width="28%" class="label" align="right">新密码:</td>
									<td  align="left">
										<input class="inputBg" type="password" size="25" name="new_password">
									</td>
								</tr>
								<tr>
									<td width="28%" class="label" align="right">确认密码:</td>
									<td  align="left">
										<input class="inputBg" type="password" size="25" name="comfirm_password">
									</td>
								</tr>
								<tr>
									<td class="label" width="28%"></td> 
				 				<td clospan="2"><input type="submit" value="修改"></td>
								</tr>
							</tbody>
						</table>
					</form>
				<?php elseif($act=='order_list'): ?>

					<table width="100%" border="0" class="cen_buy">
						<tbody>
							<tr align="center">
								<td bgcolor="#ffffff">订单信息</td>
								<td bgcolor="#ffffff">收货人</td>
								<td bgcolor="#ffffff">订单总金额</td>
								<td bgcolor="#ffffff">下单时间</td>
								<td bgcolor="#ffffff">订单状态</td>
								<td bgcolor="#ffffff">操作</td>
							</tr>
							<?php if(!empty($user_list)): ?>
							<?php foreach($user_list as $val): ?>
							<tr class="tr-th">
								<td  colspan="6"><span class="">订单编号</span> <?php echo $val['order_num'] ?></td>
							</tr>
							<tr>
								<td bgcolor="#ffffff" >
									<?php 
											$sql="select g.id,g.name gn,gm.name gmn 
														from order_goods ogs,goods_img gm,goods g  where 
														g.id=ogs.goods_id and gm.goods_id=g.id and gm.is_face=1 and ogs.order_info_id='$val[id]'
														";
												$img_list=query($sql);
									 ?>
									 <?php if(!empty($img_list)): ?>
									 <?php foreach($img_list as $value): ?>
									 <?php 
				  							$dir='';
				  							$dir.=URL.'upload/';
				  							$dir.=substr($value['gmn'],0,4).'/';
				  							$dir.=substr($value['gmn'],4,2).'/';
				  							$path=$dir.'62_'.$value['gmn'];
				  						 ?>
									<a class="img-box" target="_blank" href="details.php?id=<?php echo $value['id']?>">
										<img width="62" height="62" src="<?php echo $path; ?>" title="<?php echo $value['gn'] ?>" alt="">
									</a>
								<?php endforeach; ?>
							<?php endif; ?>

								</td>
								<td bgcolor="#ffffff" align="center"><?php echo $val['receiver'] ?></td>
								<td bgcolor="#ffffff" align="right">&yen;<?php echo $val['total'] ?></td>
								<td bgcolor="#ffffff" align="center"><?php echo date('Y-m-d',$val['createtime']) ?></td>
								
									<?php if($val['status']==0): ?>
									<td bgcolor="#ffffff" align="center">
										未发货
									</td>
									<td bgcolor="#ffffff" align="center">
										<font class="f6">
										<a onclick="if (!confirm('您确认要取消该订单吗？取消后此订单将视为无效订单')) return false;" href="user.php?act=cancel_order&order_id=22">取消订单</a>
										</font>
									</td>
									<?php elseif($val['status']==1): ?>
									<td bgcolor="#ffffff" align="center">
										已发货
									</td>
									<td bgcolor="#ffffff" align="center">
										<font class="f6">
										<a onclick="if (!confirm('您确认收获吗?')) return false;" href="center_action.php?a=over&id=<?php echo $val['id'] ?>">确认收获</a>
										</font>
									</td>
									<?php elseif($val['status']==2): ?>
									<td bgcolor="#ffffff" align="center">
										订单完成
									</td>
									<td bgcolor="#ffffff" align="center">
										订单完成
									</td>
									<?php elseif($val['status']==3): ?>
									<td bgcolor="#ffffff" align="center">
										取消订单
									</td>
									<td bgcolor="#ffffff" align="center">
										订单已取消
									</td>

									<?php elseif($val['status']==4): ?>

									<?php endif; ?>
							</tr>
							<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
						</table>
						<?php echo  page($num,$total,$page,"center.php?act=order_list&",$search) ?> <!-- 分页-->

				<?php elseif($act=='address_list'): ?>
						<?php if(!empty($add_list)): ?>
							<?php foreach($add_list as $key => $val): ?>
								<form action="order_action.php?a=edit" method="post">
									<div class="flowBox">
										<h6>
											<span>收货人信息</span>
										</h6>
										<table width="99%" border="0" bgcolor="#dddddd" align="center" cellspacing="1" cellpadding="5">
											<tbody>
												<tr>
													<td bgcolor="#ffffff">收货人姓名:</td>
													<td bgcolor="#ffffff"><input class="inputBg" type="text" value="<?php echo $val['receiver'] ?>" name="receiver">(必填) </td>
													<td bgcolor="#ffffff">电子邮件地址:</td>
													<td bgcolor="#ffffff"><input class="inputBg" type="text" value="<?php echo $val['email'] ?> " name="email">(必填)</td>
												</tr>
												<tr>
													<td bgcolor="#ffffff">详细地址:</td>
													<td bgcolor="#ffffff"><input  class="inputBg" type="text" value="<?php echo $val['address'] ?> " name="address">(必填)</td>
													<td bgcolor="#ffffff">邮政编码:</td>
													<td bgcolor="#ffffff"><input  class="inputBg" type="text" value="<?php echo $val['zip'] ?>" name="zip"></td>
												</tr>
												<tr>
													<td bgcolor="#ffffff">手机:</td>
													<td bgcolor="#ffffff"><input class="inputBg" type="text" value="<?php echo $val['tel'] ?> " name="tel">(必填)</td>
													<td bgcolor="#ffffff"></td>
													<td bgcolor="#ffffff"></td>
												</tr>
												<tr>
													<td bgcolor="#ffffff" align="center" colspan="4">
														<input class="bnt_blue_2" type="submit" value="确认修改" name="Submit">
														<input class="bnt_blue" type="button" value="删除" onclick="if (confirm('您确定要删除该收货人信息吗？')) location.href='order_action.php?a=deladd&id=<?php echo $val['id'] ?>&step=address_list'" name="button">
														<input type="hidden" value="address_list" name="step">
														<input type="hidden" value="<?php echo $val['id'] ?>" name="address_id">
													</td>
												</tr>
											</tbody>
											</table>
									</div>
								</form>
								<div class="h10"></div>
							<?php endforeach; ?>
								<form action="order_action.php?a=add" method="post">
								<div class="flowBox">
									<h6>
										<span>收货人信息</span>
									</h6>
									<table width="99%" border="0" bgcolor="#dddddd" align="center" cellspacing="1" cellpadding="5">
										<tbody>
											<tr>
												<td bgcolor="#ffffff">收货人姓名:</td>
												<td bgcolor="#ffffff"><input class="inputBg" type="text" value=" " name="receiver">(必填) </td>
												<td bgcolor="#ffffff">电子邮件地址:</td>
												<td bgcolor="#ffffff"><input class="inputBg" type="text" value=" " name="email">(必填)</td>
											</tr>
											<tr>
												<td bgcolor="#ffffff">详细地址:</td>
												<td bgcolor="#ffffff"><input  class="inputBg" type="text" value=" " name="address">(必填)</td>
												<td bgcolor="#ffffff">邮政编码:</td>
												<td bgcolor="#ffffff"><input  class="inputBg" type="text" value=" " name="zip"></td>
											</tr>
											<tr>
												<td bgcolor="#ffffff">手机:</td>
												<td bgcolor="#ffffff"><input class="inputBg" type="text" value=" " name="tel"></td>
												<td bgcolor="#ffffff"></td>
												<td bgcolor="#ffffff"></td>
											</tr>
											<tr>
												<td bgcolor="#ffffff" align="center" colspan="4">
													<input class="bnt_blue_2" type="submit" value="确认增加" >
													<input type="hidden" value="<?php echo $id ?>" name="user_id">
													<input type="hidden" value="address_list" name="step">
												</td>
											</tr>
										</tbody>
										</table>
								</div>
							</form>
						<?php else: ?>
						<form action="order_action.php?a=add" method="post">
								<div class="flowBox">
									<h6>
										<span>收货人信息</span>
									</h6>
									<table width="99%" border="0" bgcolor="#dddddd" align="center" cellspacing="1" cellpadding="5">
										<tbody>
											<tr>
												<td bgcolor="#ffffff">收货人姓名:</td>
												<td bgcolor="#ffffff"><input class="inputBg" type="text" value=" " name="receiver">(必填) </td>
												<td bgcolor="#ffffff">电子邮件地址:</td>
												<td bgcolor="#ffffff"><input class="inputBg" type="text" value=" " name="email">(必填)</td>
											</tr>
											<tr>
												<td bgcolor="#ffffff">详细地址:</td>
												<td bgcolor="#ffffff"><input  class="inputBg" type="text" value=" " name="address">(必填)</td>
												<td bgcolor="#ffffff">邮政编码:</td>
												<td bgcolor="#ffffff"><input  class="inputBg" type="text" value=" " name="zip"></td>
											</tr>
											<tr>
												<td bgcolor="#ffffff">手机:</td>
												<td bgcolor="#ffffff"><input class="inputBg" type="text" value=" " name="tel"></td>
												<td bgcolor="#ffffff"></td>
												<td bgcolor="#ffffff"></td>
											</tr>
											<tr>
												<td bgcolor="#ffffff" align="center" colspan="4">
													<input class="bnt_blue_2" type="submit" value="确认增加" >
													<input type="hidden" value="address_list" name="step">
													<input type="hidden" value="<?php echo $id ?>" name="user_id">
												</td>
											</tr>
										</tbody>
										</table>
								</div>
							</form>
						<?php endif; ?>

				<?php elseif($act=='comment_list'): ?>
						<h5>
							<span>我的评论</span>
						</h5>
						<div class="blank"></div>
						<div class="f_l">
							<b>商品评论: </b>
							<font class="f4">索爱C702c</font>
							  (2014-05-02 03:02:08)
						</div>
						<div class="f_r">
							<a class="f6" onclick="if (!confirm('你确实要彻底删除这条留言吗？')) return false;" title="删除" href="user.php?act=del_cmt&id=3">删除</a>
						</div>
						<div class="msgBottomBorder">
							fdgdsf
						<br>
						</div>




				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<script>
	
	document.title='账户信息';

</script>
 <?php 
 include 'footer.php';
  ?>