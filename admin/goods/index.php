<?php 
	include '../common.php';


	$where=array();
	if($_GET['name']!=''){
		$name = stripslashes($_GET['name']);
		$arr[]="name=$name";
		$where[]= "g.name like '%$name%'";
	}
	if($_GET['cate']!=''){
		$cate = stripslashes($_GET['cate']);
		$arr[]="cate=$cate";
		$sql="select id from cate where name like '%$cate%'";
		$cate_list=query($sql);
		foreach ($cate_list as $val) {
			$where[]= "cate_id =".$val['id'];
		}
	}
	if($_GET['price'] !=''&&$_GET['price1']!=''){
		$price = stripslashes($_GET['price']);
		$price1 = stripslashes($_GET['price1']);
		$arr[]="price=$price&price1=$price1";
		$where[]= "price between $price and $price1";
	}elseif($_GET['price']!=''){
		$price = stripslashes($_GET['price']);
		$arr[]="price=$price";
		$where[]= "price > $price";
	}elseif($_GET['price1']!=''){
		$price1 = stripslashes($_GET['price1']);
		$arr[]="price1=$price1";
		$where[]= "price < $price1";
	}
	if (count($arr)>0){
		$search= implode('&',$arr);
		$term1= 'and '.implode('and',$where);
		$term2 = 'where '.implode('and',$where);
	}
		

		$sql="select count(id) num from goods g $term2";
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		$total=$row['num'];    //总条数
		$num=5;			//每页条数
		$amout=ceil($total/$num);  //可分页数
		$page=$_GET['p'];
		$page=max($page,1);
		$page=min($amout,$page);
		$offest=($page-1)*$num;  //初始量

	$sql="select g.id,g.name gname,g.price,g.num,g.is_up,g.up_time,g.down_time,g.is_best,g.is_hot,g.is_new,gm.name gmn,gm.is_face,c.name cname from goods g, goods_img gm,cate c where g.id=gm.goods_id && gm.is_face=1 && c.id=g.cate_id $term1 order by g.id desc limit $offest,$num
	";

	$goods_list=query($sql);


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>商品列表</title>
	<link rel="stylesheet" href="../../css/admin.css"/>
</head>
<body class="main">
	<div id="listDiv" class="list-div">
		<h1>
			<span class="action-span1"><a href="">管理中心</a></span>
			<span id="search_id" class="action-span1"> - 商品列表 </span>
			<span class="action-span"><a href="<?php echo URL ?>add.php">添加商品</a></span>
		</h1>
		<div class="form-div">
			<form action="index.php" method="get">
				按商品名搜索
				<input size="15" type="text" name="name">
				按类别搜索
				<select name="cate">
					<option>按类别搜索</option>
					
					<option value=""></option>
				<select>
				按价格搜索&nbsp;&nbsp;
				大于
				<input size="8" type="text" name="price" >
				小于
				<input size="8" type="text" name="price1" >
				<input type="submit" value="搜索">
			</form>
		</div>
		<table class="admin_userlist">
		<tr>
			<th>商品编号</th>
			<th>商品</th>
			<th>类别</th>
			<th>价格</th>
			<th>库存</th>
			<th>上架</th>
			<th>上架时间</th>
			<th>下架时间</th>
			<th>精品</th>
			<th>热销</th>
			<th>新品</th>
			<th>操作</th>
		</tr>
		<?php if (!empty($goods_list)): ?>
		<?php foreach($goods_list as $val): ?>
		<tr>
			<td><?php echo $val['id'] ;?></td>
			<?php 
				$path='';
				$path .='http://'.$_SERVER['HTTP_HOST'].'/JD.com/upload/';
				$path .=substr($val['gmn'],0,4).'/';
				$path .=substr($val['gmn'],4,2).'/';
				$pathname=$path.'62_'.$val['gmn'];
			 ?>
			<td><img src="<?php echo $pathname;?>" title=" <?php echo $val['gname'] ?>" alt=""></td>
			<td><?php echo $val['cname'] ; ?></td>
			<td><?php echo $val['price'] ; ?></td>
			<td><?php echo $val['num'] ; ?></td>
			<td><?php echo $val['is_up']==1?'<a href="action.php?a=up&id='.$val['id'].'&is_up=1"><img src="'.URL.'../../images/yes.gif" alt="是" /></a>':'<a href="action.php?a=up&id='.$val['id'].'&is_up=0"><img src="'.URL.'../../images/no.gif" alt="否"/></a>'  ?></td>
			<td><?php echo date('Y-m-d',$val['up_time']) ; ?></td>
			<td><?php echo date('Y-m-d',$val['down_time']); ?></td>
			<td><?php echo $val['is_best']==1?'<a href="action.php?a=best&id='.$val['id'].'&is_best=1"><img src="'.URL.'../../images/yes.gif" alt="是" /></a>':'<a href="action.php?a=best&id='.$val['id'].'&is_best=0"><img src="'.URL.'../../images/no.gif" alt="否"/></a>'  ; ?></td>
			<td><?php echo $val['is_hot']==1?'<a href="action.php?a=hot&id='.$val['id'].'&is_hot=1"><img src="'.URL.'../../images/yes.gif" alt="是" /></a>':'<a href="action.php?a=hot&id='.$val['id'].'&is_hot=0"><img src="'.URL.'../../images/no.gif" alt="否"/></a>' ; ?></td>
			<td><?php echo $val['is_new']==1?'<a href="action.php?a=new&id='.$val['id'].'&is_new=1"><img src="'.URL.'../../images/yes.gif" alt="是" /></a>':'<a href="action.php?a=new&id='.$val['id'].'&is_new=0"><img src="'.URL.'../../images/no.gif" alt="否"/></a>'  ; ?></td>
			
			<td>
				<a href="edit.php?id=<?php echo  $val['id'] ;?>">编辑</a>||
				<a href="index.php?pid=<?php echo $val['id'] ; ?>">删除</a>||
				<a href="imglist.php?id=<?php echo  $val['id'] ;?>">图像编辑</a>||
			</td>
			</tr>
		<?php endforeach; ?>
		<?php endif; ?>
		</table>
	</div>
		<div><?php echo  page($num,$total,$page,"index?",$search) ?></div>
</body>
</html>