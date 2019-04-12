<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"/home/wwwroot/udai/public/../application/index/view/index/index.html";i:1530695782;}*/ ?>
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
	<!-- 首页导航栏 -->
	<div class="top-nav bg3">
		<div class="nav-box inner">
			<div class="all-cat">
				<div class="title"><i class="iconfont icon-menu"></i> 全部分类</div>
				<div class="cat-list__box">
					<?php foreach($plist as $data): ?>	
					<div class="cat-box" style="height:70px;">
						<div class="title">
							<i class="iconfont icon-skirt ce"></i>
							<a href="" style="color:white;"><?php echo $data['name']; ?></a>
						</div>
						<ul class="cat-list clearfix">
						<?php foreach($data['child'] as $key=>$data2): ?>
							<li><a href="../itemcategory?id=<?php echo $data2[$key]['id']; ?>" style="color:white;"><?php echo $data2[$key]['name']; ?></a></li>	
						<?php endforeach; ?>
						</ul>
						<div class="cat-list__deploy">
							<div class="deploy-box">
							<?php foreach($data['child'] as $key=>$data2): ?>
								<div class="genre-box clearfix">
									<span class="title"><?php echo $data2[$key]['name']; ?>：</span>
									<div class="genre-list">
										<?php foreach($data2['child2'] as $k=>$data3): ?>
										<a href="" style="color:white;"><?php echo $data3['name']; ?></a>
										<?php endforeach; ?>
									</div>
								</div>
							<?php endforeach; ?>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
 			</div>
			<ul class="nva-list">
				<a href="udindex"><li class="active">首页</li></a>
				<a href="udaiarticle10"><li>企业简介</li></a>
				<a href="classroom"><li>U袋学堂</li></a>
				<a href="enterpriseid"><li>企业账号</li></a>
				<a href="udaicontract"><li>诚信合约</li></a>
				<a href="itemremove"><li>实时下架</li></a>
			</ul>
		</div>
	</div>
	<!-- 顶部轮播 -->
    <div class="swiper-container banner-box">
        <div class="swiper-wrapper">
        <?php foreach($ban as $v): if($v['state']=='1'): ?>
            <div class="swiper-slide"><a href="itemshow"><img src="<?php echo $v['imgname']; ?>" class="cover"></a></div>
        	<?php endif; endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <!-- 首页楼层导航 -->
	<nav class="floor-nav visible-lg-block">
		<span class="scroll-nav active">爆款推荐</span>
		  <?php if(is_array($hoot) || $hoot instanceof \think\Collection || $hoot instanceof \think\Paginator): $i = 0; $__LIST__ = $hoot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ob): $mod = ($i % 2 );++$i;?>
			<span class="scroll-nav"><?php echo $ob['name']; ?></span>
		  <?php endforeach; endif; else: echo "" ;endif; ?>
	</nav>
	<!-- 楼层内容 -->
	<div class="content inner" style="margin-bottom: 40px;">
		<section class="scroll-floor floor-1 clearfix">
			<div class="floor-title">
				<i class="iconfont icon-skirt fz16"></i>爆款推荐
			</div>
			<div class="con-box">
				<a class="left-img hot-img" href="javascript:;">
					<img src="/static/index/images/floor_1.jpg" alt="" class="cover">
				</a>
				<div class="right-box">
				   <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$on): $mod = ($i % 2 );++$i;?>
					<a href="itemshow?id=<?php echo $on['id']; ?>" class="floor-item">
						<div class="item-img hot-img">
							<img src="uploads/<?php echo substr($on['img'],0,45); ?>" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥<?php echo $on['price']; ?></span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软"><?php echo $on['describe']; ?></div>
					</a>
				 <?php endforeach; endif; else: echo "" ;endif; ?>
					
				</div>
			</div>
		</section>
		<section class="scroll-floor floor-2">
			<div class="floor-title">
				<i class="iconfont icon-skirt fz16"></i><?php echo $app['name']; ?>
				<div class="case-list fz0 pull-right">
				  <?php if(is_array($aps) || $aps instanceof \think\Collection || $aps instanceof \think\Paginator): $i = 0; $__LIST__ = $aps;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$kx): $mod = ($i % 2 );++$i;?>	
					<a href="itemcategory?id=<?php echo $kx['id']; ?>"><?php echo $kx['name']; ?></a>
				  <?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<div class="con-box">
				<a class="left-img hot-img" href="javascript:;">
					<img src="/static/index/images/floor_2.jpg" alt="" class="cover">
				</a>
				<div class="right-box">
				   <?php if(is_array($shop) || $shop instanceof \think\Collection || $shop instanceof \think\Paginator): $i = 0; $__LIST__ = $shop;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shod): $mod = ($i % 2 );++$i;?>
					<a href="itemshow?id=<?php echo $shod['id']; ?>" class="floor-item">
						<div class="item-img hot-img">
							<img src="uploads/<?php echo substr($shod['img'],0,45); ?>" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥<?php echo $shod['price']; ?></span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软"><?php echo $shod['describe']; ?></div>
					</a>
				 <?php endforeach; endif; else: echo "" ;endif; ?>
					
				</div>
			</div>
		</section>
		<section class="scroll-floor floor-3">
			<div class="floor-title">
				<i class="iconfont icon-fushi fz16"></i><?php echo $sps['name']; ?>
				<div class="case-list fz0 pull-right">
					<?php if(is_array($das) || $das instanceof \think\Collection || $das instanceof \think\Paginator): $i = 0; $__LIST__ = $das;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dk): $mod = ($i % 2 );++$i;?>
						<a href="itemcategory?id=<?php echo $dk['id']; ?>"><?php echo $dk['name']; ?></a>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<div class="con-box">
				<a class="left-img hot-img" href="javascript:;">
					<img src="/static/index/images/floor_3.jpg" alt="" class="cover">
				</a>
				<div class="right-box">
				   <?php if(is_array($hop) || $hop instanceof \think\Collection || $hop instanceof \think\Paginator): $i = 0; $__LIST__ = $hop;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$th): $mod = ($i % 2 );++$i;?> 	
					<a href="itemshow?id=<?php echo $th['id']; ?>" class="floor-item">

						<div class="item-img hot-img">
							<img src="uploads/<?php echo substr($th['img'],0,45); ?>" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥<?php echo $th['price']; ?></span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软"><?php echo $th['describe']; ?></div>
					</a>
				  <?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
		</section>
		<section class="scroll-floor floor-4">
			<div class="floor-title">
				<i class="iconfont icon-kid fz16"></i> <?php echo $hps['name']; ?>
				<div class="case-list fz0 pull-right">
					<?php if(is_array($kas) || $kas instanceof \think\Collection || $kas instanceof \think\Paginator): $i = 0; $__LIST__ = $kas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$kp): $mod = ($i % 2 );++$i;?>
					 <a href="itemcategory?id=<?php echo $kp['id']; ?>"><?php echo $kp['name']; ?></a>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<div class="con-box">
				<a class="left-img hot-img" href="javascript:;">
					<img src="/static/index/images/floor_4.jpg" alt="" class="cover">
				</a>
				<div class="right-box">
				   <?php if(is_array($nop) || $nop instanceof \think\Collection || $nop instanceof \think\Paginator): $i = 0; $__LIST__ = $nop;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ks): $mod = ($i % 2 );++$i;?>

					<a href="itemshow?id=<?php echo $ks['id']; ?>" class="floor-item">
						<div class="item-img hot-img">
							<img src="uploads/<?php echo substr($ks['img'],0,45); ?>" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥<?php echo $ks['price']; ?></span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软"><?php echo $ks['describe']; ?></div>
					</a>
				  <?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
		</section>
		<section class="scroll-floor floor-5">
			<div class="floor-title">
				<i class="iconfont icon-bao fz16"></i><?php echo $px['name']; ?>
				<div class="case-list fz0 pull-right">
					<?php if(is_array($kms) || $kms instanceof \think\Collection || $kms instanceof \think\Paginator): $i = 0; $__LIST__ = $kms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nk): $mod = ($i % 2 );++$i;?>
					 <a href="itemcategory?id=<?php echo $nk['id']; ?>"><?php echo $nk['name']; ?></a>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<div class="con-box">
				<a class="left-img hot-img" href="javascript:;">
					<img src="/static/index/images/floor_5.jpg" alt="" class="cover">
				</a>
				<div class="right-box">
				   <?php if(is_array($nsp) || $nsp instanceof \think\Collection || $nsp instanceof \think\Paginator): $i = 0; $__LIST__ = $nsp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fs): $mod = ($i % 2 );++$i;?>
					<a href="itemshow?id=<?php echo $fs['id']; ?>" class="floor-item">
						<div class="item-img hot-img">
							<img src="uploads/<?php echo substr($fs['img'],0,45); ?>" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥<?php echo $fs['price']; ?></span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软"><?php echo $fs['describe']; ?></div>
					</a>
				  <?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
		</section>
		<section class="scroll-floor floor-6">
			<div class="floor-title">
				<i class="iconfont icon-shoes fz16"></i><?php echo $dok['name']; ?>
				<div class="case-list fz0 pull-right">
				    <?php if(is_array($haps) || $haps instanceof \think\Collection || $haps instanceof \think\Paginator): $i = 0; $__LIST__ = $haps;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nb): $mod = ($i % 2 );++$i;?>
					 <a href="itemcategory?id=<?php echo $nb['id']; ?>"><?php echo $nb['name']; ?></a>
				    <?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<div class="con-box">
				<a class="left-img hot-img" href="javascript:;">
					<img src="/static/index/images/floor_6.jpg" alt="" class="cover">
				</a>
				<div class="right-box">
				<?php if(is_array($esp) || $esp instanceof \think\Collection || $esp instanceof \think\Paginator): $i = 0; $__LIST__ = $esp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mh): $mod = ($i % 2 );++$i;?>
					<a href="itemshow.html?id=<?php echo $mh['id']; ?>" class="floor-item">
						<div class="item-img hot-img">
							<img src="uploads/<?php echo substr($mh['img'],0,45); ?>" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥<?php echo $mh['price']; ?></span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软"><?php echo $mh['describe']; ?></div>
					</a>
				  <?php endforeach; endif; else: echo "" ;endif; ?>
					
				</div>
			</div>
		</section>
	</div>
	<script>
		$(document).ready(function(){ 
			// 顶部banner轮播
			var banner_swiper = new Swiper('.banner-box', {
				autoplayDisableOnInteraction : false,
				pagination: '.banner-box .swiper-pagination',
				paginationClickable: true,
				autoplay : 5000,
			});
			// 新闻列表滚动
			var notice_swiper = new Swiper('.notice-box .swiper-container', {
				paginationClickable: true,
				mousewheelControl : true,
				direction : 'vertical',
				slidesPerView : 10,
				autoplay : 2e3,
			});
			// 楼层导航自动 active
			$.scrollFloor();
			// 页面下拉固定楼层导航
			$('.floor-nav').smartFloat();
			$('.to-top').toTop({position:false});
		});
	</script>
	<!-- 右侧菜单 -->
	<div class="right-nav">
		<ul class="r-with-gotop">
			<li class="r-toolbar-item">
				<a href="udaiwelcome" class="r-item-hd">
					<i class="iconfont icon-user"></i>
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
				© 2005-2018 U袋网 版权所有，并保留所有权利<br>
				ICP备案证书号：闽ICP备16015525号-2&nbsp;&nbsp;&nbsp;&nbsp;福建省宁德市福鼎市南下村小区（锦昌阁）1栋1梯602室&nbsp;&nbsp;&nbsp;&nbsp;Tel: 18650406668&nbsp;&nbsp;&nbsp;&nbsp;E-mail: 18650406668@qq.com
			</p>
		</div>
</body>
</html>
