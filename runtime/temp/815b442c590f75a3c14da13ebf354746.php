<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"/home/wwwroot/udai/public/../application/admin/view/banner/banner_add.html";i:1530695503;}*/ ?>
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
            <form onsubmit="return doadd(this)" enctype="multipart/form-data" method="post" id='myform'>
                
                <div class="layui-form-item">
                    <label for="link" class="layui-form-label">
                        <span class="x-red">*</span>轮播图
                    </label>
                    <div class="layui-input-inline">
                      <div class="site-demo-upbar">
                        <input type="file" name="pic" id="picname">
                      </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="link" class="layui-form-label">
                        <span class="x-red">*</span>缩略图
                    </label>
                    <div class="layui-input-inline">
                      <div class="site-demo-upbar">
                        <img src="" alt="" id='img'>
                      </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="link" class="layui-form-label">
                        <span class="x-red">*</span>链接
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="link" name="link" required="" lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="desc" class="layui-form-label">
                        <span class="x-red">*</span>描述
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="desc" name="describe" required="" lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="desc" class="layui-form-label">
                        <span class="x-red">*</span>顺序
                    </label>
                    <div class="layui-input-inline">
                        <input type="text"  name="order" required="" lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <input type="submit"  class="layui-btn" value="增加">
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
                var form=layui.form()
              ,layer = layui.layer;
            });

            $("#picname").change(function(event){
                var fd=new FormData(document.getElementById("myform"));
                fd.append("file", $(this).get(0).files[0]);
                var path = $(this).val(),
                extStart = path.lastIndexOf('.'),
                ext = path.substring(extStart,path.length).toUpperCase();
                //判断图片格式
                if(ext !== '.PNG' && ext !== '.JPG' && ext !== '.JPEG' && ext !== '.GIF'){
                    alert('上传图片格式必须为：png,jpg,jpeg,gif');
                    resetFile();
                    return false;
                }
                //获取图片大小
                var size = this.files[0].size / 1024;
                if(size > 10240){
                    alert('图片大小不能超过10M');
                    resetFile();
                    return false;
                }
                $.ajax({
                    url:'banneruploads',
                    type:'POST',
                    data:fd,
                    cache: false,
                    contentType: false,    //不可缺
                    processData: false,    //不可缺
                    success:function(data){
                        $("#img").attr('src',"uploads/"+data);
                    },
                    error:function(){
                        alert("失败");
                    }
                });
            });
          
            function doadd(myfrom){
                var s=$("#img").attr('src');
                // var picname=s.substr(s.lastIndexOf("/")+1);
                var formdata=$(myfrom).serialize();
                formdata=formdata+"&imgname="+s;
                $.ajax({
                    url:'bannerinsert',
                    type:'post',
                    data:formdata,
                    dataType:'html',
                    async:true,
                    success:function(data){
                        if (data>0) {
                            layer.msg('添加成功');
                            var index = parent.layer.getFrameIndex(window.name);
                            parent.layer.close(index);
                            window.parent.location.reload();
                        }
                    },
                    error:function(){
                        layer.msg('添加失败');
                    }
                });
                return false;
            }                
        </script>
    </body>
</html>