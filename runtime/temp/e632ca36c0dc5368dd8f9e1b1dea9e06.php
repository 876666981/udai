<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"/home/wwwroot/udai/public/../application/index/view/personal/udai_address.html";i:1530151724;}*/ ?>
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
	<script type="text/javascript" src="/static/index/js/Popt.js"></script>
	<script type="text/javascript" src="/static/index/js/city.json.js"></script>
	<script type="text/javascript" src="/static/index/js/citySet.js"></script>
	<!-- <script src="js/jquery.DJMask.2.1.1.js" charset="UTF-8"></script> -->
	<title>U袋网</title>
	<style type="text/css">
	.tdf1 a{
		text-decoration: none;
	}
* { -ms-word-wrap: break-word; word-wrap: break-word; }
html { -webkit-text-size-adjust: none; text-size-adjust: none; }
html, body {height:100%;width:100%;}
.wrap{width:464px;height:34px;margin:20px auto;border:0;position:relative;}
.input{position:absolute;top:0;left:0;width:200px;margin:0;padding-left:5px;height:30px;line-height:30px;font-size:12px;border:1px solid #c9cacb;}
s{position:absolute;top:1px;right:0;width:32px;height:32px;background:url("img/arrow.png") no-repeat;}
._citys { width: 450px; display: inline-block; border: 2px solid #eee; padding: 5px; position: relative; background: #fff;}
._citys span { color: #05920a; height: 15px; width: 15px; line-height: 15px; text-align: center; border-radius: 3px; position: absolute; right: 10px; top: 10px; border: 1px solid #05920a; cursor: pointer; }
._citys0 { width: 95%; height: 34px; line-height: 34px; display: inline-block; border-bottom: 2px solid #05920a; padding: 0px 5px; font-size:14px; font-weight:bold; margin-left:6px; }
._citys0 li { display: inline-block; line-height: 34px; font-size: 15px; color: #888; width: 80px; text-align: center; cursor: pointer; }
._citys1 { width: 100%; display: inline-block; padding: 10px 0; }
._citys1 a { width: 83px; height: 35px; display: inline-block; background-color: #f5f5f5; color: #666; margin-left: 6px; margin-top: 3px; line-height: 35px; text-align: center; cursor: pointer; font-size: 12px; border-radius: 5px; overflow: hidden; }
._citys1 a:hover { color: #fff; background-color: #05920a; }
.AreaS { background-color: #05920a !important; color: #fff !important; }
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
					<a href="udaiaddress"><dd  class="active">收货地址</dd></a>
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
					<div class="title">账户信息-收货地址</div>
					<form class="user-addr__form form-horizontal" role="form" onsubmit="return doadd(this)">
						<p class="fz18 cr">新增收货地址<span class="c6" style="margin-left: 20px">电话号码、手机号码选填一项，其余均为必填项</span></p>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">收货人姓名：</label>
							<div class="col-sm-6">
								<input class="form-control" id="name" placeholder="请输入姓名" type="text" name="name">
							</div>
						</div>
						<div class="form-group">
							<label for="details" class="col-sm-2 control-label">收货地址：</label>
							<!-- <div class="col-sm-10">
								<div class="addr-linkage">
									<select name="province">
										<option>21</option>
									</select>
									<select name="city"></select>
									<select name="area"></select>
									<select name="town"></select>
								</div>
								<input class="form-control" id="details" placeholder="建议您如实填写详细收货地址，例如街道名称，门牌号码等信息" maxlength="30" type="text">
							</div> -->
						<div class="wrap"><input class="input" name="location" id="city" type="text" placeholder="请选择" autocomplete="off" readonly="true"/><s></s></div>

						<script type="text/javascript">
						$("#city").click(function (e) {
							SelCity(this,e);
						});
						$("s").click(function (e) {
							SelCity(document.getElementById("city"),e);
						});
						</script>
						</div>
						<div class="form-group">
							<label for="code" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<input class="form-control" id="detailed" placeholder="请输入详细地址" type="text" name="detailed">
							</div>
						</div>
						<div class="form-group">
							<label for="mobile" class="col-sm-2 control-label">手机号码：</label>
							<div class="col-sm-6">
								<input class="form-control" id="mobile" placeholder="请输入手机号码" type="text" name="phone">
								<input type="hidden" name="pid" value="<?php echo \think\Session::get('id'); ?>">
							</div>
						</div>
					<!-- 	<div class="form-group">
							<div class="col-sm-offset-2 col-sm-6">
								<div class="checkbox">
									<label><input type="checkbox"><i></i> 设为默认收货地址</label>
								</div>
							</div>
						</div> -->
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-6">
								<input type="submit" name="" class="but" value="保存" id="bc">
							</div>
						</div>
						<script src="/static/index/js/jquery.citys.js"></script>
						<script src="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js"></script>
						<script>
							$(document).ready(function(){
								// 添加街道/乡镇
								function townFormat(info){
									$('.addr-linkage select[name="town"]').hide().empty();
									if (info['code'] % 1e4 && info['code'] < 7e6){	//是否为“区”且不是港澳台地区
										var ajaxConfig = {
											url: 'http://passer-by.com/data_location/town/' + info['code'] + '.json',
											scriptCharset:'UTF-8',
											dataType: "json",
											timeout: 4000,
											success: function(data) {
												$('.addr-linkage select[name="town"]').show();
												// $('#code').val(info['code']) // 填地区编码
												for (i in data) {
													$('.addr-linkage select[name="town"]').append(
														'<option value="' + data[i] + '">' + data[i] + '</option>'
													);
												}
											},
										};
										$.ajax(ajaxConfig).fail(function(p1,p2,p3){
											ajaxConfig.url = 'js/data_location/town/' + info['code'] + '.json';
											$.ajax(ajaxConfig)
										});
									}
								};
								$('.addr-linkage').citys({
									// 如果某天这个仓库地址失效了dataUrl请使用本地 2017.10 的数据 'js/data_location/list.json'
									dataUrl: 'http://passer-by.com/data_location/list.json',
									spareUrl: 'js/data_location/list.json',
									dataType: 'json',
									valueType: 'name',
									province: remote_ip_info['province'],
									city: remote_ip_info['city'],
									area: remote_ip_info['district'],
									onChange: function(data) {
										townFormat(data)
									},
								},function(api){
									var info = api.getInfo();
									townFormat(info);
								});
							}); 
						</script>
					</form>
					<p class="fz18 cr">已保存的有效地址</p>

					<div class="table-thead addr-thead">
						<div class="tdf1">收货人</div>
						<div class="tdf2">所在地</div>
						<div class="tdf3"><div class="tdt-a_l">详细地址</div></div>
						<!-- <div class="tdf1">邮编</div> -->
						<div class="tdf1">电话/手机</div>
						<div class="tdf1">操作</div>
						<div class="tdf1"></div>
					</div>
					<div class="addr-list">
						<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<div class="addr-item">
							<div class="tdf1"><?php echo $v['name']; ?></div>
							<div class="tdf2 tdt-a_l"><?php echo $v['location']; ?></div>
							<div class="tdf3 tdt-a_l"><?php echo $v['detailed']; ?></div>
							<!-- <div class="tdf1">350111</div> -->
							<div class="tdf1"><?php echo $v['phone']; ?></div>
							<div class="tdf1 order">
								<a href="editaddress?id=<?php echo $v['id']; ?>">修改</a><a href="javascript:;" onclick="deladdress(this,<?php echo $v['id']; ?>)">删除</a>
							</div>
							<div class="tdf1">
								<a href="defaultaddress?id=<?php echo $v['id']; ?>" class="ondefault"><?php echo $v['default']==1?'<span style="width: 70px;height: 25px;color: #999;background: #eee;line-height: 25px;border-radius: 5px;display:block;" name="sw">设为默认</span>':'<div style="width:70px;height:25px;color: #FF3339;border-radius: 2px;background: #FFD6CC;border-radius:5px;line-height: 25px;border-color: #FF3339;" id="mr">默认地址</div>'; ?></a>
							</div>
						</div>
						<?php endforeach; endif; else: echo "" ;endif; ?>
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
			if ($('#mr').length>0) {
				$(".ondefault").removeAttr('href');
			}
		$("#bc").click(function(){
			var uname=$("#name").val();
			var city=$("#city").val();
			var detailed=$("#detailed").val();
			var mobile=$("#mobile").val();
		 	var myreg = /^1[3,4,5,6,7,8,9]\d{9}$/;
		if (uname.length==0) {
			alert("姓名不能为空");
			return false;
		}else if (city.length==0) {
			alert("收货地址不能为空");
			return false;
		}else if (detailed.length==0) {
			alert("详细地址不能为空");
			return false;
		}else if(mobile.length==0){
			alert("手机号不能为空");
			return false;
		}else if (!myreg.test(mobile)) {
			alert("手机号错误");
			return false;
		}
		})
			function deladdress(v,id){
		if (confirm("确定删除?")) {
			$.get("udaidel",{id:id},function(data){
			if (data>0) {
				alert("删除成功");
				$(v).parents("tr").remove();
				location.reload();
			}
			});
		}
		
	}
		function doadd(ob){
			$.ajax({
				url:"addaddress",
				type:"post",
				data:$(ob).serialize(),
				dataType:"html",
				async:true,
				success:function(data){
					alert("添加成功");
					location.reload();
				},
				error:function(data){
					alert("添加失败");
				}
			});
			return false;
		}
	</script>
</body>
</html>