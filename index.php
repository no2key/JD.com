<?php 
include 'header.php';
	$sql1="select g.id gid,g.name gn,g.price,gm.name gmn,c.id cid,c.name cn
				from goods g, goods_img gm, cate c where gm.goods_id=g.id and gm.is_face=1 and c.id=g.cate_id and c.list=1 limit 10";
  $good_list=query($sql1);  
  $sql1="select g.id gid,g.name gn,g.price,gm.name gmn,c.id cid,c.name cn
				from goods g, goods_img gm, cate c where gm.goods_id=g.id and gm.is_face=1 and c.id=g.cate_id and c.list=1 and g.is_hot=1 limit 5";
  $hot_list=query($sql1); 
?>
	<div class="main Comw ">
		<div class="mainBanner ">
			<ul>
				<li><img src="./images/banner02.jpg" alt="" width="746" height="490" ></li>
			</ul>
		</div>
		<div class="h10"></div>
	  	<div class="sidebar ">
	  		<div class="submenu clearfix">
	  			<ul>
							<?php if(!empty($hot_list)): ?>
								<?php $i=1; ?>
	  						<?php foreach($hot_list as $val): ?>
	  						<?php 
	  							$dir='';
	  							$dir.=URL.'upload/';
	  							$dir.=substr($val['gmn'],0,4).'/';
	  							$dir.=substr($val['gmn'],4,2).'/';
	  							$path=$dir.'180_'.$val['gmn'];
	  						 ?>
		  					<li <?php if ($i%5==0){echo 'class="last"';}?>>
									<div class="s_picBox">
										<a href="details.php?id=<?php echo $val['gid'] ?>" class="s_pic" >
		  								<img  src="<?php echo $path ?>" alt="" >
		  							</a>
		  						</a>
									</div>
									<p class="txt"><?php echo $val['gn'] ?></p>
									<p class="price_box"><span class="price_red">&yen;<?php echo $val['price'] ?></span></p>
		  					</li>
		  					<?php $i++ ?>
								<?php endforeach; ?>
								<?php endif; ?>
	  			</ul>
	  		</div>


		  		<div class="content nv">
		  			<div class="contentNav pr">
		  				<span class="pa"><a href="">女装</a></span>
		  				<div class="fr"><a class="content_btn" href=""></a></div>
		  			</div>
		  			<div class="h10"></div>
		  			<div class="submenu clearfix">
		  				<ul>
								<?php if(!empty($good_list)): ?>
								<?php $i=1; ?>
	  						<?php foreach($good_list as $val): ?>
	  						<?php 
	  							$dir='';
	  							$dir.=URL.'upload/';
	  							$dir.=substr($val['gmn'],0,4).'/';
	  							$dir.=substr($val['gmn'],4,2).'/';
	  							$path=$dir.'180_'.$val['gmn'];
	  						 ?>
		  					<li <?php if ($i%5==0){echo 'class="last"';}?>>
									<div class="s_picBox">
										<a href="details.php?id=<?php echo $val['gid'] ?>" class="s_pic" >
		  								<img  src="<?php echo $path ?>" alt="" >
		  							</a>
		  						</a>
									</div>
									<p class="txt"><?php echo $val['gn'] ?></p>
									<p class="price_box"><span class="price_red">&yen;<?php echo $val['price'] ?></span></p>
									<p>576人已购买</p>
		  					</li>
		  					<?php $i++ ?>
								<?php endforeach; ?>
								<?php endif; ?>
		  				</ul>
		  			</div>
		  		</div>
		  	
				
	  		

	  	</div>
	</div>
	<div class="forum">
	  
	</div>
	<div class="serverice">
	  
	</div>
	<script>
		document.title="马尚购-最时尚的互联网购物选择";
		var body=document.getElementById('none');
		body.className="block";
	</script>
	<?php include 'footer.php';  ?>