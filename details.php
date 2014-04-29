<?php 
	include 'header.php';
	$id=get('id');
	$sql="select g.id,g.name gn,g.price,g.num,g.describe,gm.name gmn from goods g,goods_img gm where g.id=gm.goods_id and g.id='$id'";
	$good_list=query($sql);
	$good_list=$good_list[0];
	$sql="select name from goods_img where goods_id='$id'";
	$img_list=query($sql);
?>

<div class="detail Comw clearfix"> 
	<div class="sale">
		<h3 class="s_tle"><?php echo $good_list['gn'] ?></h3>
		<div class="daren">
			<p class="text"><?php echo $good_list['describe'] ?></p>
		</div>
		<ul class="sku_meta">
				<li>
					<span class="sort">价 格</span>
					<span class="price">&yen;<?php echo $good_list['price'] ?></span>
				</li>
				<li>
					<span class="sort">销 量</span>共售出<span id="txtHint"> 283</span>件
				</li>
		</ul>
		<div class="sku_info">
			<div class="skin">
				<dl class="amount clearfix">
					<dt>数 量</dt>
						<dd>
							<div class="numBox">
								<span class="minus" onclick="minus()"></span>
								<input id="myinput" onchange="showCustomer()" class="nums" type="text" value="1" title="请输入购买数量">
								<span class="plus" onclick="add()"></span>
							</div>
							<span class="stock">(库存<span><?php echo $good_list['num'] ?></span>件)</span>
						</dd>
				</dl>
			</div>
			<div class="btn_box">
				
				<div class="same_btn">
					<a class="add_cart" title="加入购物车">
						<em class="cartico"> </em>
						加入购物车
					</a>
					<a class="buy_btn" title="立即购买">
						<em class="rmbico"> </em>
						立即购买
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="picture">
		<div class="big_pic_box">
			<div class="big_pic" style="height:632px; *font-size:582px;">
				<div class="big_pic_wrap">
					<?php 
						$dir='';
						$dir.=URL.'upload/';
						$dir.=substr($good_list['gmn'],0,4).'/';
						$dir.=substr($good_list['gmn'],4,2).'/';
						$pathfile=$dir.$good_list['gmn'];
					 ?>
					<img id="lookimg" class="j_big_show twitter_pic" src="<?php echo $pathfile ?>" alt="2014春装新款韩版时尚气质淑女西装蕾丝网纱绣花短袖连衣裙">
					</div>
				</div>
		</div>
		<div class="thumb">
			<?php if(!empty($img_list)): ?>
				<?php foreach($img_list as $val): ?>
				<a id="class" >
					<?php 
						$dir='';
						$dir.=URL.'upload/';
						$dir.=substr($val['name'],0,4).'/';
						$dir.=substr($val['name'],4,2).'/';
						$pathsfile=$dir.'62_'.$val['name'];
					?>
					<img  onmouseover="show(this)" src="<?php echo $pathsfile ?>">
				</a>
			<?php endforeach; ?>
		<?php endif; ?>
		</div>
	</div>
</div>

<script>
	document.title="<?php echo $good_list['gn'] ?>";
	function show(obj){
		//alert(obj.src);
		var src = obj.src.substring(obj.src.lastIndexOf('_')+1);
		document.getElementById('lookimg').src="http://localhost/JD.com/upload/2014/04/"+src
		document.getElementById('lookimg').className="active";
	}

	//找到input标签
	var inp = document.getElementById('myinput');

	//增加购买数量
	function add(){
		inp.value = parseInt(inp.value)+1;

	}

	//减少购买数量
	function minus(){
		inp.value = parseInt(inp.value)-1;
		if(inp.value < 1){
			inp.value=1;
		}
	}


</script>
<?php include 'footer.php' ?>