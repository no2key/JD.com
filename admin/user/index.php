<?php
	include '../common.php';

	//处理搜索条件
	//1.可以按用户名搜索
	//2.可以按性别搜索
	//3.同时按用户名及性别进行搜索
	
	//处理按用户名搜索
	if(!empty($_GET['name'])){
		$name = $_GET['name'];
		$arr[] = "name like '%$name%'";
	}

	//处理按性别搜索
	if($_GET['sex'] != ''){
		$sex = $_GET['sex'];
		$arr[] = "sex='$sex'";
	}
	
	//4.在url中传递这个where条件
	echo "<pre>";
//		print_r($arr);
	echo "</pre>";

	//如果$arr中有数组元素，就说明用户传了搜索条件
	if(count($arr)>0){
		$where = 'where '.implode('and',$arr);
	}

//	echo $where;

	//如果我们分页的那些点击链接没有传递where条件过来
	//别忘了用stripslashes()这个函数把浏览器自动加上的转义斜线去掉
	$where = empty($_GET['where'])?$where:stripslashes($_GET['where']);

	if(!empty($where)){		//如果已经有where条件了，那么就把这个where条件拼接成url中传参的样子
		//&where=name like '%徐%'
		$search = '&where='.$where;
	}


		$where = empty($_GET['where'])?$where:stripcslashes($_GET['where']);

		if (!empty($where)) {
			$search = '&where='.$where;
		}
 // echo $search;

		$sql="select count(id) num from user $where";
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		$total=$row['num'];    //总条数
		$num=1;			//每页条数

		$amout=ceil($total/$num);  //可分页数

		/*$page =empty($_GET['p'])?1:(int)$_GET['p']; //当前页

		if ($page<1) {
			$page =1 ;
		}
		if ($page > $amout) {
			$page = $amout;
		}*/

		$page=$_GET['p'];
		$page=max($page,1);
		$page=min($amout,$page);


		$offest=($page-1)*$num;  //初始量

		$sql="select id,name,icon,sex,statue,admin,reg_time from user $where limit $offest,$num";
		$result=mysql_query($sql);
		if($result && mysql_num_rows($result)>0){
			$user_list=array();
			while ($row=mysql_fetch_assoc($result)) {
				$user_list[]=$row;
			}
		}
		$rows=mysql_affected_rows();

		$prev=$page-1;
		$next=$page+1;

		$start=max(1,$page-3);
		$end=min($amout,$page+3);
		for ($i=$start; $i <= $end; $i++) { 
			if ($i == $page) {
				$num_links .= '<a style="color:red;font-size:20px;" href="index.php?p='.$i.$search.'">['.$i.']</a>';
				continue;
			}
				$num_links .='<a href="index.php?p='.$i.$search.'">['.$i.']</a>';
		}



		$str= <<<aaa
			总计 $total 个记录分为 $amout 页,当前第 $page 页,每页 $num 条记录,
			<a href="index.php?p=1$search">首页</a>
			<a href="index.php?p=$prev$search">上一页</a>
			$num_links
			<a href="index.php?p=$next$search">下一页</a>
			<a href="index.php?p=$amout$search">尾页</a>
aaa;

		mysql_free_result($result);
		mysql_close($link);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>马尚购--用户管理</title>
	<link rel="stylesheet" href="../../css/admin.css"/>
</head>
<body class="main">
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
			<th>会员名称</th>
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
			<td><img src="../../<?php echo $val['icon'] ?>" alt=""></td>
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
		<div><?php echo  $str ; ?></div>
</body>
</html>