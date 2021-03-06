<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登陆</title>
    <link href="/UCS/Public/css/common.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/UCS/Public/css/main.css">
    <script src="/UCS/Public/js/common.js"></script>
    <script src="/UCS/Public/js/jquery.min.js"></script>
</head>
<body>
      <div class="loginBox">
          <h1 class="h1 login-title"></h1>
          <input type="hidden" value="<?php echo ($error); ?>" id="error">
          <div class="login">
              <form action="<?php echo U('Admin/Index/index');?>" method="post" autocomplete="off">
                  <div class="userName">用户名<input type="text" name="userName"><dfn></dfn></div>
                  <div class="userKey">密码<input type="password" name="userKey"><dfn></dfn></div>
                  <div class="verify_pic">验证码：<input type="text" value="" class="verify-value"><img src="<?php echo U('Home/User/verify_pic',array());?>" alt="验证码" onclick="fleshVerify()"><span></span></div>
                  <div class="logCheck clear"><label class="regKey"><input type="checkbox">记住密码</label></div>
                  <div class="subBtn"><input type="submit" value="登陆" class="button button-base button-class"></div>
              </form>
              <div class="tips"><a href="<?php echo U('Home/User/regist');?>">注册|</a><a href="#">忘记密码?</a></div>
          </div>
      </div>

      <script>
          var oUserName=document.querySelector(".userName input");
          var oDfn_U=document.querySelector(".userName dfn");
          var oUserKey=document.querySelector(".userKey input");
          var oDfn_P=document.querySelector(".userKey dfn");
          var oSubmit=document.querySelector(".subBtn input");
          var oLogin=new verfiy({user:oUserName,password:oUserKey,userDfn:oDfn_U,passDfn:oDfn_P,submit:oSubmit});
          var oRemPass=document.querySelector(".regKey input");
          var oError=document.getElementById('error');
          if(oError.value)
          {
              new popup(oError.value);
          }
      </script>
      <script src="/UCS/Public/js/login.js"></script>
</body>
</html>