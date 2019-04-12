<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"/home/wwwroot/udai/public/../application/admin/view/login/index.html";i:1530082176;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
             U袋网后台
        </title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="/static/admin/css/x-admin.css" media="all">
    </head>
    
    <body style="background-color: #393D49">
        <div class="x-box">
            <div class="x-top">
                <i class="layui-icon x-login-close">
                    &#x1007;
                </i>
                <ul class="x-login-right">
                    <li style="background-color: #F1C85F;" color="#F1C85F">
                    </li>
                    <li style="background-color: #EA569A;" color="#EA569A">
                    </li>
                    <li style="background-color: #393D49;" color="#393D49">
                    </li>
                </ul>
            </div>
            <div class="x-mid">
                <div class="x-avtar">
                    <img src="/static/admin/images/logo.png" alt="">
                </div>
                <div class="input">
                    <form class="layui-form" onsubmit="return dologin(this)">
                        <div class="layui-form-item x-login-box">
                            <label for="username" class="layui-form-label">
                                <i class="layui-icon">&#xe612;</i>
                            </label>
                            <div class="layui-input-inline">
                                <input type="text" name="admin_name" required="" lay-verify="username"
                                autocomplete="off" placeholder="username" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item x-login-box">
                            <label for="pass" class="layui-form-label">
                                <i class="layui-icon">&#xe628;</i>
                            </label>
                            <div class="layui-input-inline">
                                <input type="password" name="password" required=""
                                autocomplete="off" placeholder="******" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item x-login-box">
                            <label for="pass" class="layui-form-label">
                                <i class="layui-icon">&#xe609;</i>
                            </label>
                            <div class="layui-input-inline">
                                <input type="text" name="code" required="" lay-verify="coke"
                                autocomplete="off" placeholder="请输入验证码" class="layui-input">
                            </div>
                               <img src="<?php echo captcha_src(); ?>" id="dl" style="cursor: pointer" title="看不清，点击换一张"  alt="看不清，点击换一张" onclick="this.src=this.src+'?time='"+ Math.random() />
                            </div>
                        <div class="layui-form-item" id="loginbtn">
                           <input type="submit" name="" class="layui-btn" lay-filter="save" lay-submit="" value="登录">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <p style="color:#fff;text-align: center;">Copyright © 2017.Company name All rights X-admin </p>
        <script src="/static/admin/lib/layui/layui.js" charset="utf-8">
        </script>
        <script src="/static/admin/js/jquery.js" charset="utf-8">
        </script>
        <script>
          function dologin(form){
            $.ajax({
                url:"<?php echo url('dologin'); ?>",
                type:"post",
                data:$(form).serialize(),
                dataType:"json",
                async:true,
                success:function(data){
                    if (data == "NO") {
                        layer.msg('验证码错误!',{icon: 5,time:1000});
                        setTimeout('window.location.reload();',1000);
                    }else if(data == "OK"){
                        window.location.href="adminindex";
                    }else{
                        layer.msg('用户名或密码错误!',{icon: 5,time:1000});
                        setTimeout('window.location.reload();',1000);
                    }
                }
            });
             return false;
        }

         layui.use(['form','layer'], function(){
                $ = layui.jquery;
              var form = layui.form();
              layer = layui.layer;
            });
        </script>
    </body>

</html>