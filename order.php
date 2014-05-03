<?php 
	session_start();
	if ($_SESSION['home']=='') {
		header('location:login.php?target=http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']);
	}
	include 'header.php';

	$step=get('step');
	if (empty($step)) {
		$step='checkout';
	}
	$id=$_SESSION['home']['id'];

	$sql="select id,receiver,address,email,zip,tel from user_address where user_id='$id' ";
	$add_list=query($sql);
	if (empty($add_list)) {
		$step='consignee';
	}
	$sql="select id,receiver,address,email,zip,tel from user_address where user_id='$id' and `derault`=1 ";
	$def_list=query($sql);

	$sql="select sum(rank_points) jf from user_account where user_id='$id' group by rank_points ";
	$jf_list=query($sql);
 ?>
 <div class="Comw">
 	<div>填写并核对订单信息</div>
 	<!--<?php //switch($step): ?>
 	<?php //case 'checkout'; ?>-->
 	<?php if ($step == 'checkout'): ?> 
 	<form action="order_action.php?a=pay" method="post">
		<div class="flowBox">
			<h6>
				<span>商品列表</span>
				<a class="f6" href="cate_show.php">修改</a>
			</h6>
			<table width="99%" border="0" bgcolor="#dddddd" align="center" cellspacing="1" cellpadding="5">
				<tbody>
					<tr>
						<th bgcolor="#ffffff"></th>
						<th bgcolor="#ffffff">商品名称</th>
						<th bgcolor="#ffffff">价格</th>
						<th bgcolor="#ffffff">购买数量</th>
						<th bgcolor="#ffffff">小计</th>
					</tr>
					<?php if (!empty($_SESSION['cate'])): ?>
						<?php foreach($_SESSION['cate'] as $key => $value): ?>
						<tr>
							<td bgcolor="#ffffff">
								<?php 
									$path= '';
									$path.=URL.'upload/';
									$path.=substr($value['gmn'],0,4).'/';
									$path.=substr($value['gmn'],4,2).'/';
									$file=$path.'62_'.$value['gmn'];
								 ?>
								<img src="<?php echo $file ;?> " title=""alt="">
							<br>
							<td bgcolor="#ffffff">
								<a class="f6" target="_blank" href="details.php?id=<?php echo $key ?>"><?php echo $value['gn'] ?></a>
							</td>
							</td>
							<td bgcolor="#ffffff" align="right">&yen;<?php echo $value['price'] ?></td>
							<td bgcolor="#ffffff" align="right"><?php echo $value['num'] ?></td>
							<?php 
								$subtotal = ($_SESSION['cate'][$key]['price']*$_SESSION['cate'][$key]['num']);
								$total +=$subtotal;
							 ?>
							<td bgcolor="#ffffff" align="right"><?php echo $subtotal; ?></td>
						</tr>
						<?php endforeach; ?>
					<?php endif; ?>
					<tr>
						<td bgcolor="#ffffff" colspan="7"> 购物金额小计 &yen;<?php echo $total;  ?> 元</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="h10"></div>
		<div class="flowBox">
			<h6>
				<span>收货人信息</span>
				<a class="f6" href="order.php?step=consignee">修改</a>
			</h6>
			<table width="99%" border="0" bgcolor="#dddddd" align="center" cellspacing="1" cellpadding="5">
				<tbody>
					<tr>
						<td bgcolor="#ffffff">收货人姓名:</td>
						<td bgcolor="#ffffff"> <input type="hidden" value="<?php echo $def_list[0]['receiver'] ?>" name="receiver"><?php echo $def_list[0]['receiver']; ?></td>
						<td bgcolor="#ffffff">电子邮件地址:</td>
						<td bgcolor="#ffffff"><input type="hidden" value="<?php echo $def_list[0]['email'] ?>" name="email"><?php echo $def_list[0]['email']; ?></td>
					</tr>
					<tr>
						<td bgcolor="#ffffff">详细地址:</td>
						<td bgcolor="#ffffff"><input type="hidden" value="<?php echo $def_list[0]['address'] ?>" name="address"><?php echo $def_list[0]['address']; ?> </td>
						<td bgcolor="#ffffff">邮政编码:</td>
						<td bgcolor="#ffffff"><input type="hidden" value="<?php echo $def_list[0]['zip'] ?>" name="zip"><?php echo $def_list[0]['zip']; ?></td>
					</tr>
					<tr>
						<td bgcolor="#ffffff">手机:</td>
						<td bgcolor="#ffffff"><input type="hidden" value="<?php echo $def_list[0]['tel'] ?>" name="tel"><?php echo $def_list[0]['tel']; ?></td>
						<td bgcolor="#ffffff"></td>
						<td bgcolor="#ffffff"></td>
					</tr>
				</tbody>
				</table>
		</div>
		<div class="h10"></div>
		<div class="flowBox pay clearfix">
			<h6>
				<span>支付方式</span>
			</h6>
			<table width="40%" border="0" bgcolor="#dddddd" align="center" cellspacing="1" cellpadding="5">
				<tbody>
					<tr>
						<th width="20%" bgcolor="#ffffff">名称</th>
					</tr>
					<tr>
						<td align="right" bgcolor="#ffffff">
							<strong>货到付款</strong>
						</td>
					</tr>
				</tbody>
				</table>
		</div>
		<div class="h10"></div>
		<div class="flowBox ">
			<h6>
				<span>其他信息</span>
			</h6>
			<table width="99%" border="0" bgcolor="#dddddd" align="center" cellspacing="1" cellpadding="5">
				<tbody>
					<tr>
						<td bgcolor="#ffffff">
							<strong>使用积分</strong>
						</td>
						<td align="right" bgcolor="#ffffff">
							<?php  if($jf_list[0][jf]>0):?>
							<input id="ECS_INTEGRAL" class="input" type="text" size="10" value="0" onblur="changeIntegral(this.value)" name="integral">
							<?php endif; ?>
							您当前的可用积分为:<?php echo $jf_list[0][jf]==0?0:$jf_list[0][jf]; ?> 积分，本订单最多可以使用2200 积分.

						</td>
					</tr>
				</tbody>
				</table>
		</div>
		<div class="flowBox">
			<h6>
				<span>费用总计</span>
			</h6>
			<div id="ECS_ORDERTOTAL">
				<table width="99%" border="0" bgcolor="#dddddd" align="center" cellspacing="1" cellpadding="5">
					<tbody>
						<tr>
							<td bgcolor="#ffffff" align="right">
							该订单完成后，您将获得
							<font class="f4_b"><?php echo floor($total); ?></font>
							积分 。
							</td>
						</tr>
					<tr>
						<td bgcolor="#ffffff" align="right">
							商品总价:
							<font class="f4_b">￥<?php echo $total; ?>元</font>

						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" align="right">
							应付款金额:
							<font class="f4_b">￥<?php echo $total ?>元</font>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
			<div align="center" style="margin:8px auto;">
				<input type="image" src="./images/bnt_subOrder.gif">
				<input type="hidden" value="<?php echo $total ?>" name="total">
				<input type="hidden" value="<?php echo $def_list[0]['id'] ?>" name="addid">
			</div>
		</div>
	</form>
<?php elseif(($step == 'consignee')): ?>

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
								<input class="bnt_blue_2" type="submit" value="配送至这个地址" name="Submit">
								<input class="bnt_blue" type="button" value="删除" onclick="if (confirm('您确定要删除该收货人信息吗？')) location.href='order_action.php?a=deladd&id=<?php echo $val['id'] ?>'" name="button">
								<input type="hidden" value="order" name="setp">
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
							<input class="bnt_blue_2" type="submit" value="配送至这个地址" >
							<input type="hidden" value="<?php echo $id ?>" name="user_id">
							<input type="hidden" value="order" name="setp">
							<input type="hidden" value="0" name="default">
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
							<input class="bnt_blue_2" type="submit" value="配送至这个地址" >
							<input type="hidden" value="1" name="default">
							<input type="hidden" value="<?php echo $id ?>" name="user_id">
						</td>
					</tr>
				</tbody>
				</table>
		</div>
	</form>
<?php endif; ?>
<?php endif; ?>
 </div>
 <?php include 'footer.php' ?>