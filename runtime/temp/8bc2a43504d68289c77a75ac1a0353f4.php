<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"/home/wwwroot/udai/public/../application/admin/view/comment/comment_edit.html";i:1530082112;}*/ ?>
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
            <form onsubmit="return doupdate(this)" enctype="multipart/form-data" method="post" id='myform'>
                <div class="layui-form-item">
                    <label for="link" class="layui-form-label">
                        <span class="x-red">*</span>评价商品
                    </label>
                    <div class="layui-input-inline">
                      <div class="site-demo-upbar">
                        <input type="hidden" name="id" value="<?php echo $list['id']; ?>" id="id">
                        <input type="text" name="goodsid" equired="" lay-verify="required" value="<?php echo $goodsname; ?>" autocomplete="off" class="layui-input" style="border:0;">
                      </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="link" class="layui-form-label">
                        <span class="x-red">*</span>评价用户
                    </label>
                    <div class="layui-input-inline">
                      <div class="site-demo-upbar">
                        <input type="text" name="userid" equired="" lay-verify="required" value="<?php echo $username; ?>" 
                        autocomplete="off" class="layui-input"  style="border:0;">
                      </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="link" class="layui-form-label">
                        <span class="x-red">*</span>评价内容
                    </label>
                    <div class="layui-input-inline">
                      <div class="site-demo-upbar">
                         <textarea placeholder="<?php echo $list['content']; ?>" id="replay" name="replay" autocomplete="off"
                        class="layui-textarea" style="height: 80px;border:0;"></textarea>
                      </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="link" class="layui-form-label">
                        <span class="x-red">*</span>评价时间
                    </label>
                    <div class="layui-input-inline">
                        <input type="text"  name="createTime" required="" lay-verify="required" value="<?php echo date('Y-m-d H:i:s',$list['createTime']); ?>" 
                        autocomplete="off" class="layui-input"  style="border:0;">
                    </div>
                </div>
                 <div class="layui-form-item layui-form-text">
                    <label for="replay" class="layui-form-label">
                        回复
                    </label>
                    <div class="layui-input-block">
                        <textarea placeholder="随便写些什么" id="replay" name="restore" autocomplete="off"
                        class="layui-textarea" style="height: 80px;"></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <input  type="submit" class="layui-btn" value="回复"> 
                    </input>
                </div>
            </form>
        </div>
        <script src="/static/admin/lib/layui/layui.js" charset="utf-8">
        </script>
        <script src="/static/admin/js/x-layui.js" charset="utf-8">
        </script>
        <script src="/static/admin/js/jquery-1.8.3.min.js"></script>
        <script>
            layui.use(['form','layer','upload'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer;
            });
            function doupdate(myform){
                $.ajax({
                    url:'commentupdate',
                    type:'post',
                    data:$(myform).serialize(),
                    dataType:'html',
                    async:true,
                    success:function(data){
                        if (data>0) {
                            layer.msg('修改成功');
                            var index = parent.layer.getFrameIndex(window.name);
                            parent.layer.close(index);
                            window.parent.location.reload();
                        }
                    },
                    error:function(){
                        layer.msg('修改失败');
                    }
                });
                return false;
            }    
        </script>
    </body>
</html>