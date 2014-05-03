<?php 
	include 'common.php';
	$id=empty($_GET['id'])?0:(int)$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>menu</title>
	<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
	<div id="main-div">
		<ul class="menu_list">
		<?php if ($id==7){
			$str=<<<aaa
				<li class="explode">
				<a href="./menu.php?id=0">商品管理</a>
				<ul class="">
aaa;
			echo $str;
				}else{
		$str=<<<aaa
			<li class="collapse">
				<a href="./menu.php?id=7">商品管理</a>
				<ul class="none">
aaa;
			echo $str;
				}?>
					<li class="menu-item"><a href="<?php echo URL;?>goods/index.php" target="main">商品列表</a></li>
					<li class="menu-item"><a href="<?php echo URL;?>goods/add.php" target="main">添加商品</a></li>
					<li class="menu-item"><a href="">商品图片处理</a></li>
					<li class="menu-item"><a href=""></a></li>
				</ul>
			</li>
		<?php if ($id==1){
			$str=<<<aaa
				<li class="explode">
				<a href="./menu.php?id=0">会员管理</a>
				<ul class="">
aaa;
			echo $str;
				}else{
		$str=<<<aaa
			<li class="collapse">
				<a href="./menu.php?id=1">会员管理</a>
				<ul class="none">
aaa;
			echo $str;
				}?>
					<li class="menu-item"><a href="<?php echo URL?>user/index.php" target="main">会员列表</a></li>
					<li class="menu-item"><a href="<?php echo URL?>user/index.php" target="main">会员添加</a></li>
					<li class="menu-item"><a href="<?php echo URL?>user/index.php" target="main">权限管理</a></li>
				</ul>
			</li>
			<?php if ($id==2){
			$str=<<<aaa
				<li class="explode">
				<a href="./menu.php?id=0">订单管理</a>
				<ul class="">
aaa;
			echo $str;
				}else{
		$str=<<<aaa
			<li class="collapse">
				<a href="./menu.php?id=2">订单管理</a>
				<ul class="none">
aaa;
			echo $str;
				}?>
					<li class="menu-item"><a href="<?php echo URL ?>order/index.php" target="main">订单列表</a></li>
					<li class="menu-item"><a href="<?php echo URL ?>order/index.php" target="main">积分列表</a></li>
				</ul>
			</li>
			<?php if ($id==3){
			$str=<<<aaa
				<li class="explode">
				<a href="./menu.php?id=0">评论管理</a>
				<ul class="">
aaa;
			echo $str;
				}else{
		$str=<<<aaa
			<li class="collapse">
				<a href="./menu.php?id=3">评论管理</a>
				<ul class="none">
aaa;
			echo $str;
				}?>
					<li class="menu-item">评论管理</li>
					<li class="menu-item"></li>
				</ul>
			</li>
			<?php if ($id==4){
			$str=<<<aaa
				<li class="explode">
				<a href="./menu.php?id=0">分类管理</a>
				<ul class="">
aaa;
			echo $str;
				}else{
		$str=<<<aaa
			<li class="collapse">
				<a href="./menu.php?id=4">分类管理</a>
				<ul class="none">
aaa;
			echo $str;
				}?>
					<li class="menu-item"><a href="<?php echo URL?>cate/index.php" target="main">分类管理</a></li>
					<li class="menu-item"><a href="<?php echo URL?>cate/add.php" target="main">添加一级分类</a></li>
				</ul>
			</li>
			<?php if ($id==5){
			$str=<<<aaa
				<li class="explode">
				<a href="./menu.php?id=0">系统设置</a>
				<ul class="">
aaa;
			echo $str;
				}else{
		$str=<<<aaa
			<li class="collapse">
				<a href="./menu.php?id=5">系统设置</a>
				<ul class="none">
aaa;
			echo $str;
				}?>
					<li class="menu-item"><a href="">推荐管理</a></li>
					<li class="menu-item"><a href="">导航管理</a></li>
					<li class="menu-item"><a href="">列表管理</a></li>
					<li class="menu-item"><a href="">广告管理</a></li>
				</ul>
			</li>
			<?php if ($id==6){
			$str=<<<aaa
				<li class="explode">
				<a href="./menu.php?id=0">统计管理</a>
				<ul class="">
aaa;
			echo $str;
				}else{
		$str=<<<aaa
			<li class="collapse">
				<a href="./menu.php?id=6">统计管理</a>
				<ul class="none">
aaa;
			echo $str;
				}?>
					<li class="menu-item">统计管理</li>
					<li class="menu-item"></li>
				</ul>
			</li>
		</ul>

	</div>
</body>
</html>