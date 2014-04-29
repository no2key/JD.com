<?php 
	//更改须权限判断
	include '../common.php';
	$id=$_GET['id'];
	$sql="select id,name,email,birth,sex,tel,address,statue,admin,icon from user where id = '$id'";
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
		<form action="action.php?list=edit" method="post" enctype="multipart/form-data">
	 		<table width="100%" class="">
	 			<?php if(!empty($user_list)): ?>
	 			<?php foreach ($user_list as $val): ?>
	 			<tr>
	 				<td class="label">会员编号:</td>
	 				<td clospan="2"><input type="hidden" name="id" value="<?php echo $val['id']; ?>"><?php echo $val['id']; ?> </td>
	 			</tr>
	 			<tr>
	 				<td class="label">会员姓名:</td>
	 				<td clospan="2"> <?php echo $val['name']; ?> </td>
	 			</tr>
	 			<tr>
	 				<td class="label">会员头像:</td>
	 				<?php 
						$path='';
						$path .=URL.'../../upload/';
						$path .=substr($val['icon'],0,4).'/';
						$path .=substr($val['icon'],4,2).'/';
						$pathname=$path.'120_'.$val['icon'];
			 		?>
	 				<td><img src="<?php echo $pathname ?>"  alt=""><input type="hidden" name="path" value="<?php echo $val['icon'] ?>"></td>
	 				<td><input type="file" name="pic"></td>
	 			</tr>
	 			<tr>
	 				<td class="label">邮箱地址:</td>
	 				<td clospan="2"><input type="text" name="email" value="<?php echo $val['emile']; ?>"></td>
	 			</tr>
	 			<tr>
	 				<td class="label">生日:</td>
	 				<td clospan="2">
	 					<input type="text" size="4" name="birth" value="<?php echo date('Y',$val['birth']); ?>">年
	 					<input type="text" size="2" name="birth1" value="<?php echo date('m',$val['birth']); ?>">月
	 					<input type="text" size="2" name="birth2" value="<?php echo date('d',$val['birth']); ?>">日

	 				</td>
	 			</tr>
	 			<tr>
	 				<td class="label">性别:</td>
	 				<td clospan="2"><input type="radio" name="sex" value="1" <?php echo $val['sex']==1?checked:''; ?>>男<input type="radio" name="sex" value="0" <?php echo $val['sex']==0?checked:''; ?>>女</td>
	 			</tr>
	 			<tr>
	 				<td class="label">电话/手机:</td>
	 				<td clospan="2"><input type="text" name="tel" value="<?php echo $val['tel']; ?>"></td>
	 			</tr>
	 			<tr>
	 				<td class="label">地址:</td>
	 				<td clospan="2"><input type="text" name="add" value="<?php echo $val['address']; ?>"></td>
	 			</tr>
	 			<tr>
	 				<td class="label">状态:</td>
	 				<td clospan="2"><input type="radio" name="statue" value="1" <?php echo $val['statue']==1?checked:''; ?>>启用<input type="radio" name="statue" value="0" <?php echo $val['statue']==0?checked:''; ?>>禁用</td>
	 			</tr>
	 			<tr>
	 				<td class="label">所属组:</td> 
	 				<td clospan="2">
	 					<select name="admin">
							<option value="0" <?php echo $val['admin']==0?selected:''; ?>>超级管理员</option>
							<option value="2" <?php echo $val['admin']==2?selected:''; ?>>管理员</option>
							<option value="3" <?php echo $val['admin']==3?selected:''; ?>>普通会员</option>
						</select>
	 				</td>
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