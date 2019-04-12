<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"/home/wwwroot/udai/public/../application/admin/view/order/order_list.html";i:1530082208;}*/ ?>
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
        <link rel="stylesheet" href="/static/admin/css/bootstrap.css" media="all">
    </head>
    <body>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>订单管理</cite></a>
              <a><cite>订单列表</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
            <xblock>
                <span class="x-right" style="line-height:40px">共有数据:<?php echo $num; ?>条</span>
            </xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            订单号
                        </th>
                        <th>
                            联系人
                        </th>
                        <th>
                            联系电话
                        </th>
                        <th>
                            总金额
                        </th>
                        <th>
                            支付方式
                        </th>
                        <th>
                            添加时间
                        </th>
                        <th>
                            状态
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $lt): ?>
                    <tr>
                    <td><?php echo $lt['id']; ?></td>
                    <td><a title="订单详情查看" href="javascript:;" onclick="order_show('用户信息','ordershow?id=<?php echo $lt['id']; ?>','800','510')" class="ml-5" style="text-decoration:none;"><?php echo $lt['orderhao']; ?></a></td>
                    <td><?php echo $lt['linkman']; ?></td>
                    <td><?php echo $lt['phone']; ?></td>
                    <td><?php echo $lt['total']; ?></td>
                    <td>
                        <?php if($lt['payment']==1): ?>
                        银行卡支付
                        <?php elseif($lt['payment']==2): ?>
                        支付宝支付
                        <?php elseif($lt['payment']==3): ?>
                        微信支付
                        <?php endif; ?>
                    </td>
                    <td><?php echo date("Y-m-d H:i:s",$lt['createtime']); ?></td>
                    <td class='td-status'>
                        <span class='layui-btn layui-btn-normal layui-btn-mini'>
                            <?php if($lt['state']==0): ?>
                            未付款
                            <?php elseif($lt['state']==1): ?>
                            已付款，未发货
                            <?php elseif($lt['state']==2): ?>
                            已发货，未收货
                            <?php elseif($lt['state']==3): ?>
                            已收货，未评价
                            <?php else: ?>
                            已评价
                            <?php endif; ?>
                        </span>
                    </td>
                    <td class='td-manage'>
                        <?php if($lt['state']==1): ?>
                        <a style='text-decoration:none' onclick="fun(this,'<?php echo $lt['id']; ?>')" href='javascript:;' title='点击发货'>
                            <i class='layui-icon'>&#xe601;</i>
                        </a>
                        <?php endif; ?>
                    </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <center>
                <div id="page">
                    <?php echo $page; ?>
                </div>
            </center>
        </div>
        <script src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script src="/static/admin/js/jquery-1.8.3.min.js" charset="utf-8"></script>
        <script src="/static/admin/js/x-layui.js" charset="utf-8"></script></td>
        <script>
            layui.use(['element','layer','form'], function(){
                 form = layui.form();
              lement = layui.element();//面包导航
              layer = layui.layer;//弹出层
              //以上模块根据需要引入
            });
            /*用户-查看*/
            function order_show(title,url,w,h){
                x_admin_show(title,url,w,h);
            }
             /*用户-点击发货*/
            function fun(ob,id){
                $.get("orderfahuo",{id:id},function(data){
                    if (data>0) {
                        layer.msg('发货成功!',{icon: 5,time:1000});
                        location.reload();
                    }
                });
            }
        </script>
    </body>
</html