<?php 
    include 'common.php';
    $sql="select name from cate where nav=1 limit 6";
    $nav_list=query($sql);
    $num=0;
    if (isset($_SESSION['cate'])) {
        foreach ($_SESSION['cate'] as  $key => $value) {
        $num += (int)$value['num'];
    }
    }
 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <title></title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="shortcut icon" href="./images/2.ico">
  </head>
  <body id="none">
    <div id="shortcut">
      <div class="Comw ">
        <ul class="fl">
          <li class="pr"><b></b><a href="#">收藏本站</a></li>
        </ul>
        <ul class="fr">
            <?php if (empty($_SESSION['home'])) :?>
                <li>您好，欢迎来到马尚购!<a href="./login.php?target=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'&'.$_SERVER['QUERY_STRING']?>">[登陆]</a><a href="./reg.php">[免费注册]</a></li>
            <?php else: ?>
                <li>您好,<?php echo $_SESSION['home']['name'] ?>，欢迎来到马尚购!<a href="./action?list=quit">[退出]</a></li>
            <?php endif; ?>
          <li class="pr"><b></b><a href="">我的订单</a></li>
          <li class="pr"><b></b><a href="">手机版</a></li>
          <li class="pr"><b></b><a href="">客户服务</a></li>
          <li class="pr"><b></b><a href="">网站导航</a></li>
        </ul>
      </div>
    </div>
    <div class="header Comw ">
      <div class="logo fl">
        <a href="./index.php"><img src="./images/logo1.png" alt="马尚购"></a>
      </div>
      <div class="search fl">
        <div class="form ">
          <form action="" method="post">
            <input id="key" class="text bd" type="text" name="username">
            <input class="submit" type="button" name="submit" value="搜索">
          </form>
        </div>
        <div class="hotword">
        </div>
      </div>
      <div class="mymsg">
        <dl class="">
            <dt><a href="center.php">我的尚购</a><b></b></dt>
            <dd></dd>
            <dd></dd>
        </dl>
      </div>
      <div class="fr">
        <div class="set"><a href="cate_show.php">购物车(<span ><?php echo $num; ?></span>)件<b></b></a></div>
        <div class="shoplist"></div>
      </div>
    </div>
    <div class="naver-main pr Comw">
        <div id="V_Category" class="index fl ">
            <div class="main pa">
                <h2><a href=""><span>所有商品分类<span></a></h2>
            </div>
            <div class="mainlist pa" >
                <ul>
                    <li class="allSortItem">
                        <h3 class="mainlist_h1"><i class="w15"></i>女装</h3>
                        <p>
                            <a href="">T恤</a>
                            <a href="">衬衫</a>
                            <a href="">卫衣</a>
                            <a href="">POLO</a>
                            <a href="">裤装</a>
                        </p>
                    </li>
                    <li class="allSortItem">
                        <h3 class="mainlist_h2"><i class="w15"></i>男装</h3>
                        <p>
                            <a href="">T恤</a>
                            <a href="">POLO</a>
                            <a href="">衬衫</a>
                            <a href="">卫衣</a>
                            <a href="">裤装</a>
                        </p>
                    </li>
                    <li class="allSortItem">
                        <h3 class="mainlist_h2"><i class="w15"></i>男装</h3>
                        <p>
                            <a href="">T恤</a>
                            <a href="">POLO</a>
                            <a href="">衬衫</a>
                            <a href="">卫衣</a>
                            <a href="">裤装</a>
                        </p>
                    </li>
                    <li class="allSortItem">
                        <h3 class="mainlist_h2"><i class="w15"></i>男装</h3>
                        <p>
                            <a href="">T恤</a>
                            <a href="">POLO</a>
                            <a href="">衬衫</a>
                            <a href="">卫衣</a>
                            <a href="">裤装</a>
                        </p>
                    </li>
                    <li class="allSortItem">
                        <h3 class="mainlist_h2"><i class="w15"></i>男装</h3>
                        <p>
                            <a href="">T恤</a>
                            <a href="">POLO</a>
                            <a href="">衬衫</a>
                            <a href="">卫衣</a>
                            <a href="">裤装</a>
                        </p>
                    </li>
                    <li class="allSortItem">
                        <h3 class="mainlist_h2"><i class="w15"></i>男装</h3>
                        <p>
                            <a href="">T恤</a>
                            <a href="">POLO</a>
                            <a href="">衬衫</a>
                            <a href="">卫衣</a>
                            <a href="">裤装</a>
                        </p>
                    </li>
                    <li class="allSortItem">
                        <h3 class="mainlist_h2"><i class="w15"></i>男装</h3>
                        <p>
                            <a href="">T恤</a>
                            <a href="">POLO</a>
                            <a href="">衬衫</a>
                            <a href="">卫衣</a>
                            <a href="">裤装</a>
                        </p>
                    </li>
                    <li class="allSortItem last">
                        <h3 class="mainlist_h3"><i class="w15"></i>女鞋/男鞋</h3>
                        <p>
                            <a href="">帆布鞋</a>
                            <a href="">运动鞋</a>
                            <a href="">休闲鞋</a>
                            <a href="">雪地靴</a>
                        </p>
                    </li>

                </ul>
            </div>
            <!--<div class="mainlistmore"></div>-->
        </div>
            <ul class="mainLeftNav fl">

                <li id="nav-ww" class="active"><a href="">首页</a></li>
                <?php if (!empty($nav_list)): ?>
                <?php foreach($nav_list as $val): ?>
                <li ><a href=""><?php echo $val['name'] ?></a></li>
                <?php endforeach; ?>
                <?php endif; ?>
            </ul>
    </div>