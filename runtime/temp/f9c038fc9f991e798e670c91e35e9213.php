<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"/home/wwwroot/udai/public/../application/index/view/personal/udai_setting.html";i:1530151818;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="/static/index/favicon.ico">
	<link rel="stylesheet" href="/static/index/css/iconfont.css">
	<link rel="stylesheet" href="/static/index/css/global.css">
	<link rel="stylesheet" href="/static/index/css/bootstrap.min.css">
	<link rel="stylesheet" href="/static/index/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/static/index/css/swiper.min.css">
	<link rel="stylesheet" href="/static/index/css/styles.css">
	<link rel="stylesheet" type="text/css" href="/static/index/css/sweetalert.css"/>
	<script src="/static/index/js/jquery.1.12.4.min.js" charset="UTF-8"></script>
	<script src="/static/index/js/bootstrap.min.js" charset="UTF-8"></script>
	<script src="/static/index/js/swiper.min.js" charset="UTF-8"></script>
	<script src="/static/index/js/global.js" charset="UTF-8"></script>
	<script src="/static/index/js/jquery.DJMask.2.1.1.js" charset="UTF-8"></script>
	<script src="/static/index/js/sweetalert.min.js" charset="UTF-8"></script>
	<title>U袋网</title>
</head>
<body>
	<!-- 顶部tab -->
	<div class="tab-header">
		<div class="inner">
			<div class="pull-left">
				<div class="pull-left">嗨，欢迎来到<span class="cr">U袋网</span></div>
				<a href="agentlevel">网店代销</a>
			</div>
			<div class="pull-right">
					<?php if(\think\Session::get('phone')==null): ?>
				<a href="udlogin"><span class="cr"></span><span>登录</span></a>
				<a href="register">注册</a>
				<?php else: ?>
				<a href="udlogin"><span class="cr"><?php echo $username; ?></span><span><?php echo \think\Session::get('phone'); ?></span></a>
				<a href="emptysession">退出</a>
				<?php endif; ?>
				<a href="udaiwelcome">我的U袋</a>
				<?php if(\think\Session::get('phone')==null): ?>
					<a href="udlogin">我的订单</a>
				<?php else: ?>
					<a href="udaiorder">我的订单</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- 顶部标题 -->
	<div class="bgf5 clearfix">
		<div class="top-user">
			<div class="inner">
				<a class="logo" href="udindex"><img src="/static/index/images/icons/logo.jpg" alt="U袋网" class="cover"></a>
				<div class="title">个人中心</div>
			</div>
		</div>
	</div>
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
			<div class="pull-left bgf">
				<a href="udaiwelcome" class="title">U袋欢迎页</a>
				<dl class="user-center__nav">
					<dt>帐户信息</dt>
					<a href="udaisetting"><dd class="active">个人资料</dd></a>
					<a href="udaiaddress"><dd>收货地址</dd></a>
					<a href="udaipwdmodify"><dd>修改登录密码</dd></a>
				</dl>
				<dl class="user-center__nav">
					<dt>订单中心</dt>
					<a href="udaiorder"><dd>我的订单</dd></a>
				</dl>
				<dl class="user-center__nav">
					<dt>U袋网</dt>
					<a href="udaiarticle10"><dd>企业简介</dd></a>
					<a href="udaiarticle11"><dd>加入U袋</dd></a>
					<a href="udaiarticle12"><dd>隐私说明</dd></a>
				</dl>
			</div>
			<div class="pull-right">
				<div class="user-content__box clearfix bgf">
					<div class="title">账户信息-个人资料</div>
					<div class="port b-r50" id="crop-avatar">
						<div class="img"><img src="<?php echo $user['imgname']; ?>" class="cover b-r50"></div>
					</div>
					<form action="" class="user-setting__form" role="form" onsubmit="return dosubmit(this)">
						<div class="user-form-group">
							<label for="user-id">用户名：</label>
							<input type="hidden" name="id" value="<?php echo $user['id']; ?>">
							<input type="text" name="phone" id="user-id" value="<?php echo $user['phone']; ?>" placeholder="请输入您的昵称">
						</div>
						<div class="user-form-group">
							<label>性别：</label>
							<label><input type="radio" name="sex" value="m" <?php if($user['sex']=='m') echo 'checked'; ?>><i class="iconfont icon-radio"></i> 男士</label>
							<label><input type="radio" name="sex" value="w" <?php if($user['sex']=='w') echo 'checked'; ?>><i class="iconfont icon-radio"></i> 女士</label>
							<label><input type="radio" name="sex" value="b" <?php if($user['sex']=='b') echo 'checked'; ?>><i class="iconfont icon-radio"></i> 保密</label>
						</div>
						<div class="user-form-group">
							<label>生日：</label>
							<label><input type="text" class="datepicker" name="birthday" value="<?php echo $user['birthday']; ?>" placeholder="请选择您的出生日期"></label>
						</div>
						<div class="user-form-group">
							<input type="submit" name="" class="btn" value="确认修改">
						</div>
					</form>
					<script src="/static/index/js/zebra.datepicker.min.js"></script>
					<link rel="stylesheet" href="/static/index/css/zebra.datepicker.css">
					<script>
						$('input.datepicker').Zebra_DatePicker({
							default_position: 'below',
							show_clear_date: false,
							show_select_today: false,
						});
					</script>
				</div>
			</div>
		</section>
	</div>
	<!-- 头像选择模态框 -->
	<link href="/static/index/css/cropper/cropper.min.css" rel="stylesheet">
	<link href="/static/index/css/cropper/sitelogo.css" rel="stylesheet">
	<script src="/static/index/js/cropper/cropper.min.js"></script>
	<script src="/static/index/js/cropper/sitelogo.js"></script>
	<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form class="avatar-form" enctype="multipart/form-data" id="myform" action="" method="post" onsubmit="return dofeil(this)">
					<div class="modal-header">
						<button class="close" data-dismiss="modal" type="button">&times;</button>
						<h4 class="modal-title" id="avatar-modal-label">Change Logo Picture</h4>
					</div>
					<div class="modal-body">
						<div class="avatar-body">
							<div class="avatar-upload">
								<input type="text" name="id" value="<?php echo $user['id']; ?>" id="id">
								<label for="avatarInput">图片上传</label>
								<input class="avatar-input" name="imgname" type="file" id="picname" value=""></div>
							<div class="row">
								<div class="col-md-9">
									<div class="avatar-wrapper"></div>
								</div>
								<div class="col-md-3">
									<div class="avatar-preview preview-lg"></div>
									<div class="avatar-preview preview-md"></div>
									<div class="avatar-preview preview-sm"></div>
								</div>
							</div>
							<div class="row avatar-btns">
								<div class="col-md-9">
									<div class="btn-group">
										<button class="btn" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees"><i class="fa fa-undo"></i> 向左旋转</button>
									</div>
									<div class="btn-group">
										<button class="btn" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees"><i class="fa fa-repeat"></i> 向右旋转</button>
									</div>
								</div>
								<input type="hidden" name="img" value="" id="img">
								<div class="col-md-3">
									<input class="btn btn-success btn-block avatar-save" type="submit" name="" value="保存修改">
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
	<!-- 右侧菜单 -->
	<div class="right-nav">
		<ul class="r-with-gotop">
			<li class="r-toolbar-item">
				<a href="udai_welcome" class="r-item-hd">
					<i class="iconfont icon-user" data-badge="0"></i>
					<div class="r-tip__box"><span class="r-tip-text">用户中心</span></div>
				</a>
			</li>
			<li class="r-toolbar-item">
				<a href="udaishopcart" class="r-item-hd">
					<i class="iconfont icon-cart" data-badge="<?php echo \think\Session::get('carcount'); ?>"></i>
					<div class="r-tip__box"><span class="r-tip-text">购物车</span></div>
				</a>
			</li>
			<li class="r-toolbar-item to-top">
				<i class="iconfont icon-top"></i>
				<div class="r-tip__box"><span class="r-tip-text">返回顶部</span></div>
			</li>
		</ul>
		<script>
			$(document).ready(function(){ $('.to-top').toTop({position:false}) });
		</script>
	</div>
	<!-- 底部信息 -->
	<div class="footer">
		<div class="footer-tags">
			<div class="tags-box inner">
				<div class="tag-div">
					<img src="/static/index/images/icons/footer_1.gif" alt="厂家直供">
				</div>
				<div class="tag-div">
					<img src="/static/index/images/icons/footer_2.gif" alt="一件代发">
				</div>
				<div class="tag-div">
					<img src="/static/index/images/icons/footer_3.gif" alt="美工活动支持">
				</div>
				<div class="tag-div">
					<img src="/static/index/images/icons/footer_4.gif" alt="信誉认证">
				</div>
			</div>
		</div>
		<div class="copy-box clearfix">
			<ul class="copy-links">
				<?php foreach($url as $u): ?>
				<a href="<?php echo $u['url']; ?>"><li><?php echo $u['name']; ?></li></a>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="copy-box clearfix">
			<ul class="copy-links">
				<a href="agentlevel"><li>网店代销</li></a>
				<a href="classroom"><li>U袋学堂</li></a>
				<a href="udaiabout"><li>联系我们</li></a>
				<a href="udaiarticle10"><li>企业简介</li></a>
			</ul>
			<!-- 版权 -->
			<p class="copyright">
				© 2005-2017 U袋网 版权所有，并保留所有权利<br>
				ICP备案证书号：闽ICP备16015525号-2&nbsp;&nbsp;&nbsp;&nbsp;福建省宁德市福鼎市南下村小区（锦昌阁）1栋1梯602室&nbsp;&nbsp;&nbsp;&nbsp;Tel: 18650406668&nbsp;&nbsp;&nbsp;&nbsp;E-mail: 18650406668@qq.com
			</p>
		</div>
	</div>
	<script type="text/javascript">
		function dosubmit(form){
			$.ajax({
				url:"udaiupdate",
				type:"post",
				data:$(form).serialize(),
				dataType:"html",
				async:true,
				success:function(data){
					if (data>0) {
						swal("Good!", "修改成功", "success");
						setTimeout('window.location.href=\"udaisetting\"',2000);
					}
				},
				error:function(){
					alert("修改失败");
				}
			})
			return false;
		}
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
                    url:'headupdate',
                    type:'POST',
                    data:fd,
                    cache: false,
                    contentType: false,    //不可缺
                    processData: false,    //不可缺
                    success:function(data){
                        $("#img").attr('value',"static/index/head/"+data);
                    },
                    error:function(){
                        alert("失败");
                    }
                });
            });
		function dofeil(myform){
			$.ajax({
				url:"udaidofeil",
				type:"post",
				data:{img:$("#img").val()},
				dataType:"html",
				async:true,
				success:function(data){
					if (data>0) {
						$("#avatar-modal").attr('style','display:none');
						window.location.href="udaisetting";
					}					
				},
				error:function(){
					alert("修改失败");
				}
			})
			return false;
		}
	</script>
</body>
</html>