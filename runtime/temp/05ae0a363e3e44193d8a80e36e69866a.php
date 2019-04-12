<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"/home/wwwroot/udai/public/../application/index/view/index/class_room.html";i:1530151582;}*/ ?>
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
	<script src="/static/index/js/jquery.1.12.4.min.js" charset="UTF-8"></script>
	<script src="/static/index/js/bootstrap.min.js" charset="UTF-8"></script>
	<script src="/static/index/js/swiper.min.js" charset="UTF-8"></script>
	<script src="/static/index/js/global.js" charset="UTF-8"></script>
	<script src="/static/index/js/jquery.DJMask.2.1.1.js" charset="UTF-8"></script>
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
	<!-- 搜索栏 -->
	<div class="top-search">
		<div class="inner">
			<a class="logo" href="udindex"><img src="/static/index/images/icons/logo.jpg" alt="U袋网" class="cover"></a>
			<div class="search-box">
				<form class="input-group" action="itemsalepage" method="get">
					<input placeholder="Ta们都在搜U袋网" type="text" name="goods_name">
					<span class="input-group-btn">
						<button type="submit">
							<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						</button>
					</span>
				</form>
			</div>
			<div class="cart-box">
				<?php if(\think\Session::get('phone')==null): ?>
				<a href="udlogin" class="cart-but">
					<i class="iconfont icon-shopcart cr fz16"></i> 购物车<?php echo \think\Session::get('carcount'); ?>件
				</a>
				<?php else: ?>
				<a href="udaishopcart" class="cart-but">
					<i class="iconfont icon-shopcart cr fz16"></i> 购物车<?php echo \think\Session::get('carcount'); ?>件
				</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- 内页导航栏 -->
	<div class="top-nav bg3">
		<div class="nav-box inner">
			<div class="all-cat">
				<div class="title"><i class="iconfont icon-menu"></i> 全部分类</div>
			</div>
			<ul class="nva-list">
				<a href="udindex"><li>首页</li></a>
				<a href="udaiarticle10"><li>企业简介</li></a>
				<a href="classroom"><li class="active">U袋学堂</li></a>
				<a href="enterpriseid"><li>企业账号</li></a>
				<a href="udaicontract"><li>诚信合约</li></a>
				<a href="itemremove"><li>实时下架</li></a>
			</ul>
		</div>
	</div>
	<div class="content inner">
		<section class="panel__div clearfix">
			<div class="filter-value">
				<div class="filter-title">视频专区</div>
				<div class="auto-play pull-right">自动播放</div>
			</div>
			<div class="video-list_div">
				<div class="video-box">
					<div class="img" data-toggle="modal" data-target="#video-modal" data-id="1" data-video="/static/index/images/temp/videos/video_1.mp4"><img src="/static/index/images/temp/S-001-1_s.jpg" alt="U袋学堂第1课" class="cover"></div>
					<div class="buttom">
						<div class="title ep">U袋学堂第1课</div>
						<div class="price">免费学习</div>
					</div>
				</div>
				<div class="video-box">
					<div class="img" data-toggle="modal" data-target="#video-modal" data-id="2" data-video="/static/index/images/temp/videos/video_2.mp4"><img src="/static/index/images/temp/S-001-2_s.jpg" alt="U袋学堂第2课" class="cover"></div>
					<div class="buttom">
						<div class="title ep">U袋学堂第1课</div>
						<div class="price">免费学习</div>
					</div>
				</div>
				<div class="video-box">
					<div class="img" data-toggle="modal" data-target="#video-modal" data-id="3" data-video="/static/index/images/temp/videos/video_3.mp4"><img src="/static/index/images/temp/S-001-3_s.jpg" alt="U袋学堂第3课" class="cover"></div>
					<div class="buttom">
						<div class="title ep">U袋学堂第1课</div>
						<div class="price">免费学习</div>
					</div>
				</div>
				<div class="video-box">
					<div class="img" data-toggle="modal" data-target="#video-modal" data-id="4" data-video="/static/index/images/temp/videos/video_4.mp4"><img src="/static/index/images/temp/S-001-4_s.jpg" alt="U袋学堂第4课" class="cover"></div>
					<div class="buttom">
						<div class="title ep">U袋学堂第1课</div>
						<div class="price">免费学习</div>
					</div>
				</div>
				<div class="video-box">
					<div class="img" data-toggle="modal" data-target="#video-modal" data-id="5" data-video="/static/index/images/temp/videos/video_5.mp4"><img src="/static/index/images/temp/S-001-5_s.jpg" alt="U袋学堂第5课" class="cover"></div>
					<div class="buttom">
						<div class="title ep">U袋学堂第1课</div>
						<div class="price">免费学习</div>
					</div>
				</div>
				<div class="video-box">
					<div class="img" data-toggle="modal" data-target="#video-modal" data-id="6" data-video="/static/index/images/temp/videos/video_6.mp4"><img src="/static/index/images/temp/S-001-6_s.jpg" alt="U袋学堂第6课" class="cover"></div>
					<div class="buttom">
						<div class="title ep">U袋学堂第1课</div>
						<div class="price">免费学习</div>
					</div>
				</div>
				<div class="video-box">
					<div class="img" data-toggle="modal" data-target="#video-modal" data-id="7" data-video="/static/index/images/temp/videos/video_7.mp4"><img src="/static/index/images/temp/S-001-7_s.jpg" alt="U袋学堂第7课" class="cover"></div>
					<div class="buttom">
						<div class="title ep">U袋学堂第1课</div>
						<div class="price">免费学习</div>
					</div>
				</div>
				<div class="video-box">
					<div class="img" data-toggle="modal" data-target="#video-modal" data-id="8" data-video="/static/index/images/temp/videos/video_8.mp4"><img src="/static/index/images/temp/S-001-8_s.jpg" alt="U袋学堂第8课" class="cover"></div>
					<div class="buttom">
						<div class="title ep">U袋学堂第1课</div>
						<div class="price">免费学习</div>
					</div>
				</div>
			</div>
			<script>
				$(function() {
					$('#video-modal').on('show.bs.modal', function (e) {
						if ($('#video').data('id') != $(e.relatedTarget).data('id')) {
							 $('#video').data('id',$(e.relatedTarget).data('id'));
							$('#video').attr({
								'src': $(e.relatedTarget).data('video'),
								'poster': $(e.relatedTarget).find('img').attr('src')
							});
						};
						if ($('.auto-play').hasClass('active')) {
							$('#video').get(0).play()
						};
					});
					$('.auto-play').click(function() {
						$(this).toggleClass('active')
					});
					$('#video-modal').on('hide.bs.modal', function (e) {
						$('#video').get(0).pause();
					});
				});
			</script>
		</section>
		<section class="panel__div clearfix">
			<div class="filter-value">
				<div class="filter-title">U袋学堂说明</div>
			</div>
			<div class="html-code">
				<p>这里是U袋学堂说明内容</p>
			</div>
		</section>
	</div>
	<div class="modal fade bs-example-modal-lg" id="video-modal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<video id="video" width="870" controls preload="metadata" data-id=""></video>
				</div>
			</div>
		</div>
	</div>
	<!-- 右侧菜单 -->
	<div class="right-nav">
		<ul class="r-with-gotop">
			<li class="r-toolbar-item">
				<a href="udaiwelcome" class="r-item-hd">
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
				<a href="udaiarticle5"><li>新手上路</li></a>
			</ul>
			<!-- 版权 -->
			<p class="copyright">
				© 2005-2017 U袋网 版权所有，并保留所有权利<br>
				ICP备案证书号：闽ICP备16015525号-2&nbsp;&nbsp;&nbsp;&nbsp;福建省宁德市福鼎市南下村小区（锦昌阁）1栋1梯602室&nbsp;&nbsp;&nbsp;&nbsp;Tel: 18650406668&nbsp;&nbsp;&nbsp;&nbsp;E-mail: 18650406668@qq.com
			</p>
		</div>
</body>
</html>