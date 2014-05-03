<?php
	include '../common.php';

	
	$where=array();
	if(!empty($_GET['name'])){
		$name = stripslashes(trim($_GET['name']));
		$arr[]="name=$name";
		$where[]= "name like '%$name%'";
	}
	if($_GET['sex'] !=''){
		$sex = stripslashes($_GET['sex']);
		$arr[]="sex=$sex";
		$where[]= " sex = $sex";
	}
	if (count($arr)>0){
		$search= '&'.implode('&',$arr);
		$term='where '.implode('and',$where);
	}
		

		$sql="select count(id) num from user $term";
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		$total=$row['num'];    //总条数
		$num=5;			//每页条数
		$amout=ceil($total/$num);  //可分页数
		$page=$_GET['p'];
		$page=max($page,1);
		$page=min($amout,$page);
		$offest=($page-1)*$num;  //初始量

		$sql="select id,name,icon,sex,statue,admin,reg_time from user $term limit $offest,$num";
		$user_list=query($sql);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>马尚购--用户管理</title>
	<link rel="stylesheet" href="../../css/admin.css"/>
</head>
<body class="main">
	<h1>
		<span class="action-span1">
			<a href="">管理中心</a>
		</span>
		<span id="search_id" class="action-span1"> - 会员列表 </span>
		<span class="action-span"><a href="<?php echo URL ?>add.php">添加管理员</a></span>
	</h1>
	<div id="listDiv" class="list-div">
		<div class="form-div">
			<form action="index.php" method="get">
				按姓名搜索
				<input type="text" name="name">
				按性别搜索
				<input type="radio" name="sex" value="1">男
				<input type="radio" name="sex" value="0">女
				<input type="submit" value="搜索">
			</form>
		</div>
		<table class="admin_userlist">
		<tr>
			<th>编号</th>
			<th>头像</th>
			<th>用户名</th>
			<th>性别</th>
			<th>所属权限</th>
			<th>是否验证</th>
			<th>注册日期</th>
			<th>操作</th>
		</tr>
		<?php if (!empty($user_list)): ?>
		<?php foreach($user_list as $val): ?>
		<tr>
			<td><?php echo $val['id'] ?></td>
				<?php 
						$path='';
						$path .='http://'.$_SERVER['HTTP_HOST'].'/JD.com/upload/';
						$path .=substr($val['icon'],0,4).'/';
						$path .=substr($val['icon'],4,2).'/';
						$pathname=$path.'50_'.$val['icon'];
			 		?>
			<td><img src="<?php echo $pathname ?>" alt=""></td>
			<td><?php echo $val['name'] ?></td>
			<td><?php echo $val['sex']==1?'男':'女' ?></td>
			<td><?php $prower=$val['admin']; if ($prower == 0) {echo '超级管理员';}elseif($prower == 2){ echo '管理员';}else{echo '普通会员';}
			 ?></td>
			<td><?php echo $val['statue']==1?'<div><a class="green" href="./action.php?list=statue&&statue=1&&id='.$val['id'].'">启用</a></div>':'<div><a class="red" href="./action.php?list=statue&&statue=0&&id='.$val['id'].'">禁用</a></div>'?></td>
			<td><?php echo date('Y-m-d',$val['reg_time']) ?></td>
			<td>
				<a href="<?php echo URL ?>edit.php?id=<?php echo $val['id'] ?>"><img src="../../images/icon_edit.gif" width=16 height=16 title="编辑"  alt="编辑"></a>
				<a href="<?php echo URL ?>userlist.php?id=<?php echo $val['id'] ?>"><img src="../../images/icon_view.gif" width=16 height=16 title="查看" alt="查看"></a>
				<a href=""><img src="" width=16 height=16 alt=""></a>
				<a href=""><img src="../../images/icon_drop.gif" width=16 height=16 title="删除" alt="删除"></a>
			</td>
			</tr>
		<?php endforeach; ?>
		<?php endif; ?>
		</table>
	</div>
	<!--page($num,$total,$page,$link,$search)-->
		<div><?php echo  page($num,$total,$page,"index.php?",$search) ?></div>
</body>
</html>