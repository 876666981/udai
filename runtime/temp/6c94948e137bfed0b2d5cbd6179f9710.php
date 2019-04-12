<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"/home/wwwroot/udai/public/../application/index/view/index/cashier.html";i:1530151576;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="keywords" content="鞋服包一件代发 批发">
    <meta name="description" content="鞋服包一件代发 批发">
    <link rel="stylesheet" href="/static/index/css/iconfont.css">
    <link rel="stylesheet" href="/static/index/css/global.css">
    <link rel="stylesheet" href="/static/index/css/bootstrap.css">
    <link rel="stylesheet" href="/static/index/css/bootstrap-theme.css">
    <link rel="stylesheet" href="/static/index/css/swiper.css">
    <link rel="stylesheet" href="/static/index/css/styles.css">
    <script src="/static/index/js/jquery.js" charset="UTF-8"></script>
    <script src="/static/index/js/bootstrap.js" charset="UTF-8"></script>
    <script src="/static/index/js/swiper.js" charset="UTF-8"></script>
    <script src="/static/index/js/global.js" charset="UTF-8"></script>
    <script src="/static/index/js/alert.js" charset="UTF-8"></script><style type="text/css">.alert_overlay{position:fixed;width:100%;height:100%;top:0;left:0;z-index:1000;background:rgba(0,0,0,.05);-webkit-backdrop-filter:blur(3px)}.pc .alert_msg{width:320px}.mob .alert_msg{width:260px;border-radius:4px}.alert_msg{box-sizing:border-box;position:absolute;left:50%;top:30%;border:1px solid #ccc;box-shadow:0 2px 15px rgba(0,0,0,.3);background:#fff;transition:all .2s cubic-bezier(.8,.5,.2,1.4);-webkit-transform:translate(-50%,-50%) scale(.5);opacity:0;transform:translate(-50%,-50%) scale(.5)}.alert_show .alert_msg{opacity:1;transform:translate(-50%,-50%) scale(1);-webkit-transform:translate(-50%,-50%) scale(1)}.alert_content{padding:20px 15px;font-size:14px;text-align:left}.alert_tips{position:fixed;z-index:10176523}.pc .alert_buttons{padding:6px;border-top:1px solid #ccc;text-align:right;box-shadow:0 1px 0 #fff inset;background:#eee;-webkit-user-select:none}.pc .alert_buttons .alert_btn{padding:4px 8px;margin:0 2px;border:1px solid #ccc;background:#eee;cursor:pointer;border-radius:2px;font-size:14px;outline:0;-webkit-appearance:none}.pc .alert_buttons .alert_btn:hover{border-color:#ccc;box-shadow:0 1px 2px #ccc;background:#eaeaea}.pc .alert_buttons .alert_btn:active{box-shadow:0 1px 2px #ccc inset;background:#e6e6e6}.pc.alert_tips{top:50px;right:50px}.pc.alert_tips div{background:rgba(0,0,0,.7);position:relative;color:#fff;font-size:16px;padding:10px 15px;border-radius:2px;margin-bottom:20px;box-shadow:0 0 3px #000;display:none;float:right;clear:both}.mob .alert_buttons{text-align:center;border-top:1px solid #ccc;-webkit-user-select:none}.mob .alert_buttons .alert_btn{display:inline-block;width:50%;border:0;height:40px;font-size:14px;outline:0;-webkit-appearance:none;background:#fff;-webkit-tap-highlight-color:transparent;border-radius:0 0 4px 4px}.mob .alert_buttons .alert_btn:only-child{width:100%}.mob .alert_buttons .alert_btn:first-child+.alert_btn{border-left:1px solid #ccc;border-radius:0 0 4px 0}.mob.alert_tips{width:100%;top:55%;pointer-events:none;text-align:center}.mob.alert_tips div{box-siziong:border-box;display:inline-block;padding:15px;border-radius:10px;background:rgba(0,0,0,.7);min-width:50px;max-width:230px;text-align:center;color:#fff;animation:tipsshow 3s .01s ease;-webkit-animation:tipsshow 3s .01s ease;opacity:0}@keyframes tipsshow{0%{opacity:0;transform:scale(1.4) rotateX(-360deg)}20%,80%{opacity:1;transform:scale(1) rotateX(0deg)}to{transform:scale(1.4) rotateX(360deg)}}@-webkit-keyframes tipsshow{0%,to{opacity:0}0%{-webkit-transform:scale(1.4) rotateX(-360deg)}20%,80%{opacity:1;-webkit-transform:scale(1) rotateX(0deg)}to{opacity:0;-webkit-transform:scale(1.4) rotateX(360deg)}}</style>
    <title>U袋网-鞋服包一件代发 批发</title>
    <script type="text/javascript" src="/static/index/js/scrollto.js"></script>
    <script type="text/javascript" src="/static/index/js/lcshopz.js"></script>
    <script type="text/javascript" src="/static/index/js/getarea.js"></script>
    <script>
        var content = "请填写收货信息！";
        var itemlist    = "没有选产品！";
        var rec_name    = "收货人姓名不能为空！";
        var cur_address = "收货地址不能为空！";
        var zipcode = "大陆以外地区可以不填！";
        var zipcodeerror    = "邮政编码格式错误！";
        var phone   = "电话号码、手机号必填一项！";
        var AddrCountry = "请选择国家";
        var AddrProvince    = "请选择省";
        var AddrCity    = "请选择城市";
        var AddrArea    = "请选择区(县)";
        var postmode    = "请选择送货方式";
        </script>
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
                <a href="emptysession"><?php echo $tc; ?></a>
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
            <div class="user-content__box clearfix bgf">
                <div class="title">确认付款</div>
                <form action="pay" method="post" class="shopcart-form__box">
                    <div class="shop-title">确认订单</div>
                    <div class="shop-order__detail">
                        <table class="table">
                            <tbody>
                                <?php foreach($deta as $de): ?>
                                <tr id="tr835">
                                    <td>
                                        <div class="name ep3"><?php echo $de['goods_name']; ?></div>
                                        <div class="type c9"><?php echo $de['attr']; ?></div>
                                    </td>       
                                    <td>¥<?php echo $de['price']; ?></td>
                                    <td><?php echo $de['num']; ?></td>
                                    <td>¥<?php echo $de['price']*$de['num']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="shop-cart__info clearfix">
                        <div class="pull-right text-right">
                            <input type="hidden" name="id" value="<?php echo $list['id']; ?>">
                            <div class="info-line">合计：<b class="fz18 cr">¥</b><b class="fz18 cr" id="total"><?php echo $list['total']; ?></b></div>
                        </div>
                    </div>
                    <div class="shop-title">确认支付方式</div>
                    <div class="pay-mode__box">
                        <div class="radio-line radio-box">
                            <label class="radio-label ep">
                                <?php if($list['payment']==1): ?>
                                <span class="fz16">银行卡支付</span>
                                <?php elseif($list['payment']==2): ?>
                                <span class="fz16">支付宝支付</span>
                                <?php else: ?>
                                <span class="fz16">微信支付</span>
                                <?php endif; ?>
                            </label>
                        </div>
                    </div>
                    <div class="user-form-group shopcart-submit">
                    <button type="submit" class="btn">确认付款</button> 
                    </div>
                    <script>
                        $(document).ready(function(){
                            $(this).on('change','input',function() {
                                $(this).parents('.radio-box').addClass('active').siblings().removeClass('active');
                            })
                        });
                    </script>
                </form>
            </div>
        </section>
    </div>
<script type="text/javascript">
    window.onload=function(){
    Calculate();
    }
</script> 
    <!-- 右侧菜单 -->
    <div class="right-nav">
        <ul class="r-with-gotop">
            <li class="r-toolbar-item">
                <a href="http://www.wjudw.com/udai_welcome.php" class="r-item-hd">
                    <i class="iconfont icon-user"></i>
                    <div class="r-tip__box"><span class="r-tip-text">用户中心</span></div>
                </a>
            </li>
            <li class="r-toolbar-item">
                <a href="http://www.wjudw.com/shopcart.php?act=list" class="r-item-hd">
                    <i class="iconfont icon-cart" data-badge="1"></i>
                    <div class="r-tip__box"><span class="r-tip-text">购物车</span></div>
                </a>
            </li>
            <li class="r-toolbar-item">
                <a href="http://www.wjudw.com/member.php?act=collect" class="r-item-hd">
                    <i class="iconfont icon-aixin"></i>
                    <div class="r-tip__box"><span class="r-tip-text">我的收藏</span></div>
                </a>
            </li>
            <li class="r-toolbar-item">
                <a href="http://www.wjudw.com/contactus.php" class="r-item-hd">
                    <i class="iconfont icon-liuyan"></i>
                    <div class="r-tip__box"><span class="r-tip-text">留言反馈</span></div>
                </a>
            </li>
            <li class="r-toolbar-item to-top" style="cursor: pointer; display: none;">
                <i class="iconfont icon-top"></i>
                <div class="r-tip__box"><span class="r-tip-text">返回顶部</span></div>
            </li>
        </ul>
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
    <script>
        $(document).ready(function(){ $('.to-top').toTop({position:false}) });
    </script>
</body>
</html>