<?php
	include '../common.php';

	//把分类表查询出来，并用option进行显示，用来确定商品分类
	$sql = "select id,name,pid,path,concat(path,id,',') bpath from cate order by bpath";

	$cate_list = query($sql);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>Add</title>
		<link rel="stylesheet" href="<?php echo dirname(URL) ?>/../css/admin.css">
	</head>
 <body class="main">
	<h1>
		<span class="action-span1"><a href="">管理中心</a></span>
		<span id="search_id" class="action-span1"> - <a href="<?php echo URL ?>index.php">商品列表</a></span>
		<span class="action-span">
			<a href="">商品添加</a>
		</span>
		<div style="clear:both"></div>
	</h1>

		<form action="action.php?a=add" method="post" enctype="multipart/form-data">
			<table class="admin_userlist add">
				<tr>
					<td class="label">商品名称:</td>
					<td><input type="text" name="name" /></td>
				</tr>
				<tr>
					<td class="label">商品分类:</td>
					<td>
						<select name="cate_id">
							<option value=''>请选择...</option>

							<!-- 把分类表中的内容遍历显示出来 -->
							<?php if(!empty($cate_list)): ?>
							<?php foreach($cate_list as $val): ?>
							<option value="<?php echo $val['id'] ?>"><?php echo str_repeat("&nbsp;&nbsp;",substr_count($val['path'],',')).$val['name']; ?></option>
							<?php endforeach; ?>
							<?php endif; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="label">商品价格:</td>
					<td><input type="text" name="price" /></td>
				</tr>
				<tr>
					<td class="label">商品数量:</td>
					<td><input type="text" name="num" /></td>
				<tr>
				<tr>
					<td class="label">是否上架:</td>
					<td><input type="radio" name="is_up" value="1" checked />是
							<input type="radio" name="is_up" value="0" />否
					</td>
				</tr>
				<tr>
					<td class="label">精品?:</td>
					<td><input type="radio" name="is_best" value="1" />是
						<input type="radio" name="is_best" value="0" checked />否</td>
				<tr>
				<tr>
					<td class="label">热卖？:</td>
					<td><input type="radio" name="is_hot" value="1" />是
						<input type="radio" name="is_hot" value="0" checked />否
					</td>
				</tr>
				<tr>
					<td class="label">新品？:</td>
					<td><input type="radio" name="is_new" value="1" />是
						<input type="radio" name="is_new" value="0" checked />否</td>
				</tr>
				<tr>
					<td class="label">商品图片:</td>
					<td><input type="file" name="pic" /></td>
				</tr>
				<tr>
					<td class="label">描述:</td>
					<td><textarea name="describe"></textarea></td>
				</tr>
				<tr>
					<td class="label"></td>
					<td><input type="submit" value="添加" /></td>
				</tr>	
		</form>
	</body>
</html>
