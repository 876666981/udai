<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"/home/wwwroot/udai/public/../application/admin/view/comment/comment_list.html";i:1530082120;}*/ ?>
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
              <a><cite>会员管理</cite></a>
              <a><cite>评论列表</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
            <xblock><span class="x-right" style="line-height:40px">共有数据：<?php echo $num; ?> 条</span></xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            评价商品
                        </th>
                        <th>
                           评价用户
                        </th>
                        <th>
                            评价内容
                        </th>
                        <th>
                            评价时间
                        </th>
                        <th>
                            回复内容
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody id="x-link">
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td>
                            <?php echo $vo['id']; ?>
                        </td>
                        <td>
                            <?php echo $vo['goodsid']; ?>
                        </td>
                        <td >
                           <?php echo $vo['userid']; ?>
                        </td>
                        <td >
                            <?php echo $vo['content']; ?>
                        </td> 
                        <td >
                           <?php echo date("Y-m-d H:i:s",$vo['createTime']); ?>
                        </td>
                        <td>
                            <?php echo $vo['restore']; ?>
                        </td>
                        <td class="td-manage">
                            <a title="回复" href="javascript:;" onclick="commemt_edit('回复','commentedit?id=<?php echo $vo['id']; ?>','800','510')"
                            class="ml-5" style="text-decoration:none">
                                <i class="layui-icon">&#xe642;</i>
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
            layui.use(['element','laypage','layer','form'], function(){
                $ = layui.jquery;//jquery
              lement = layui.element();//面包导航
              laypage = layui.laypage;//分页
              layer = layui.layer;//弹出层
              form = layui.form();//弹出层


          })

              

              //以上模块根据需要引入

            //批量删除提交
             function delAll () {
                layer.confirm('确认要删除吗？',function(index){
                    //捉到所有被选中的，发异步进行删除
                    layer.msg('删除成功', {icon: 1});
                });
             }
            //显示回复界面
             function commemt_edit (title,url,w,h) {
                x_admin_show(title,url,w,h);
            }
            
            /*删除*/
            function commemt_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    //发异步删除数据
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                });
            }
            </script>
    </body>
</html>