<?php 
	//更改须权限判断
	include '../common.php';
	$id=$_GET['id'];
	$sql="select id,name,emile,birth,sex,tel,address,statue,admin from user where id = '$id'";
	$result=mysql_query($sql);
	if ($result && mysql_num_rows($result)>0) {
		$user_list=array();
		while($row=mysql_fetch_assoc($result)){
			$user_list[]=$row;
		}
	}
	mysql_free_result($result);
	mysql_close($link);
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
 	<title>Document</title>
 	<link rel="stylesheet" href="../../css/admin.css">
 </head>
 <body class="main">
 	<h1>
		<span class="action-span">
			<a href="./index.php">会员列表</a>
		</span>
		<div style="clear:both"></div>
	</h1>
 	<div class="main-div">
		<form action="action.php?list=edit" method="post">
	 		<table width="100%" class="">
	 			<?php foreach ($user_list as $val): ?>
	 			<tr>
	 				<td class="label">会员编号:</td>
	 				<td><input type="hidden" name="id" value="<?php echo $val['id']; ?>"><?php echo $val['id']; ?> </td>
	 			</tr>
	 			<tr>
	 				<td class="label">会员姓名:</td>
	 				<td> <?php echo $val['name']; ?> </td>
	 			</tr>
	 			<tr>
	 				<td class="label">会员头像:</td>
	 				<td><img src="<?php echo $val['icon']; ?>" alt=""></td>
	 			</tr>
	 			<tr>
	 				<td class="label">邮箱地址:</td>
	 				<td><input type="text" name="email" value="<?php echo $val['emile']; ?>"></td>
	 			</tr>
	 			<tr>
	 				<td class="label">生日:</td>
	 				<td><input type="text" name="birth" value="<?php echo date('Y-m-d',$val['birth']); ?>"></td>
	 			</tr>
	 			<tr>
	 				<td class="label">性别:</td>
	 				<td><input type="radio" name="sex" value="1" <?php echo $val['sex']==1?checked:''; ?>>男<input type="radio" name="sex" value="0" <?php echo $val['sex']==0?checked:''; ?>>女</td>
	 			</tr>
	 			<tr>
	 				<td class="label">电话/手机:</td>
	 				<td><input type="text" name="tel" value="<?php echo $val['tel']; ?>"></td>
	 			</tr>
	 			<tr>
	 				<td class="label">地址:</td>
	 				<td><input type="text" name="add" value="<?php echo $val['address']; ?>"></td>
	 			</tr>
	 			<tr>
	 				<td class="label">状态:</td>
	 				<td><input type="radio" name="statue" value="1" <?php echo $val['statue']==1?checked:''; ?>>启用<input type="radio" name="statue" value="0" <?php echo $val['statue']==0?checked:''; ?>>禁用</td>
	 			</tr>
	 			<tr>
	 				<td class="label">所属组:</td> 
	 				<td>
	 					<select>
							<option value="0" <?php echo $val['admin']==0?selected:''; ?>>超级管理员</option>
							<option value="2" <?php echo $val['admin']==2?selected:''; ?>>管理员</option>
							<option value="3" <?php echo $val['admin']==3?selected:''; ?>>普通会员</option>
						</select>
	 				</td>
	 			</tr>
	 		<?php endforeach;?>
	 			<tr>
	 				<td class="label"></td> 
	 				<td ><input type="submit" value="编辑"></td>
	 			</tr>
	 		</table>
	 	</form>
 	</div>
 </body>
 </html>