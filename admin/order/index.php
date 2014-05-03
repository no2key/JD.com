<?php 
	include '../common.php';

	$sql="select u.name un,oi.id,oi.receiver,oi.address,oi.email,oi.tel,oi.order_num onum,oi.createtime,oi.total,oi.status from user u,order_info oi where u.id=oi.user_id  ";
	$order_list=query($sql);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>订单列表</title>
	<link rel="stylesheet" href="../../css/admin.css"/>
</head>
<body class="main">
	<div id="listDiv" class="list-div">
		<h1>
			<span class="action-span1"><a href="">管理中心</a></span>
			<span id="search_id" class="action-span1"> - 订单列表 </span>
			
		</h1>
		<div class="form-div">
			<form action="index.php" method="get">
				订单号
				<input size="15" type="text" name="name">
				收货人
				<input size="8" type="text" name="price" >
				订单状态
				<select name="cate">
					<option>请选择...</option>
					<option value="">未发货</option>
					<option value="">已发货</option>
					<option value="">确认收获</option>
					<option value="">退货</option>
				<select>
				<input type="submit" value="搜索">
			</form>
		</div>
		<table class="admin_userlist">
		<tr>
			<th>订单号</th>
			<th>下单时间</th>
			<th>购买人</th>
			<th>收货人</th>
			<th>总金额</th>
			<th>订单状态</th>
			<th>操作</th>
		</tr>
		<?php if (!empty($order_list)): ?>
		<?php foreach($order_list as $val): ?>
		<tr>
			<td><?php echo $val['onum'] ;?></td>
			<td><?php echo date('Y-m-d',$val['createtime']) ;?></td>
			<td><?php echo $val['un'] ; ?></td>
			<td align="left">
				<?php echo $val['receiver'] ; ?>[Tel:<?php echo $val['tel'] ?>]<br>
				<?php echo $val['address'] ?>
			</td>
			<td><?php echo $val['total']?></td>
			<td>
				<?php if($val['status']=='0' ): ?>
						<a href="<?php echo URL ?>action.php?a=status&id=<?php echo $val['id'] ?>&status=0">未发货</a>
					<?php elseif($val['status']=='1'): ?>
						已发货
					<?php elseif($val['status']=='2'): ?>
						收货确认
					<?php else: ?>
						<span class="red">退货<span>
				<?php endif; ?>
			</td>
			<td>
				<a href="edit.php?id=<?php echo  $val['id'] ;?>">查看订单</a>||
				<a href="imglist.php?id=<?php echo  $val['id'] ;?>">图像编辑</a>||
			</td>
			</tr>
		<?php endforeach; ?>
		<?php endif; ?>
		</table>
	</div>
		<div> </div>
</body>
</html>