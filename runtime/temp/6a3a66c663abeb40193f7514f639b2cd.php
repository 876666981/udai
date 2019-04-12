<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"/home/wwwroot/udai/public/../application/admin/view/index/welcome.html";i:1530689968;}*/ ?>
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
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="/static/admin/css/x-admin.css" media="all">
    </head>
    <body>
        <div class="x-body">
            <blockquote class="layui-elem-quote">
                欢迎进入U袋网后台！<span class="f-14"></span>本网交流群： 1348399000
            </blockquote>
            <p>登录次数：<?php echo $num; ?></p>
            <p>上次登录IP：<?php echo $IP; ?> </p>
            <fieldset class="layui-elem-field layui-field-title site-title">
              <legend><a name="default">信息统计</a></legend>
            </fieldset>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>统计</th>
                        <th>评论库</th>
                        <th>图片库</th>
                        <th>产品库</th>
                        <th>用户</th>
                        <th>管理员</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>总数</td>
                        <td><?php echo $comment; ?></td>
                        <td><?php echo $filenum; ?></td>
                        <td><?php echo $product; ?></td>
                        <td><?php echo $member; ?></td>
                        <td><?php echo $admin; ?></td>
                    </tr>
                </tbody>
            </table>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th colspan="2" scope="col">服务器信息</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th width="30%">服务器计算机名</th>
                        <td><span id="lbServerName"><?php echo $Fname; ?></span></td>
                    </tr>
                    <tr>
                        <td>服务器IP地址</td>
                        <td><?php echo $FIP; ?></td>
                    </tr>
                    <tr>
                        <td>服务器域名</td>
                        <td><?php echo $FY; ?></td>
                    </tr>
                    <tr>
                        <td>服务器端口 </td>
                        <td><?php echo $FD; ?></td>
                    </tr>
                    <tr>
                        <td>本文件所在文件夹 </td>
                        <td><?php echo $WJ; ?></td>
                    </tr>
                    <tr>
                        <td>服务器操作系统 </td>
                        <td><?php echo $FC; ?></td>
                    </tr>
                    <tr>
                        <td>系统所在文件夹 </td>
                    </tr>
                    <tr>
                        <td>服务器脚本超时时间 </td>
                        <td><?php echo $overtime; ?></td>
                    </tr>
                    <tr>
                        <td>服务器的语言种类 </td>
                        <td><?php echo $language; ?></td>
                    </tr>
                    <tr>
                        <td>服务器当前时间 </td>
                        <td><?php echo $newtime; ?></td>
                    </tr>
                    <tr>
                        <td>服务器IE版本 </td>
                        <td><?php echo $IE; ?></td>
                    </tr>
                    <tr>
                        <td>虚拟内存 </td>
                        <td><?php echo $virtual; ?></td>
                    </tr>
                    <tr>
                        <td>当前程序占用内存 </td>
                        <td><?php echo $usen; ?></td>
                    </tr>
                    <tr>
                        <td>当前SessionID </td>
                        <td><?php echo $sesid; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="layui-footer footer footer-demo">
            <div class="layui-main">
                <p>欢迎来到U袋网后台</p>
               <p>福鼎市维捷投资有限公司致力于打造国内最专业的货源平台</p>
            </div>
        </div>
        <script src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script src="/static/admin/js/x-admin.js"></script>
    </body>
</html>