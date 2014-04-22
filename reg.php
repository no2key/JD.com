<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <title>马尚购-会员免费注册</title>
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
          <li>您好，欢迎来到马尚购!<a href="./login.php">[登陆]</a><a href="./reg.php">[免费注册]</a></li>
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
      <div class="regWe fl">
        <img src="./images/regist-word.png" alt="欢迎注册">
      </div>
  </div>
  <div class="regmain Comw clearfix">
      <form action="action.php?list=reg" method="post">
        <div class="regmainhCon fl">
          <p class="regbox">
            <span class="regtext"><b>*</b>账户名:</span>
            <input class="text"  type="text" id="name" name="name" value="请输入用户名"  onblur="if(this.value=='') {this.value='请输入用户名';this.style.color='#999999'}" onfocus="if(this.value=='请输入用户名') this.value='';this.style.color='#333'" >
            <label for="username"></label>
          </p>
          <p class="regbox">
            <span class="regtext"><b>*</b>请设置密码:</span>
            <input class="text" type="password" id="password" name="password">
            <label for="password"></label>
          </p>
          <p class="regbox">
            <span class="regtext"><b>*</b>请确认密码:</span>
            <input class="text" type="password" id="pwdRepeat" name="pwdRepeat">
            <label for="pwdRepeat"></label>
          </p>
          <p class="regbox">
            <span class="regtext"><b>*</b>验证码:</span>
            <input class="yzm" type="text" id="yzm" name="yzm">
            <img src="./yzm.php">
          </p>
          <p class="regbox xy">
            <span class="regtext"></span>
            <input class="checkbox" type="checkbox" value="">
            <label class='fl'>我已阅读并同意<a href="#">《马尚购用户注册协议》</a></label>
          </p>
          <p class="regbox ">
            <span class="regtext"></span>
            <input class="regsubmit" type="submit" value="用户注册">
          </p>
        </div>
      </form>
      <div class="fr">
        <p>
          我已经注册,现在就
          <a href="">登录</a>
        </p>
      </div>
  </div>
  <div class="h15"></div>
    <div class="copyRight">Copyright 2007 - 2014 mashangg.com All Rights Reserved 沪ICP证100557号 沪公网安备11011502002400号 出版物经营许可证新出发沪批字第直110138号</div>
</body>
</html>
