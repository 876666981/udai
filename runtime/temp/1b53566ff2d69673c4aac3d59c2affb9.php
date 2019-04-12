<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"/home/wwwroot/udai/public/../application/admin/view/banner/banner_edit.html";i:1530705676;}*/ ?>
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
                        <span class="x-red">*</span>轮播图
                    </label>
                    <div class="layui-input-inline">
                      <div class="site-demo-upbar">
                        <input type="hidden" value="<?php echo $list['id']; ?>" id="id">
                        <input type="file" name="pic" id="picname">
                      </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label  class="layui-form-label">缩略图
                    </label>
                    <img id="img" width="400" src="<?php echo $list['imgname']; ?>">
                </div>
                <div class="layui-form-item">
                    <label for="link" class="layui-form-label">
                        <span class="x-red">*</span>链接
                    </label>
                    <div class="layui-input-inline">
                        <input type="text"  name="link" required="" lay-verify="required" value="<?php echo $list['link']; ?>" 
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="desc" class="layui-form-label">
                        <span class="x-red">*</span>描述
                    </label>
                    <div class="layui-input-inline">
                        <input type="text"  name="describe" required="" lay-verify="required" value="<?php echo $list['describe']; ?>" 
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <input  type="submit" class="layui-btn" value="修改"> 
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
                        $("#img").attr('src',"../../../uploads/"+data);
                    },
                    error:function(){
                        alert("失败");
                    }
                });
            });
          
            function doupdate(myfrom){
                var id=$("#id").attr('value');
                var s=$("#img").attr('src');
                // var picname=s.substr(s.lastIndexOf("/")+1);
                var formdata=$(myfrom).serialize();
                formdata=formdata+"&imgname="+s+"&id="+id;
                $.ajax({
                    url:'bannerupdate',
                    type:'post',
                    data:formdata,
                    dataType:'json',
                    async:true,
                    success:function(data){
                        if (Number(data)>0) {
                            layer.msg('修改成功');
                            var index = parent.layer.getFrameIndex(window.name);
                            parent.layer.close(index);
                            window.parent.location.reload();
                        }else if(data==0){
                            confirm("未修改任何信息");
                            var index = parent.layer.getFrameIndex(window.name);
                            parent.layer.close(index);
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