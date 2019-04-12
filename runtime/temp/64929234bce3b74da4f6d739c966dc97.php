<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"/home/wwwroot/udai/public/../application/admin/view/order/order_show.html";i:1530082286;}*/ ?>
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
                <img src="/static/admin/images/logo.png" class="layui-circle" style="width:50px;float:left">
                <dl style="margin-left:80px; color:#019688">
                <dt><span ></span> <span ></span></dt>
                <dd style="margin-left:0"></dd>
              </dl>
            </blockquote>
            <div class="pd-20">
              <table  class="layui-table" lay-skin="line">
                <tbody>
                   <tr>
                    <th>订单编号：</th>
                    <td><?php echo $list['orderhao']; ?></td>
                  </tr>
                   <tr>
                      <th  width='80'>商品名：</th>
                      <td>
                          <?php echo $v['goods_name']; ?>
                      </td>
                  </tr>
                  <tr>
                    <th>商品单价：</th>
                    <td><?php echo $v['price']; ?></td>
                  </tr>
                  <tr>
                    <th>数量：</th>
                    <td><?php echo $v['num']; ?></td>
                  </tr>
                  <tr>
                    <th>联系人：</th>
                    <td><?php echo $list['linkman']; ?></td>
                  </tr>
                  <tr>
                    <tr>
                    <th>地址：</th>
                    <td><?php echo $list['address']; ?></td>
                  </tr>
                    <tr>
                    <th>手机号：</th>
                    <td><?php echo $list['phone']; ?></td>
                  </tr>
                   <tr>
                    <th>付款方式：</th>
                    <td>
                      <?php if($list['payment']=='1'): ?>银行卡支付
                      <?php elseif($list['payment']=='2'): ?>支付宝支付 
                      <?php else: ?> 微信支付
                      <?php endif; ?>
                    </td>
                    
                  </tr>
                  <tr>
                    <th>状态：</th>
                    <td><?php if($list['state']=='0'): ?>未付款
                        <?php elseif($list['state']=='1'): ?>已付款,未发货
                        <?php elseif($list['state']=='2'): ?>已发货,未收货
                        <?php elseif($list['state']=='3'): ?>已收货
                        <?php else: ?>已评价
                        <?php endif; ?>
                    </td>
                    
                  </tr>
                    <th>总金额：</th>
                    <td><?php echo $list['total']; ?></td>
                  </tr>
                  <tr>
                    <th>添加时间：</th>
                    <td><?php echo date("Y-m-d H:i:s",$list['createtime']); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
        <script src="/static/admin/lib/layui/layui.js" charset="utf-8">
        </script>
        <script src="/static/admin/js/x-layui.js" charset="utf-8">
        </script>
        <script>
            layui.use(['form','layer'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer;
            
              //自定义验证规则
              form.verify({
                nikename: function(value){
                  if(value.length < 5){
                    return '昵称至少得5个字符啊';
                  }
                }
                ,pass: [/(.+){6,12}$/, '密码必须6到12位']
                ,repass: function(value){
                    if($('#L_pass').val()!=$('#L_repass').val()){
                        return '两次密码不一致';
                    }
                }
              });
            });
        </script>
    </body>
</html>