<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"/home/wwwroot/udai/public/../application/index/view/personal/udai_comment.html";i:1530179128;}*/ ?>
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
	<script src="/static/index/js/jquery-1.8.3.min.js" charset="UTF-8"></script>
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
					<a href="udaisetting"><dd>个人资料</dd></a>
					<a href="udaiaddress"><dd>收货地址</dd></a>
					<a href="udaipwdmodify"><dd>修改登录密码</dd></a>
				</dl>
				<dl class="user-center__nav">
					<dt>订单中心</dt>
					<a href="udaiorder"><dd  class="active">我的订单</dd></a>
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
					<div class="title">我的评论</div>
					<?php foreach($arr as $ar): ?>
					<div class="collection-list__area clearfix">
						<div class="item-card" style="float:left;">
							<a href="itemshow" class="photo">
								<img src="uploads/<?php echo $ar['img']; ?>" alt="<?php echo $ar['goods_name']; ?>" class="cover">
								<div class="name"><?php echo $ar['goods_name']; ?></div>
							</a>
							<div class="middle">
								<div class="price"><small>￥</small><?php echo $ar['price']; ?></div>
								<div class="num"><span style="margin-left:40px;">数量：</span><?php echo $ar['num']; ?></div>
							</div>
						</div>
					</div>
					<textarea name="content" class="cn" cols="80" rows="10" style="float:right;margin-top:-340px;margin-right:20px;" goodsid="<?php echo $ar['goodsid']; ?>" orderid="<?php echo $list['id']; ?>" userid="<?php echo $uarr['id']; ?>" required="true"></textarea>
					<?php endforeach; ?>
					<div class="collection-list__area clearfix" style="margin-left:800px;"> 
						<button onclick="dopl()" style="width:80px;height:40px;background-color:#b31e22;border-radius:3px;color:white;">发表评论</button>.
					</div>
					<div class="page text-right clearfix">
						<a class="disabled">上一页</a>
						<a class="select">1</a>
						<a href="">2</a>
						<a href="">3</a>
						<a class="" href="">下一页</a>
						<a class="disabled">1/3页</a>
					</div>
				</div>
			</div>
		</section>
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
					<i class="iconfont icon-cart"></i>
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
	<script>
		function dopl(){
			var orderid=$('.cn').attr('orderid');
			var userid=$('.cn').attr('userid');
			var arr=new Array();
			var arr2=new Array();
			$(".cn").each(function(i){
				var goodsid=$(this).attr('goodsid');
				arr2[i]=goodsid;
				arr[i]=$(this).val();
			});
			$.ajax({
				url:"udaidocom",
				type:"post",
				data:{orderid:orderid,userid:userid,arr:arr,arr2:arr2},
				dataType:"html",
				async:true,
				success:function(data){
					if (data>0) {
						alert("评论成功！");
						window.location.href="udaiorder";
					}
				},
				error:function(){
					alert("服务器繁忙，请稍等！");
				}
			});
		}
	</script>
</body>
</html>