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
	</head>
	<body>
		<h2>添加商品</h2>
		<ul>
			<li><a href="<?php echo URL ?>add.php">添加商品</a></li>
			<li><a href="<?php echo URL ?>index.php">商品列表</a></li>
		</ul>

		<form action="action.php?a=add" method="post" enctype="multipart/form-data">
			商品名称：
			<input type="text" name="name" /><br/>
			商品分类：
			<select name="cate_id">
				<option value=''>请选择...</option>

				<!-- 把分类表中的内容遍历显示出来 -->
				<?php if(!empty($cate_list)): ?>
				<?php foreach($cate_list as $val): ?>
				<option value="<?php echo $val['id'] ?>"><?php echo str_repeat("&nbsp;&nbsp;",substr_count($val['path'],',')).$val['name']; ?></option>
				<?php endforeach; ?>
				<?php endif; ?>
			
			</select><br/>
			商品价格：
			<input type="text" name="price" /><br/>
			商品数量：
			<input type="text" name="num" /><br/>
			是否上架：
			<input type="radio" name="is_up" value="1" />是
			<input type="radio" name="is_up" value="0" />否<br/>
			
			精品？：
			<input type="radio" name="is_best" value="1" />是
			<input type="radio" name="is_best" value="0" />否<br/>
			热卖？：
			<input type="radio" name="is_hot" value="1" />是
			<input type="radio" name="is_hot" value="0" />否<br/>
			新品？：
			<input type="radio" name="is_new" value="1" />是
			<input type="radio" name="is_new" value="0" />否<br/>
			商品图片：<input type="file" name="pic" /><br/>
			描述：<br/>
			<textarea name="describe"></textarea>
			<input type="submit" value="添加" />
		</form>
	</body>
</html>
