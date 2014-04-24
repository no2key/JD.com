<?php
	include '../common.php';
	$pid=(int)$_GET['pid'];

		$sql="select id,name,pid,path from cate where pid = '$pid'";
		$result=mysql_query($sql);
		if($result && mysql_num_rows($result)>0){
			$user_list=array();
			while ($row=mysql_fetch_assoc($result)) {
				$user_list[]=$row;
			}
		}
	
		mysql_free_result($result);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../../css/admin.css"/>
</head>
<body class="main">
	<div id="listDiv" class="list-div">
		<div class="form-div clearfix">
				<?php 
					$sql="select id,pid from cate where id='$pid'";
					$row=mysql_fetch_assoc(mysql_query($sql));
					$di=$row['pid'];
					mysql_close($link);
				 ?>
				<span class="prev-span"><a href="index.php?pid= <?php echo $di ?>">返回上一级</a></a></span>
				<span class="action-span"><a href="<?php echo URL ?>add.php">添加一级分类</a></span>
		</div>
		<table class="admin_userlist">
		<tr>
			<th>编号</th>
			<th>分类名称</th>
			<th>pid</th>
			<th>path</th>
			<th>操作</th>
		</tr>
		<?php if (!empty($user_list)): ?>
		<?php foreach($user_list as $val): ?>
		<tr>
			<td><?php echo $val['id'] ?></td>
			<td><?php echo $val['name'] ?></td>
			<td><?php echo $val['pid'] ?></td>
			<td><?php echo $val['path'] ?></td>
			
			<td>
				<a href="edit.php?id=<?php echo $val['id'] ?>">编辑分类</a>||
				<a href="index.php?pid=<?php echo $val['id'] ?>">查看子分类</a>||
				<a href="add.php?path=<?php echo $val['path'] ?>&pid=<?php echo $val['id'] ?>">添加子分类</a>||
				<a href="action.php?list=del&id=<?php echo $val['id'] ?>">删除</a>
			</td>
			</tr>
		<?php endforeach; ?>
		<?php endif; ?>
		</table>
	</div>
		<div><?php echo  $str ; ?></div>
</body>
</html>