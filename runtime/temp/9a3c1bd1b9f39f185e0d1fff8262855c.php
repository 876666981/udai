<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"/home/wwwroot/udai/public/../application/admin/view/banner/banner_list.html";i:1530695520;}*/ ?>
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
              <a><cite>轮播列表</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
            <xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button><button class="layui-btn" onclick="banner_add('添加用户','banneradd','800','500')"><i class="layui-icon">&#xe608;</i>添加</button><span class="x-right" style="line-height:40px">共有数据：<?php echo $num; ?> 条</span></xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="" value="">
                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            缩略图
                        </th>
                        <th>
                            链接
                        </th>
                        <th>
                            描述
                        </th>
                        <th>
                            顺序
                        </th>
                        <th>
                            显示状态
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody id="x-img">
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td>
                            <input type="checkbox" value="<?php echo $vo['id']; ?>" name="id[]">
                        </td>
                        <td>
                            <?php echo $vo['id']; ?>
                        </td>
                        <td>
                            <img  src="<?php echo $vo['imgname']; ?>" width="200" alt="" height="100">点击图片试试
                        </td>
                        <td >
                            www.gejianghua.com/<?php echo $vo['link']; ?>
                        </td>
                        <td >
                            <?php echo $vo['describe']; ?>
                        </td>
                        <td><?php echo $vo['order']; ?></td>
                        <td class="td-status">
                            <?php if($vo['state'] == '1'): ?>
                                <span class="layui-btn layui-btn-normal layui-btn-mini">
                                已显示
                                </span>
                            <?php else: ?>
                                <span class="layui-btn layui-btn-disabled layui-btn-mini">
                                不显示
                            </span>
                            <?php endif; ?>
                        </td>
                        <td class="td-manage">
                            <?php if($vo['state'] == '1'): ?>
                            <a style="text-decoration:none" onclick="banner_stop(this,'<?php echo $vo['id']; ?>')" href="javascript:;" title="不显示">
                                <i class="layui-icon">&#xe601;</i>
                            </a>
                            <?php else: ?>
                              <a style="text-decoration:none" onclick="banner_start(this,'<?php echo $vo['id']; ?>')" href="javascript:;" title="显示">
                                <i class="layui-icon">&#xe601;</i>
                            </a>
                            <?php endif; ?>
                            <a title="编辑" href="javascript:;" onclick="banner_edit('编辑','banneredit?id=<?php echo $vo['id']; ?>','800','510')"
                            class="ml-5" style="text-decoration:none">
                                <i class="layui-icon">&#xe642;</i>
                            </a>
                            <a title="删除" href="javascript:;" onclick="banner_del(this,'<?php echo $vo['id']; ?>')" 
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
            layui.use(['laydate','element','laypage','layer'], function(){
                $ = layui.jquery;//jquery
              laydate = layui.laydate;//日期插件
              lement = layui.element();//面包导航
              laypage = layui.laypage;//分页
              layer = layui.layer;//弹出层

              //以上模块根据需要引入

                layer.ready(function(){ //为了layer.ext.js加载完毕再执行
                  layer.photos({
                    photos: '#x-img'
                    //,shift: 5 //0-6的选择，指定弹出图片动画类型，默认随机
                  });
                }); 
              
            });
              //批量删除提交
             function delAll () {
                layer.confirm('确认要删除吗？',function(index){
                    //捉到所有被选中的，发异步进行删除
                     var chk_value =[]; 
                    $('input[name="id[]"]:checked').each(function(){ 
                      chk_value.push($(this).val()); 
                    }); 
                    console.log(chk_value);
                    var submit = confirm(chk_value.length==0 ?'你还没有选择任何内容！':'您是否需要将id '+chk_value+'删除'); 
                    if (submit) {
                      window.location.href = "/admin/banner/deleteall/id/"+chk_value;
                      return false;
                    } else{
                      return false;
                    };
                   
                });
             }
             /*添加*/
            function banner_add(title,url,w,h){
                x_admin_show(title,url,w,h);
            }
             /*停用*/
            function banner_stop(obj,id){
                layer.confirm('确认不显示吗？',function(index){
                    $.get('bannerstate',{id:id},function(data){
                        // alert(data);
                        //发异步把用户状态进行更改
                        if (data>0) {
                            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="banner_start(this,id)" href="javascript:;" title="显示"><i class="layui-icon">&#xe62f;</i></a>');
                            $(obj).remove();
                            layer.msg('不显示!');
                            location.reload();
                        }else{
                             $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-disabled layui-btn-mini">不显示</span>');
                        }
                    });
                    
                });
            }

            /*启用*/
            function banner_start(obj,id){
                layer.confirm('确认要显示吗？',function(index){
                    $.get('bannerstate',{id:id},function(data){
                        // alert(data);
                        //发异步把用户状态进行更改
                        if (data>0) {
                            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="banner_stop(this,id)" href="javascript:;" title="不显示"><i class="layui-icon">&#xe601;</i></a>');
                            $(obj).remove();
                            layer.msg('已显示!');
                            location.reload();
                        }else{
                            $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-normal layui-btn-mini">已显示</span>');
                        }
                    });
                    
                });
            }
            // 编辑
            function banner_edit (title,url,w,h) {
                x_admin_show(title,url,w,h);
                // $.get('banneredit',{id:id},function(data){
                    
                // });
            }
            /*删除*/
            function banner_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    $.get('bannerdel',{id:id},function(data){
                        if (data>0) {
                            //发异步删除数据
                            $(obj).parents("tr").remove();
                            layer.msg('已删除!');
                            location.reload();
                        }
                    });
                    
                });
            }
            </script>
    </body>
</html>