<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"/home/wwwroot/udai/public/../application/index/view/goods/item_show.html";i:1530179232;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="favicon.ico">
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
	<style type="text/css">
		.redborder{
			border:1px solid #B31E22 !important;
		}
	</style>
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
				<a href="index"><li>首页</li></a>
				<a href="udaiarticle10"><li>企业简介</li></a>
				<a href="classroom"><li>U袋学堂</li></a>
				<a href="enterpriseid"><li>企业账号</li></a>
				<a href="udaicontract"><li>诚信合约</li></a>
				<a href="itemremove"><li>实时下架</li></a>
			</ul>
		</div>
	</div>
	<div class="content inner">
		<section class="item-show__div item-show__head clearfix">
			<div class="pull-left">
				<ol class="breadcrumb">
					<li><a href="index">首页</a></li>
					<li><a href="itemsalepage">爆款推荐</a></li>
					<li class="active"><?php echo $all['goods_name']; ?></li>
				</ol>
		
			<div class="item-pic__box" id="magnifier">
					<div class="small-box">
						<input type="hidden" name="id" value="<?php echo $all['id']; ?>">
						<!-- 图片图 -->
						<input type="hidden" name="carimg" value="<?php echo $img[0]; ?>" class="carimg">
						<img class="cover" src=" uploads/<?php echo $img[0]; ?>" alt="重回汉唐 旧忆 原创设计日常汉服女款绣花长褙子吊带改良宋裤春夏">
						<span class="hover"></span>
					</div>
					<div class="thumbnail-box">
						<a href="javascript:;" class="btn btn-default btn-prev"></a>
						<div class="thumb-list">
							<ul class="wrapper clearfix">
								<!-- 下小图 -->
								<?php foreach($img as $v): ?> 
									<li class="item" data-src="uploads/<?php echo $v; ?>"><img class="cover" src="uploads/<?php echo $v; ?>" alt="商品预览图"></li>
								<?php endforeach; foreach($img as $v): ?>
								<li class="item" data-src="uploads/<?php echo $v; ?>"><img class="cover" src="uploads/<?php echo $v; ?>" alt="商品预览图"></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<a href="javascript:;" class="btn btn-default btn-next"></a>
					</div>
					<div class="big-box"><img src="" alt="重回汉唐 旧忆 原创设计日常汉服女款绣花长褙子吊带改良宋裤春夏"></div>
					<div class="big-box">
						<?php foreach($img as $v): ?>
						<img src="uploads/<?php echo $v; ?>" alt="">
						<?php endforeach; ?>
					</div>

				</div>
				<script src="/static/index/js/jquery.magnifier.js"></script>
				<script>
					$(function () {
						$('#magnifier').magnifier();
					});
				</script>
				<form action="orderinfo1" method="post">
				<div class="item-info__box">
					<div class="item-title">
						<input type="hidden" name="goodname" value="<?php echo $all['goods_name']; ?>">
						<input type="hidden" name="carimg" value="<?php echo $img[0]; ?>" class="carimg">
						<input type="hidden" name="daijia" value="<?php echo $all['price']; ?>">
						<input type="hidden" name="attribute" value="" class="attribute">
						<div class="goodsname" name="goodsname"><?php echo $all['goods_name']; ?></div>
					</div>
					<input type="hidden" name="sid" value="<?php echo $all['id']; ?>" class="sid">
					<div class="item-price bgf5">
						<div class="price-box clearfix">
							<div class="price-panel pull-left">
								售价：<span style="font-size: 26px;color: #DD0007;">￥</span><span name="price" class="price"><?php echo $all['price']; ?></span>
							</div>
							<script>
								// 会员价格折叠展开
								$(function () {
									$('.vip-price-panel').click(function() {
										if ($(this).hasClass('active')) {
											$('.all-price__box').stop().slideUp('normal',function() {
												$('.vip-price-panel').removeClass('active').find('.iconfont').removeClass('icon-up').addClass('icon-down');
											});
										} else {
											$(this).addClass('active').find('.iconfont').removeClass('icon-down').addClass('icon-up');
											$('.all-price__box').stop().slideDown('normal');
										}
									});
								});
							</script>
						</div>
					</div>
					<ul class="item-ind-panel clearfix">
						<li class="item-ind-item">
							<a href=""><span class="ind-label c9">累计评论</span>
							<span class="ind-count cr"><?php echo $num; ?></span></a>
						</li>
					</ul>
					<div class="item-key">
						<div class="item-sku">
							<?php foreach($colors as $c): ?>
							<dl class="item-prop clearfix">
								<dt class="item-metatit"><?php echo $c['attr']; ?></dt>
								<dd><ul data-property="颜色" class="clearfix">
									<li>
										<?php foreach($aa as $values): foreach($values as $k=>$vl): if($k==$c['attr']): ?>
										<a href="javascript:;" role="button" data-value="白色" aria-disabled="true" style="display:inline;" name="carval">
											<?php echo $vl['value']; ?>
										</a>
										<?php endif; endforeach; endforeach; ?>
									</li>
								</ul></dd>
							</dl>
							<?php endforeach; ?>
						</div>
						<div class="item-amount clearfix bgf5">
							<div class="item-metatit">数量：</div>
							<div class="amount-box">
								<div class="amount-widget">
									<input type="hidden" name="pid" value="<?php echo \think\Session::get('id'); ?>" class="pid">
									<input class="amount-input" value="1" maxlength="8" title="请输入购买量" type="text" name="carnum">
									<div class="amount-btn">
										<a class="amount-but add"></a>
										<a class="amount-but sub"></a>
									</div>
								</div>
								<?php if($all['stock']==0): ?>
								<div class="item-stock"><span style="margin-left: 10px;">商品暂无</span></div>
								<?php else: ?>
								<div class="item-stock"><span style="margin-left: 10px;">库存 <b id="Stock" name="stock"><?php echo $all['stock']; ?></b> 件</span></div>
								<?php endif; ?>
								<script>
									$(function(){
								     $("li a").click(function() {
								    	// alert('aa');
								        $(this).siblings('li a').removeClass('redborder');   // 删除其他li的边框样式
								        $(this).addClass('redborder');         // 为当前li添加边框样式
								    });
								}); 
									$(function () {
										$('.amount-input').onlyReg({reg: /[^0-9]/g});
										var stock = parseInt($('#Stock').html());
										$('.amount-widget').on('click','.amount-but',function() {
											var num = parseInt($('.amount-input').val());
											if (!num) num = 0;
											if ($(this).hasClass('add')) {
												if (num > stock - 1){
													return DJMask.open({
													　　width:"300px",
													　　height:"100px",
													　　content:"您输入的数量超过库存上限"
												　　});
												}
												$('.amount-input').val(num + 1);
											} else if ($(this).hasClass('sub')) {
												if (num == 1){
													return DJMask.open({
													　　width:"300px",
													　　height:"100px",
													　　content:"您输入的数量有误"
												　　});
												}
												$('.amount-input').val(num - 1);
											}
										});
									});

								</script>
							</div>
						</div>
						<div class="item-action clearfix bgf5">
							<?php if(\think\Session::get('phone')==null): ?>
								<a  href="udlogin" class="item-action__buy">立即购买</a>
								<a href="udlogin" class="item-action__basket">
									<i class="iconfont icon-shopcart"></i> 加入购物车
								</a>
							<?php elseif($all['stock']==0): ?>
							<button class="item-action__buy" disabled="disabled">立即购买</button>
							<a href="javascript:;" class="item-action__basket">
								<i class="iconfont icon-shopcart"></i> 加入购物车
							</a>
							<?php else: ?>
							<button class="item-action__buy">立即购买</button>
							<a href="javascript:;" onclick="oncar()" class="item-action__basket">
								<i class="iconfont icon-shopcart"></i> 加入购物车
							</a>
							<?php endif; ?>
						</div>
						<script>
							$('.item-action__buy').click(function(){
								var red=$(".redborder").text();
								ki=$(".attribute").val(red);
							});
							$('.item-action__buy').click(function(){
								if (!$('li a').hasClass('redborder')) {
									alert('请填写完整的规格');
									return false;
								}
							});
						</script>
					</div>
				</div>
			</form>
			</div>
			<div class="pull-right picked-div">
				<div class="lace-title">
					<span class="c6">爆款推荐</span>
				</div>
				<div class="swiper-container picked-swiper">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<?php foreach($hot as $h): ?>
							<a class="picked-item" href="itemshow?id=<?php echo $h['id']; ?>">
								<img src="uploads/<?php echo substr($h['img'],0,45); ?>" alt="" class="cover">
								<div class="look_price"><?php echo $h['price']; ?></div>
							</a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="picked-button-prev"></div>
				<div class="picked-button-next"></div>
			<script>
				function oncar(){
					var maxIndex = $('.redborder').length - 1;
				    var redborder = '';
				    $('.redborder').text(function(index, content){
				        redborder += (index === maxIndex) ? content : content + ','; 
				    });
					$.ajax({
							type:'post',
							url:'carinsert',
							data:{
								carval:redborder,
								pid:$('.pid').val(),
								stock:$('#Stock').text(),
								carnum:$('.amount-input').val(),
								price:$('.price').text(),
								goodsname:$('.goodsname').text(),
								sid:$('.sid').val(),
								carimg:$('.carimg').val()
								},
							dataType:'html',
							success:function(data){
								if (data>0) {
									alert('添加成功');
									window.location.reload();
								}else{
									alert('添加失败');
								}
							}
						});
					}
						function Collection(){
						$.ajax({
							type:'post',
							url:'addsc',
							data:{
								pid:$('.pid').val(),
								price:$('.price').text(),
								goodsname:$('.goodsname').text(),
								sid:$('.sid').val(),
								carimg:$('.carimg').val()
							},
						dataType:'html',
						success:function(data){
							if (data>0) {
									alert('收藏成功');
										window.location.reload();
								}else{
									alert('收藏失败');
								}
							}
						});
					}
					$(document).ready(function(){ 
						// 顶部banner轮播
						var picked_swiper = new Swiper('.picked-swiper', {
							loop : true,
							direction: 'vertical',
							prevButton:'.picked-button-prev',
							nextButton:'.picked-button-next',
						});
					});
				</script>
			</div>
		</section>
		<section class="item-show__div item-show__body posr clearfix">
			<div class="item-nav-tabs">
				<ul class="nav-tabs nav-pills clearfix" role="tablist" id="item-tabs">
					<li role="presentation" class="active"><a href="#detail" role="tab" data-toggle="tab" aria-controls="detail" aria-expanded="true">商品详情</a></li>
					<li role="presentation"><a href="#evaluate" role="tab" data-toggle="tab" aria-controls="evaluate">累计评价 <span class="badge"><?php echo $num; ?></span></a></li>
					<li role="presentation"><a href="#service" role="tab" data-toggle="tab" aria-controls="service">售后服务</a></li>
				</ul>
			</div>
			<div class="pull-left">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="detail" aria-labelledby="detail-tab">
						<div class="item-detail__info clearfix">
							
							<div class="record">商品编号：<?php echo $all['number']; ?></div>
							<div class="record">上架时间： <?php echo date('Y-m-d H:i:s',$all['addtime']); ?></div>
							<div class="record">商品毛重：<?php echo $all['rough']; ?></div>
							<div class="record">商品库存：<?php echo $all['stock']; ?>件</div>
						
						</div>
						<div class="rich-text">
							<p style="text-align: center;">
								<?php foreach($img as $v): ?>
								<i id="desc-module-1" style="font-size: 0"></i><br>
								 <img src="uploads/<?php echo $v; ?>" alt="">
								<?php endforeach; ?>
							</p>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="evaluate" aria-labelledby="evaluate-tab">
						<!-- <div class="evaluate-tabs bgf5">
							<ul class="nav-tabs nav-pills clearfix" role="tablist">
								<li role="presentation" class="active"><a href="#all" role="tab" data-toggle="tab" aria-controls="all" aria-expanded="true">全部评价 <span class="badge">1314</span></a></li>
								<li role="presentation"><a href="#good" role="tab" data-toggle="tab" aria-controls="good">好评 <span class="badge">1000</span></a></li>
								<li role="presentation"><a href="#normal" role="tab" data-toggle="tab" aria-controls="normal">中评 <span class="badge">314</span></a></li>
								<li role="presentation"><a href="#bad" role="tab" data-toggle="tab" aria-controls="bad">差评 <span class="badge">0</span></a></li>
							</ul>
						</div> -->
						<?php foreach($pl as $plm): ?>
						<div class="evaluate-content">
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="all" aria-labelledby="all-tab">
									<div class="eval-box">
										<div class="eval-author">
											<?php foreach($us as $user): if($user['id']==$plm['userid']): ?>
											<div class="port">
												<img src="<?php echo $user['imgname']; ?>" class="cover b-r50">
											</div>
											<div class="name"><?php echo $user['phone']; ?></div>
											<?php endif; endforeach; ?>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												<?php echo $plm['content']; ?>
											</div>
											<!-- <div class="eval-imgs">
												<div class="img-temp"><img src="/static/index/images/temp/S-001-1_s.jpg" data-src="/static/index/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/index/images/temp/S-001-2_s.jpg" data-src="/static/index/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/index/images/temp/S-001-3_s.jpg" data-src="/static/index/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/index/images/temp/S-001-4_s.jpg" data-src="/static/index/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/index/images/temp/S-001-5_s.jpg" data-src="/static/index/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div> -->
											<div class="eval-time">
												<?php echo date("Y-m-d H:i:s",$plm['createTime']); ?>
											</div>
										</div>
									</div>
									<div style="float:right;margin-right:20px;margin-top:-20px;">
										商家回复：<?php echo $plm['restore']; ?>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
							<script src="js/jquery.zoom.js"></script>
						</div>
					</div>
				</div>
					<div role="tabpanel" class="tab-pane fade" id="service" aria-labelledby="service-tab">
						<!-- 富文本 -->
						<div class="service-content rich-text">
							<img title="" alt="" src="/static/index//image/2014-06/86575417.gif" width="240" height="160" border="0" align="left"><p>承蒙惠购 AOC 产品，谨致谢意！为了让您更好地使用本产品，武汉艾德蒙科技股份有限公司通过该产品随机附带的保修证向您做出下述维修服务承诺，并按照该服务的承诺向您提供维修服务。</p><p>这些服务承诺仅适用于2016年6月1日（含）之后销售的AOC品牌显示器标准品。</p><p>如果您选择购买了 AOC 显示器扩展功能模块或其它厂家电脑主机，其保修承诺请参见相应产品的保修卡。</p><p>所有承诺内容以产品附件的保修卡为准。</p><p><br></p><h3>一、全国联保</h3><p style="text-indent:2em">AOC 显示器实施全国范围联保，国家标准三包服务。无论您是在中国大陆 ( 不含香港、澳门、台湾地区) 何处购买并在大陆地区使用的显示器，出现三包范围内的故障时，可凭显示器的保修证正本和购机发票到 AOC 显示器维修网点或授权网点进行维修同时，也欢迎您关注官方微信服务号“AOC用户俱乐部”(微信号：aocdisplay)进行查询。</p><div style="text-align:center"><img src="/static/index/image/2017-05/89154415.jpg" alt=""></div><p><br></p><p>三包服务如下：</p><ol><li>商品自售出之日起 7 日内，出现《微型计算机商品性能故障表》中所列故障时，消费者可选择退货、换货或修理。</li><li>商品自售出之日起 15 日内，出现《微型计算机商品性能故障表》中所列故障时，消费者可选择换货或修理。</li><li>商品自售出之日起 1 年内，出现《微型计算机商品性能故障表》中所列故障时，消费者可选择修理。</li></ol><p>以下情况不在三包范围内：</p><ol><li>超过三包有效期。</li><li>无有效的三包凭证及发票。</li><li>发票上内容与商品实物标识不符或者涂改的。</li><li>未按产品使用说明书要求使用、维护、保养而造成损坏的（人为损坏）。</li><li>非 AOC 授权的修理者拆动造成损坏的（私自拆修）。</li><li>非 AOC 在中国大陆（不含香港、澳门、台湾地区）销售的商品。</li></ol><h3>二、显示器专享服务</h3><p><strong>1、LUVIA视界头等舱，VIP专享服务</strong></p><p style="text-indent:2em">AOC针对各省市地区采取指定商品销售，消费者购买指定销往该区域的LUVIA卢瓦尔显示器标准品，从发票开具之日起1年内，注册成为官方微信服务号“AOC用户俱乐部”(微信号：aocdisplay)产品会员，即可在当地享“LUVIA视界头等舱，VIP专享服务”。</p><div style="text-align:center"><img src="/static/index/image/2017-05/25352146.jpg" alt=""></div><p><br></p><p style="text-indent:2em">* 如客户未在发票开具之日起1年内注册AOC微信会员，则只享受国家三包服务。</p><p style="text-indent:2em">注册会员方式：1、关注“AOC用户俱乐部”微信公众号。2、点击“会员”→“注册会员”。3、填写个人真实信息并注册产品信息，即可成为AOC产品会员。</p><p style="text-indent:2em"><strong>3年免费上门更换</strong>：从发票开具之日起3年内，产品若发生《微型计算机商品性能故障表》所列性能故障，可免费更换不低于同型号同规格产品。（服务网点无法覆盖区域，全国区域免费邮寄，双向运费由AOC负担）</p><p style="text-indent:2em"><strong>一键快捷掌上服务：</strong>从注册成为“AOC用户俱乐部”会员之日起，可享在线贴身技术顾问有问必答、售后服务在线预约、服务网点在线查询等一键快捷掌上服务。（人工客服咨询在线时间：8:00-22:00）</p><p style="text-indent:2em"><strong>增值豪礼尊享服务：</strong>可参加“AOC用户俱乐部”有奖互动赢取豪礼。</p><p>注：<br>(1)如不能及时提供购机发票或发票记载不清、涂改、商品实物标示和发票内容不符，将以您上传“AOC用户俱乐部”的发票信息为准计算保修时间；如果发票信息并未上传，将以该显示器制造日期(制造日期见显示器后壳条形码标签)加一个月为准计算保修时间。<br>(2)非“AOC用户俱乐部”产品会员，不享受“LUVIA视界头等舱，VIP专享服务”。</p>
						</div>
					</div>
			    </div>
			</div>
			<center>
			<div class="recommends">
				<div class="lace-title type-2">
					<span class="cr">爆款推荐</span>
				</div>
				<div class="swiper-container recommends-swiper">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<?php foreach($hot as $v): ?>
							<a class="picked-item" href="" style=" margin-right:5px;margin-left:5px;">
								<img src="uploads/<?php echo substr($v['img'],0,45); ?>" alt="" class="cover">
								<div class="look_price">¥<?php echo $v['price']; ?></div>
							</a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<script>
					$(document).ready(function(){
						var recommends = new Swiper('.recommends-swiper', {
							spaceBetween : 40,
							autoplay : 5000,
						});
					});
				</script>
			</div>
			</center>
			<div class="pull-right">
				<div class="tab-content" id="descCate">
					<!-- <div role="tabpanel" class="tab-pane fade in active" id="detail-tab" aria-labelledby="detail-tab">
						<div class="descCate-content bgf5">
							<dd class="dc-idsItem selected">
								<a href="#desc-module-1"><i class="iconfont icon-dot"></i> 产品图</a>
							</dd>
							<dd class="dc-idsItem">
								<a href="#desc-module-2"><i class="iconfont icon-selected"></i> 细节图</a>
							</dd>
							<dd class="dc-idsItem">
								<a href="#desc-module-3"><i class="iconfont"></i> 尺寸及试穿</a>
							</dd>
							<dd class="dc-idsItem">
								<a href="#desc-module-4"><i class="iconfont"></i> 模特效果图</a>
							</dd>
							<dd class="dc-idsItem">
								<a href="#desc-module-5"><i class="iconfont"></i> 常见问题</a>
							</dd>
						</div>
					</div> -->
					<div role="tabpanel" class="tab-pane fade" id="evaluate-tab" aria-labelledby="evaluate-tab">
						<div class="descCate-content posr bgf5">
							<div class="lace-title">
								<span class="c6">相关推荐</span>
							</div>
							<div class="picked-box">
								<a class="picked-item" href="">
									<img src="/static/index/images/temp/S-001-1_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="/static/index/images/temp/S-001-2_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="/static/index/images/temp/S-001-3_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="/static/index/images/temp/S-001-4_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="/static/index/images/temp/S-001-5_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="service-tab" aria-labelledby="service-tab">
						<div class="descCate-content posr bgf5">
							<div class="lace-title">
								<span class="c6">最近浏览</span>
							</div>
							<div class="picked-box">
								<a class="picked-item" href="">
									<img src="/static/index/images/temp/S-001-1_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="/static/index/images/temp/S-001-2_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="/static/index/images/temp/S-001-3_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="/static/index/images/temp/S-001-4_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="/static/index/images/temp/S-001-5_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script>
				$(document).ready(function(){
					$('#descCate').smartFloat(0);
					$('.dc-idsItem').click(function() {
						$(this).addClass('selected').siblings().removeClass('selected');
					});
					$('#item-tabs a[data-toggle="tab"]').on('show.bs.tab', function (e) {
						$('#descCate #' + $(e.target).attr('aria-controls') + '-tab')
						.addClass('in').addClass('active').siblings()
						.removeClass('in').removeClass('active');
					});
				});
			</script>
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
	</div>
</body>
</html>