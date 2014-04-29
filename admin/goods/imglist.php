<?php 
	include '../common.php';
	$id=get('id');

	$sql="select g.id gid,g.name gn,gm.id gmid,gm.name gmn,gm.is_face from goods g,goods_img gm where g.id=gm.goods_id && g.id=$id";
	$img_list=query($sql);

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
		<h1>
			<span class="action-span1"><a href="">管理中心</a></span>
			<span id="search_id" class="action-span1"> - 商品图像列表 </span>
		</h1>
		<div class="form-div">
			<form action="action.php?a=deimg" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				添加图片
				<input type="file" name="pic">
				<input type="submit" value="图片添加">
			</form>
		</div>
		<table class="admin_userlist">
		<tr>
			<th>商品名</th>
			<th>图片</th>
			<th>封面</th>
			<th>操作</th>
		</tr>
		<?php if (!empty($img_list)): ?>
		<?php foreach($img_list as $val): ?>
		<tr>
			<td><?php echo $val['gn'] ; ?></td>
			<?php 
				$path='';
				$path .='http://'.$_SERVER['HTTP_HOST'].'/JD.com/upload/';
				$path .=substr($val['gmn'],0,4).'/';
				$path .=substr($val['gmn'],4,2).'/';
				$pathname=$path.'180_'.$val['gmn'];
			 ?>
			<td><img src="<?php echo $pathname;?>" title=" <?php echo $val['gname'] ?>" alt=""></td>
			<td><?php echo $val['is_face']==1?'<img src="'.URL.'../../images/yes.gif" alt="是" /></a>':'<a href="action.php?a=face&id='.$val['gmid'].'&gid='.$val['gid'].'&is_face=0"><img src="'.URL.'../../images/no.gif" alt="否"/></a>'?></td>

			<td>
				<a href="edit.php?id=<?php echo  $val['gid'] ;?>">编辑</a>||
				<a href="action.php?a=del&gid=<?php echo $val['gmid'] ; ?>">删除</a>||
				<a href="imglist.php?id=<?php echo  $val['gid'] ;?>">图像编辑</a>||
			</td>
			</tr>
		<?php endforeach; ?>
		<?php endif; ?>
		</table>
	</div>
		<div></div>
</body>
 </html>