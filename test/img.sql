$sql="select ogs.goods_num,ogs.price,g.id,g.name gn,gm.name gmn 
			from order_goods ogs,goods_img gm,goods g  where 
			g.id=ogs.goods_id and gm.goods_id=g.id and ogs.order_info_id=
			";