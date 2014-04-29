<?php 
	include '../common.php';
	$id=$_GET['id'];
  $sql="select g.id,g.cate_id,g.name gn,g.price,g.num,c.name cn,c.pid,c.path,concat(c.path,c.id,',') bpath from goods g, cate c where g.id = '$id' && c.id=g.cate_id order by bpath  ";
	$goods_list=query($sql);

	$sql = "select id,name,pid,path,concat(path,id,',') bpath from cate order by bpath";

	$cate_list = query($sql);
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
 	<title>商品编辑</title>
 	<link rel="stylesheet" href="../../css/admin.css">
 </head>
 <body class="main">
 	<h1>
		<span class="action-span">
			<a href="./index.php">商品列表</a>
		</span>
		<div style="clear:both"></div>
	</h1>
 	<div class="main-div">
		<form action="action.php?a=edit" method="post" enctype="multipart/form-data">
	 		<table width="100%" class="">
	 			<?php if(!empty($goods_list)): ?>
	 			<?php foreach ($goods_list as $value): ?>
	 			<tr>
	 				<td class="label">商品名称:</td>
	 				<td ><input type="hidden" name="id" value="<?php echo $value['id']; ?>"><input type="text" name="name" value="<?php echo $value['gn']; ?>"></td>
	 			</tr>
	 			<tr>
	 				<td class="label">商品类别:</td>
	 					<td>
	 						<select name="cate_id">
								<option value=''>请选择...</option>
								<!-- 把分类表中的内容遍历显示出来 -->
								<?php if(!empty($cate_list)): ?>
								<?php foreach($cate_list as $val): ?>
									<?php if ($val['id']==$value['cate_id']): ?>
											<option value="<?php echo $val['id'] ?>" selected><?php echo str_repeat("&nbsp;&nbsp;",substr_count($val['path'],',')).$val['name']; ?></option>
									
									<?php else: ?>
									<option value="<?php echo $val['id'] ?>"><?php echo str_repeat("&nbsp;&nbsp;",substr_count($val['path'],',')).$val['name']; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php endif; ?>
			     </select><br/>
	 					</td>
	 			</tr>
	 			<tr>
	 				<td class="label">价格:</td>
	 				<td ><input type="text" name="price" value="<?php echo $value['price']; ?>"> </td>
	 			</tr>
	 			<tr>
	 				<td class="label">库存:</td>
	 				<td ><input type="text" name="num" value="<?php echo $value['num']; ?>"> </td>
	 			</tr>
	 		<?php endforeach;?>
	 	<?php endif; ?>
	 			<tr>
	 				<td class="label"></td> 
	 				<td clospan="2"><input type="submit" value="编辑"></td>
	 			</tr>
	 		</table>
	 	</form>
 	</div>
 </body>
 </html>