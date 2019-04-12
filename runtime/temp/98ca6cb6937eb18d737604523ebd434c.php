<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"/home/wwwroot/udai/public/../application/admin/view/goods/goods_list.html";i:1530088582;}*/ ?>
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
              <a><cite>产品管理</cite></a>
              <a><cite>产品列表</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
            <form class="layui-form x-center" action="goodslist" style="width:800px" method="get">
                <div class="layui-form-pane" style="margin-top: 15px;">
                    <div class="layui-form-item">
                        <div class="layui-input-inline">
                          <input type="text" name="goods_name"  placeholder="请输入商品名" autocomplete="off" class="layui-input" value="<?php echo (isset($vo['goods_name']) && ($vo['goods_name'] !== '')?$vo['goods_name']:''); ?>">
                        </div>
                        <div class="layui-input-inline" style="width:80px">
                            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                        </div>
                    </div>
                </div>
            </form>
            <xblock>
                <button class="layui-btn" onclick="goods_add('添加商品','goodsadd','800','600')"><i class="layui-icon">&#xe608;</i>添加商品</button>
                <span class="x-right" style="line-height:40px">共有数据：<?php echo $num; ?>条</span>
            </xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            商品编号
                        </th>
                        <th>
                            商品名
                        </th>
                        <th>
                            父类
                        </th>
                        <th>
                            商品单价
                        </th>
                        <th>
                            商品图片
                        </th>
                        <th>
                            库存量
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
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><?php echo $vo['id']; ?></td>
                        <td><?php echo $vo['number']; ?></td>
                        <td><a title="商品详情" href="javascript:;" onclick="goods_show('查看','goodsshow?id=<?php echo $vo['id']; ?>','800','600')"
                            class="ml-5" style="text-decoration:none">
                            <?php echo $vo['goods_name']; ?></a></td>
                        <td><?php echo $vo['name']; ?></td>
                        <td><?php echo $vo['price']; ?>元</td>
                        <td><img src="../uploads/<?php echo substr($vo['img'],0,45); ?>" alt="" width='100'></td>
                        <td><?php echo $vo['stock']; ?>件</td>
                        <td><?php echo date('Y-m-d H:i:s',$vo['addtime']); ?></td>
                        <td>
                            <?php if(($vo['state'] == '1')): ?>
                               <span class="layui-btn layui-btn-normal layui-btn-mini">上架</span>
                            <?php else: ?>
                               <span class="layui-btn layui-btn-disabled layui-btn-mini">下架</span>
                            <?php endif; ?>
                        </td>
                       <td class="td-manage">
                            <?php if(($vo['state'] == '1')): ?>
                               <a style="text-decoration:none" onclick="goods_stop(this,'<?php echo $vo['id']; ?>')" href="javascript:;" title="下架">
                                <i class="layui-icon">&#xe601;</i>
                              </a>
                            <?php else: ?>
                              <a style="text-decoration:none" onclick="goods_start(this,'<?php echo $vo['id']; ?>')" href="javascript:;" title="上架">
                                <i class="layui-icon">&#xe62f;</i>
                              </a>
                            <?php endif; ?>
                            <a title="添加属性" href="javascript:;" onclick="goods_attr_add('添加属性','goodsattradd?id=<?php echo $vo['id']; ?>','800','600')"
                            class="ml-5" style="text-decoration:none">
                                <i class="layui-icon">&#xe608;</i>
                            </a>
                            <a title="编辑商品" href="javascript:;" onclick="goods_edit('编辑商品','goodsedit?id=<?php echo $vo['id']; ?>','800','600')"
                            class="ml-5" style="text-decoration:none">
                                <i class="layui-icon">&#xe642;</i>
                            </a>
                            <a title="删除" href="javascript:;" onclick="goods_del(this,'<?php echo $vo['id']; ?>')" 
                            style="text-decoration:none">
                                <i class="layui-icon">&#xe640;</i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <center>
                <div id="page">
                    <?php echo $page; ?>
                </div>
            </center>
        </div>
        <script src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script src="/static/admin/js/x-layui.js" charset="utf-8"></script>
       
        <script>
             layui.use(['laydate','element','laypage','layer','form'], function(){
                $ = layui.jquery;//jquery
              laydate = layui.laydate;//日期插件
              lement = layui.element();//面包导航
              laypage = layui.laypage;//分页
              var form = layui.form();
              layer = layui.layer;//弹出层
            });
             
            /*用户-删除*/
            function goods_del(obj,id){
                layer.confirm('确认要删除吗？',function(){
                     $.get('goodsdel',{id:id},function(data){
                        if (data>0) {
                            //发异步删除数据
                            $(obj).parents("tr").remove();
                            layer.msg('已删除!');
                            location.reload();
                        }
                    });
                });
            }
            //商品-添加
            function goods_add (title,url,w,h) {
                x_admin_show(title,url,w,h); 
            }
             //商品-展示
            function goods_show (title,url,w,h) {
                x_admin_show(title,url,w,h); 
            }
            //商品属性-添加
            function goods_attr_add (title,url,w,h) {
                x_admin_show(title,url,w,h); 
            }
            //商品-编辑
            function goods_edit (title,url,w,h) {
                x_admin_show(title,url,w,h); 
            }


               /*下架*/
            function goods_stop(obj,id){
                layer.confirm('确认要下架吗？',function(index){
                    //发异步把用户状态进行更改
                   $.get('goodsstate',{id:id},function(data){
                        // alert(data);
                        //发异步把用户状态进行更改
                        if (data>0) {
                           $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="layui-icon">&#xe62f;</i></a>');
                            $(obj).remove();
                            layer.msg('已停用!');
                            location.reload();
                        }else{
                             $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-disabled layui-btn-mini">停用</span>');
                        }
                    });
                    
                });
             
            }

            /*上架*/
            function goods_start(obj,id){
                layer.confirm('确认要上架吗？',function(index){
                    $.get("goodsstate",{id:id},function(data){
                        if (data>0) {
                             $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="layui-icon">&#xe601;</i></a>');
                            $(obj).remove();
                            layer.msg('已启用!');
                            location.reload();
                        }else{
                            $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-normal layui-btn-mini">停用</span>');
                        }

                    });
                  
                });
            }
        </script>
    </body>
</html>