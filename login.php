<?php 
  include 'common.php';


  $target=$_GET['target'];

  $pathfilm=ltrim(strstr($_SERVER['QUERY_STRING'],'&'),'&');

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <title>登录马尚购</title>
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="shortcut icon" href="./images/2.ico">
</head>
<body class="regbj">
  <div id="shortcut">
      <div class="Comw ">
        <ul class="fl">
          <li class="pr"><b></b><a href="#">收藏本站</a></li>
        </ul>
        <ul class="fr">
          <li>您好，欢迎来到马尚购!<a href="#">[登陆]</a><a href="./reg.php">[免费注册]</a></li>
          <li class="pr"><b></b><a href="">我的订单</a></li>
          <li class="pr"><b></b><a href="">手机版</a></li>
          <li class="pr"><b></b><a href="">客户服务</a></li>
          <li class="pr"><b></b><a href="">网站导航</a></li>
        </ul>
      </div>
    </div>
  <div class="header Comw ">
      <div class="logo fl reg">
        <a href="#"><img src="./images/relogo.png" alt="马尚购"></a>
      </div>
      <div class="logWe fl">
        
      </div>
  </div>
  <div class="logmain Comw clearfix">
    <div class="pr">
      <div id="logbgad" class="fl pa">
        <img src="" alt="">
      </div>
        <form action="action.php?list=log" method="post">
          <input type="hidden" name="target" value="<?php echo $target ?>">
          <input type="hidden" name="pathfilm" value="<?php echo $pathfilm ?>">
          <div class="logmainhCon fr">
            <div class="logbox">
              <div class="logtext">账户名:</div>
              <input class="text"  type="text" id="username" name="name">
              <label for="username"></label>
            </div>
            <div class="logbox">
              <div class="logtext">密码:</div>
              <input class="text" type="password" id="logpwd" name="password">
              <label for="password"></label>
            </div>
            <div class="logbox wj">
              <a href="">忘记密码?</a>
            </div>
             <div class="logbutn ">
              <input class="logsubmit" type="submit" value="用户登录">
            </div>
          </div>
        </form>
      </div>
  </div>
  <div class="h15"></div>
    <div class="copyRight">Copyright 2007 - 2014 mashangg.com All Rights Reserved 沪ICP证100557号 沪公网安备11011502002400号 出版物经营许可证新出发沪批字第直110138号</div>
</body>
</html>
