<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"/home/wwwroot/udai/public/../application/admin/view/member/member_list.html";i:1530082190;}*/ ?>
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
        <script src="/static/admin/js/jquery.min.js" ></script>
    </head>
    <body>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>会员管理</cite></a>
              <a><cite>管理员列表</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
            <form class="layui-form x-center" action="memberlist" style="width:80%" method="get">
                <div class="layui-form-pane" style="margin-top: 15px;">
                  <div class="layui-form-item">
                      <label class="layui-form-label">性别</label>
                      <div class="layui-input-inline">
                            <select class="layui-select" name='sex'>
                                <option value="">请选择用户性别</option>
                                <option value="m">男</option>
                                <option value="w">女</option>
                            </select>
                        </div>
                    <div class="layui-input-inline">
                      <input type="text" name="phone"  placeholder="请输入登录名" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                    </div>
                  </div>
                </div> 
            </form>
            <xblock><span class="x-right" style="line-height:40px">共有数据:<?php echo $totol; ?> 条</span></xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                      
                        <th>
                            ID
                        </th>
                        <th>
                            登录名
                        </th>
                        <th>
                            性别
                        </th>
                        <th>
                            加入时间
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
                   <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ob): $mod = ($i % 2 );++$i;?> 
                    <tr class="aa">
                        
                        <td>
                            <?php echo $ob['id']; ?>
                        </td>
                        <td>
                              <a title="用户信息查看" href="javascript:;" onclick="admin_show('用户信息','membershow?id=<?php echo $ob['id']; ?>.html','','','510')"class="ml-5">
                              <?php echo $ob['phone']; ?></a>
                        </td>
                        <td>
                            <?php if($ob['sex'] == 'm'): ?>男
                            <?php elseif($ob['sex'] == 'w'): ?>女
                            <?php else: ?>保密
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo date('Y-m-d H:i:s',$ob['time']); ?>
                        </td>
                        <td class="td-status">
                             <?php if(($ob['state'] == '1')): ?>
                               <span class="layui-btn layui-btn-normal layui-btn-mini">
                                已启用
                            </span>
                            <?php else: ?>
                               <span class="layui-btn layui-btn-disabled layui-btn-mini">已停用</span>
                              
                            </span>
                            <?php endif; ?>
                            
                        </td>
                        <td class="td-manage">
                            <?php if(($ob['state'] == '1')): ?>
                               <a style="text-decoration:none" onclick="admin_stop(this,'<?php echo $ob['id']; ?>')" href="javascript:;" title="停用">
                                <i class="layui-icon">&#xe601;</i>
                              </a>
                            <?php else: ?>
                              <a style="text-decoration:none" onclick="admin_start(this,'<?php echo $ob['id']; ?>')" href="javascript:;" title="启用">
                                <i class="layui-icon">&#xe62f;</i>
                              </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                 <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <center>
              <div id="page"><?php echo $page; ?></div>
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
            $(".aa:last").remove();
            //批量删除提交
             function delAll () {
                layer.confirm('确认要删除吗？',function(index){
                    //捉到所有被选中的，发异步进行删除
                    layer.msg('删除成功', {icon: 1});
                });
             }
             /*添加*/
            function admin_add(title,url,w,h){
                x_admin_show(title,url,w,h);
            }
             /*用户-查看*/
            function admin_show(title,url,w,h){
                x_admin_show(title,url,w,h);
            }

             /*停用*/
            function admin_stop(obj,id){
                layer.confirm('确认要停用吗？',function(index){
                    //发异步把用户状态进行更改
                   $.get('memberstate',{id:id},function(data){
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

            /*启用*/
            function admin_start(obj,id){
                layer.confirm('确认要启用吗？',function(index){
                    $.get("memberstate",{id:id},function(data){
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
            //编辑
            function admin_edit (title,url,id,w,h) {
                x_admin_show(title,url,w,h); 
            }
            /*删除*/
            function admin_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    //发异步删除数据
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                });
            }
            </script>
    </body>
</html>