<?php 
	include '../common.php';
	$id=$_GET['id'];

	$sql="select id,name from cate where id='$id'";

	$cate_list=query($sql);
 ?>

 <!DOCTYPE html>

 <html lang="en">

 <head>

 	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">

 	<title>分类编辑</title>

 	<link rel="stylesheet" href="../../css/admin.css">

 </head>

 <body class="main">

	<h1>
		<span class="action-span1">
			<a href="">管理中心</a>
		</span>

		<span class="action-span">
			<a href="<?php echo URL ?>index.php">分类列表</a>
		</span>
		<div style="clear:both"></div>
	</h1>

 	<div class="main-div">

		<form action="action.php?list=edit" method="post" >

	 		<table width="100%" class="">

	 			<?php if(!empty($cate_list)): ?>

	 			<?php foreach ($cate_list as $val): ?>

	 			<tr>

	 				<td class="label">分类名称:</td>

	 				<td ><input type="hidden" name="id" value="<?php echo $val['id'] ?>"><input type="text" name="name" value="<?php echo $val['name']; ?>"> </td>

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