<?php 
	include 'header.php';
 ?>
<div class="Comw">
	<table class="cart">
		<tr class="cart-thead">
			<td class="t-checkbox">全选</td>
			<td colspan="2" class="t-name">商品</td>
			<td class="t-price">价格</td>
			<td class="t-num">数量</td>
			<td class="t-action">操作</td>
		</tr>
	<?php if(!empty($_SESSION['cate'])): ?>
	<?php foreach($_SESSION['cate'] as $key => $val): ?>
		<tr class="buygoods">
			<td></td>
			<?php 
				$dir='';
				$dir .=URL.'upload/';
				$dir .=substr($val['gmn'],0,4).'/';
				$dir .=substr($val['gmn'],4,2).'/';
				$path=$dir.'62_'.$val['gmn'];
			?>
			<td class="p-img"><img src="<?php echo $path ?>" alt=""></td>
			<td class="p-name"><a href="" title=""><?php echo $val['gn'] ?></a></td>
			<td>&yen;<?php echo $val['price'] ?></td>
			<td>
				<div class="numBox">
					<span class="minus" onclick="minus_one(<?php echo $key ?>)"></span>
					<span name="buy_num" class="nums"> <?php echo $val['num'] ?></span>
					<span class="plus" onclick="add_one(<?php echo $key ?>)"></span>
				</div>
			</td>
			<td><a href="cart_action.php?a=del&id=<?php echo $key ?>">移除购物车</a></td>
		</tr>
		<?php 
				$num += $val[$key]['num'];
				$tont += ($_SESSION['cate'][$key]['num']*$_SESSION['cate'][$key]['price']);
		 ?>
	<?php endforeach; ?>
			<tr class="cart-total">
			<td class="information" colspan="4"><span class="red"><?php echo $num; ?></span>件商品</td>
			<td>总计(不含运费):</td>
			<td class="total">&yen;<?php echo $tont;?></td>
		</tr>
		<tr class="buy">
			<td  colspan="4">
				<a id="continue" class="btn continue"  href="index.php">
					<span class="btn-text">继续购物</span>
				</a>
		  </td>
			<td colspan="2">
				<a id="toSettlement" class="checkout"  href="order.php">
					去结算
					<b></b>
				</a>
			</td>
		</tr>



	<?php else: ?>
	<tr class="buygoods">
		<td colspan="6">你的购物车空空如也!!!<a class="red" href="index.php">去首页挑选喜欢的商品</a></td>
	</tr>
  <?php endif; ?>
		
	</table>
</div>
<script>
	document.title='n你好!!!';
	function add_one(str){
		var s=str;
		window.location.href="cart_action.php?a=add_one&id="+s; 
	}
		function minus_one(str){
		var s=str;
		window.location.href="cart_action.php?a=minus_one&id="+s; 
	}

	function max(str){
		var m=str;
		var val=docment.getElementById(myinput);
		if (val.value>str) {
			val.value=str;
		};

	}
</script>

</script>
 <?php include 'footer.php' ?>