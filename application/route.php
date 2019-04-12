<?php
namespace Home\Controller;
use Home\Model\NoticeModel;
use Home\Model\Order_customer_logModel;
use Home\Model\Order_customerModel;
use Think\Model;
class OrderController extends CommonController{
    //导入订单,主页
    public function index()
    {
        $this->display();
    }
    //ajax 获取平台
    public function getarea()
    {
        $map['status']='1';
        $return=M('platform')->where($map)->select();
        return $this->ajaxReturn($return);
    }
    //ajax 返回指定平台下的账户
    public function getplatformAjax()
    {
        $condition['platform_account.platform_id']=$_POST["platform"];//平台的id
        //$condition['platform_id'] = M('platform')->where($map)->getField('id');
        $condition['pl_account_user.status']='1';
        $condition['platform_account.status']='1';
        $condition['pl_account_user.uid']=$_SESSION['user_info']['uid'];//当前用户id
        $return=M('platform_account')
            ->where($condition)
            ->field('
            platform_account.id as id,
            platform_account.account_number_name as name        
            ')
            ->join('LEFT JOIN platform ON platform_account.platform_id=platform.id')
            ->join('LEFT JOIN pl_account_user ON pl_account_user.pl_account_id=platform_account.id')
            ->where($condition)
            ->select();
        return $this->ajaxReturn($return);
    }
    //导入订单
    public function salesOrders()
    {
        $file=$_FILES['file']['tmp_name'];//获取临时文件名
        //平台类型
        $platformmap['id']=$_POST['platform'];
        //根据id查询 平台
        $pingtai=M('platform')->where($platformmap)->getField('type');
        $id=$_POST['platform_id'];//外部账号 id
        if ($pingtai=="amazon")
        {
            $str = file_get_contents($file);//将整个文件内容读入到一个字符串中
            $str_encoding = mb_convert_encoding($str, 'UTF-8', 'ASCII');//转换字符集（编码）
            $arr = explode("\r\n", $str_encoding);//转换成数组
            $Amazon=array();
            //切割数组
            foreach ($arr as &$row)
            {
                if (!empty($row))
                {
                    $Amazon[]=explode("\t",$row);//每一行都分割成数组的元素
                }
            }
            unset($row);
            //找到每一项的key;
            $sign=array();//key的数组,索引导入的订单各项信息的key
            $sign['sku']=array_search('sku',$Amazon[0]);
            $sign['order-id']=array_search('order-id',$Amazon[0]);// 亚马逊 订单号
            $sign['buyer-email']=array_search('buyer-email',$Amazon[0]);//买家邮件
            $sign['buyer-name']=array_search('buyer-name',$Amazon[0]);//买家姓名
            $sign['recipient-name']=array_search('recipient-name',$Amazon[0]);//收件人姓名
            $sign['buyer-phone-number']=array_search('buyer-phone-number',$Amazon[0]);//买家联系电话
            $sign['quantity-purchased']=array_search('quantity-purchased',$Amazon[0]);//数量
            $sign['ship-service-level']=array_search('ship-service-level',$Amazon[0]);//邮寄方式
            $sign['ship-address-1']=array_search('ship-address-1',$Amazon[0]);//收件地址1
            $sign['ship-address-2']=array_search('ship-address-1',$Amazon[0]);//收件地址1
            $sign['ship-city']=array_search('ship-city',$Amazon[0]);//ship-收件 城市
            $sign['ship-state']=array_search('ship-state',$Amazon[0]);//收件 州/省
            $sign['ship-country']=array_search('ship-country',$Amazon[0]);//收件国家
            $sign['ship-postal-code']=array_search('ship-postal-code',$Amazon[0]);//
            //$sign['']=array_search('',$Amazon[0]);
            //将亚马逊数组的内容转换为下一步流程数组
            $arryama=$Amazon;
            foreach ($arryama as $key=>$value )
            {
                if ($key==0)
                {
                    $value_previous=0;
                    continue;//删除第一次
                }
                $order[]
                    =$value_previous
                    =array
                (
                    "source_accountid"=>$id, // 外部账号id
                    "source_orderid"=>$value{$sign['order-id']},//外部 订单号
                    "sku"=>$value{$sign['sku']},//订单内的sku
                    "asin"=>$this->getasin($value{$sign['sku']}),//订单内的sku对应的asin 如果没做关联这一项是空
                    "buyer_last_name"=>$value{$sign['buyer-name']},//买家姓名
                    "recipient_last_name"=>$value{$sign['recipient-name']},//收件人姓名
                    "buyer_phone"=>$value{$sign['buyer-phone-number']},//收件人电话
                    "buyer_email"=>$value[$sign['buyer-email']],//收件人联系方式email
                    "street_1"=>$value{$sign['ship-address-1']},//收件地址街道1
                    "street_2"=>$value{$sign['ship-address-2']},//收件地址街道2
                    "street_3"=>$value{$sign['ship-address-3']},//收件地址街道3
                    "country"=>$value{$sign['ship-country']},//国家
                    "ship_level"=>$value{$sign['ship-service-level']},//邮寄方式
                    "state"=>$value{$sign['ship-state']},//州或省
                    "city"=>$value{$sign['ship-city']},//市
                    "zip"=>$value{$sign['ship-postal-code']},//邮编
                    "order_price"=>'暂无',//订单价格
                    //"ebay_title"=>$value{$sign['sku']},///外部平台的产品变量,substr字符串截取函数
                );
            }
            fclose($file);//关闭资源
            //查找为空的值,标注出来.
            $warning=$this->verificationOrder($order);
            $warningson=json_encode((object)$warning);//筛选不正确的值;
            $orderjson=json_encode($order);
            $this->assign('orderjson',$orderjson);
            $this->assign('warningjson',$warningson);
            $this->assign('order',$order);
            $this->display('amznOrders');
        }
        //todo 导入ebay
        if ($pingtai=="ebay"){
            //$file = fopen($file,'r');//读取文件
            $filter=true;//空行删除,ing todo old
            $str = file_get_contents($file);//将整个文件内容读入到一个字符串中
            $str_encoding = mb_convert_encoding($str, 'UTF-8', 'ASCII');//转换字符集（编码）
            $arr = explode("\r\n", $str_encoding);//转换成数组

            $goods_list=array();
            //切割数组
            foreach ($arr as $k=>$row)
            {
                if ($k==0)
                {
                    $
                }
                if (!empty($row))
                {
                    $hang=explode('","',$row);//每一行都分割成数组的元素
                    foreach ($hang as $var){
                        $datax[]=trim($var,'"');
                    }
                    $goods_list[]=$datax;
                    unset($datax);
                }
            }
            unset($row);

            //循环读取
//            while ($data = fgetcsv($file))
//            {
//                //每次读取CSV里面的一行内容
//                if (strlen($data[0])>0)//如果这一行的第一个值不为空 继续程序 避免错误文件
//                {
//                    if ($filter)
//                    {
//                        $data[0]=str_replace("\t","",$data[0]);
//                        $filter=false;
//                    }
//
//                    //$goods_list 是处理结果的
//                    $goods_list[]=$data;
//                }
//            }
            array_pop($goods_list);//删除csv最后一行
            array_pop($goods_list);//删除csv最后一行
            //标记字段
            $mark['postage']=array_search("Postage Service",$goods_list[0]);//邮寄方式$mark['Postage']
            if ($mark['Postage']==false)
            {
                $mark['Postage']=array_search("Shipping Service",$goods_list[0]);
            }
            $mark['variation']=array_search("Variation Details",$goods_list[0]);//变量 $mark['variation']
            $mark['number']=array_search("Item Number",$goods_list[0]);//产品号 $mark['number']
            $mark['UserId']=array_search("User Id",$goods_list[0]);//User Id 买家名
            $mark['Fullname']=array_search("Buyer Fullname",$goods_list[0]);//Buyer Fullname 收件人姓名
            $mark['totalprice']=array_search("Total Price",$goods_list[0]);//订单价格
            $mark['phone']=array_search("Buyer Phone Number",$goods_list[0]);//Buyer Phone Number 买家电话
            foreach ( $goods_list as $key=>$value )
            {
                //不符合条件的上传文件,排除
                if (count($value)<38)
                {
                    break;
                }
                //!=0 ,剔除第一行
                if($key!=0)
                {
                    $previous=$goods_list[$key-1][0];//上一条的订单号
                    $next=$goods_list[$key+1][0];//下一条的订单号
                    //如果当前记录和下一条记录 外部订单号相同:是合并
                    if($previous!=$value[0]){
                        //order 销售订单 主表
                        $saorder=array(
                            //外部订单号
                            "external_sn"=>$value[0],//ebay订单号,
                            "platform_id"=>$id,//账号id
                            "type"=>'ebay',//订单类型
                            "fullname"=>$value[$mark['Fullname']],//收件人姓名
                            "buyer_phone"=>$value[$mark['phone']],//买家电话
                            "street_1"=>$value[5],//收件地址第一行
                            "street_2"=>$value[6],//收件地址第二行
                            "country"=>$value[10],//国家
                            "state"=>$value[7],//州或省
                            "city"=>$value[8],//市
                            "zip"=>$value[9],//邮编
                            "status"=>1,// 导入 ,订单状态
                            "totalprice"=>$value[$mark['totalprice']],//Total Price 订单价格
                        );
                        //测试代码
//                        $encode = mb_detect_encoding($saorder['state'], array("ASCII","UTF-8","GB2312","GBK","BIG5"));
//                        $sssss=mb_convert_encoding($saorder['state'],'UTF-8','ASCII');
                        $ordercust_id=M('order_customer')->data($saorder)->add();
                        $saorder['id']=$ordercust_id;
                        $saorder['pidvar']=$this->inspectOrder($value[$mark['number']],$value[$mark['variation']]);
                        $order[]=$saorder;
                        $saorder=null;
                        if($next===$value[0])//如果,当前记录-ebay订单号与前一个不同,下一个相同,这记录是一个合并订单,它只计入主表
                        {
                            continue; // 跳出本次循环,
                        }
                    }
                       //销售订单分表
                       $ebayorder=array(
                           "ordercust_id"=>$ordercust_id,//id
                           "status"=>1,// 导入 ,订单状态
                           "external_sn"=>$value[0],//ebay订单号,
                           "create_time"=>date("Y-m-d H:i:s", time()),//导入时间
                           "ebayuserid"=>$value[$mark['UserId']],//ebay买家名
                           "ebay_number"=>$value[$mark['number']],//外部平台的产品 number
                           "ebay_variable"=>$value[$mark['variation']],//ebay 变量 variable
                           "ship_level"=>$value[$mark['postage']],//邮寄方式
                       );
                       $ebay_order=M('ebay_order')->data($ebayorder)->add();
                    /**
                    $order[]=array(
                        "account_id"=>$id, // 外部账号id
                        "source_orderid"=>$value[0],//外部 订单号
                        "userid"=>$value[$mark['UserId']],//买家姓名
                        "buyer_last_name"=>$value[2],//买家姓名
                        "recipient_last_name"=>"",//收件人姓
                        "buyer_phone"=>$value[3],//收件人电话
                        "buyer_email"=>$value[4],//收件人联系方式
                        "street_1"=>$value[5],//收件地址第一行
                        "street_2"=>$value[6],//收件地址第二行
                        "country"=>$value[10],//国家
                        "ship_level"=>$value[$mark['postage']],//邮寄方式
                        "state"=>$value[7],//州或省
                        "city"=>$value[8],//市
                        "zip"=>$value[9],//邮编
                        "totalprice"=>$value[$mark['totalprice']],//Total Price 订单价格
                        "ebay_number"=>$value[$mark['number']],//外部平台的 number
                        "ebay_variable"=>$value[$mark['variation']]//ebay 变量 variable
                    );
                    //如果低于38,认为文件有问题,结束导入
                     **/

                }

            }
            fclose($file);//关闭资源
            //$order 是最后的结果
            //$orderjson=json_encode($order);
            //$this->assign('orderjson',$orderjson);
            $this->assign('order',$order);
            $this->display('ebayOrderOut');
        }
    }

    //1导入amazon 或 ebay 订单2或者 3
    //2sku->asin->bom 4
    //3 Item+变量->bom
    //todo 检查,订单
    public function inspectOrder($number,$var)
    {
        $where["ebaysn"]=(string)$number.(string)$var;
        $pd=M('ebay_variable')->where($where)->find();
        if (!empty($pd['bom_id']))
        {
            $re= true;
        }else{
            $re=  false;
        }
        return $re;
    }

    //4 导入销售订单
    //5 显示所有订单,和订单状态
    //合并



    //查找 ebay产品与系统产品的连接 文件名name和产品id
    //todo 待重构 ,chy2019年1月7日18:46:09
    public function evenebay($eaby,$eabynumber)
    {
        $need=array();
        $need['ebay_join.state']="1";
        $need['ebay_join.platform_number']=$eaby;
        $need['ebay_join.platform_title']=$eabynumber;
        $newmodel = new \Home\Model\Ebay_joinModel();
        $return=$newmodel->getEbayPid($need);
        return $return;
    }
//  订单验证
//  对关键字段进行验证,如果值不正确,则设置为问题订单
//  返回问题订单的值
    public function verificationOrder($orders)
    {
        foreach ($orders as $k=>$v)
        {
            foreach ($v as $key=>$value)
            {
                //如果有值为空,则标注为问题订单
                if (empty($value))
                {
                    //第二行地址和第三行地址以及联系人电话可以为空
                    if ($key!='street_3' and  $key!='street_2' and $key!='buyer_phone')
                    {
                    $result[$k][]=$key;
                    continue;
                    }
                }
                if($key=='buyer_email')
                {
                    if(!filter_var($value, FILTER_VALIDATE_EMAIL))
                    $result[$k][]=$key;
                    continue;
                }
            }
        }
        return $result;
    }
    //提交订单
    //todo 处理订单 ?
    public function submitOrder()
    {
        //接收数据
        $arr=json_decode($_POST['orderjson']);
        exit;
        //$this->display();
    }

    //todo 订单进行合并? ..
    //同一姓名 同样的收货地址 设置为一样的内部订单号,统一发货
    public function mergeOrder()
    {

    }
    // 订单.产品链接内外pid
    // 外部订单,通过sku 查询到产品ip返回
    // 内部调用 查询sku对应的 asin pid
    public function getasin($sku=0)
    {
        if ($sku==0){ return null; }
        $ASINsku=new  \Home\Model\Asin_skuModel();
        $re=$ASINsku->getasinSku($sku);
        if (empty($re)){ return null; }
        $asin=$re['asin'];
        return $asin;
    }
    //todo ajax返回 产品清单信息
    // ajax返回,为页面查询 ,sku 对应的内部产品清单信息
    public function getAsinLinkPrAjax()
    {
        $asin=$_POST['asin'];
        $list=D('OrderCustomerBom')->getAsinBomlist($asin);
        $this->ajaxReturn($list);
    }
    //todo  asin 链接 pid
    public function linkAsinToPid()
    {
        //接受发过来的asin
        $asin=$_POST['asin'];
        //介绍post来的提交的 对应的产品 pid数组
        $asindata=$_POST['asinlist'];
        foreach ($asindata as $value)
        {
            if($value['number']<1){$value['number']=1;}//如果为正确填入数量,默认为1.
            if (empty($value)){continue;}//如果本行记录为空 ,跳过,进入下一记录
            //$asindata 一个asin对应的所有产品
            //$value asin对应的一个产品
            $data[]=array(
                'asin'=>$asin,//asin
                'type'=>1,//1 为销售订单
                'status'=>1,//状态为生效
                'pid'=>$value['pid'],//产品pid
                'time'=>date("Y-m-d H:i:s", time()),//导入时间
                'number'=>(int)$value['number']//产品的数量
            );
        }
//todo 记录下修改的记录
        //todo 需要重构 2019年1月7日18:33:49
        $reif=M('order_customer_bom')->addAll($data);
        if ($reif!=null)
        {
            $this->ajaxReturn('ok');
        }
        $this->ajaxReturn('no');//添加失败
    }

    /**
     * 显示某一账号下所有的产品链接
     *
     */
    //todo 显示所有asin
    public function indexToProduct()
    {

        if ($_GET['account'])
        {
            $where['account_id']=$_GET['account'];
            $where['status']=1;
            $list=M('asin_sku')->where($where)->select();
            $this->assign('list',$list);
        }
        $this->display();
    }
    //todo 显示所有ebay 关联 产品
    public function indexEbayProduct()
    {
        //查询,外部账号
        $account='linux@163.com';
        if ($_GET['account'])
        {
            //
            $where['ebay_spu.account_id']=$_GET['account'];
            $where['ebay_spu.status']=1;
            $ebay=new \Home\Model\Ebay_spuModel();
            $requst=$ebay->getspu($where);
            //$list=M('ebay_spu')->where($where)->select();
            $this->assign('list',$requst['list']);
            $this->assign('page',$requst['page']);
        }
        $this->assign('account',$account);
        $this->display();
    }




    //导入 外部sku的页面
    public function asinlinkSkuOrder()
    {
        $this->display();
    }
    // 批量导入外部sku 对应 asin
    public function alladdProductAsinSku()
    {
        $file=$_FILES['file']['tmp_name'];//获取临时文件名
        //平台类型
        $platformmap['id']=$_POST['platform'];
        //根据id查询 平台
        $pingtai=M('platform')->where($platformmap)->getField('type');
        if ($pingtai=="amazon")
        {
            $str = file_get_contents($file);//将整个文件内容读入到一个字符串中
            $str_encoding = mb_convert_encoding($str, 'UTF-8', 'ASCII');//转换字符集（编码）
            $arr = explode("\r\n", $str_encoding);//转换成数组
            $Amazon=array();
            //切割数组
            foreach ($arr as &$row)
            {
                if (!empty($row))
                {
                    $Amazon[]=explode("\t",$row);//每一行都分割成数组的元素
                }
            }
            unset($row);
            //删除第一行,第一行是 字段标识
            array_splice($Amazon,0,1);
            //写入操作日志,导入操作.
            $platform_account_id=(int)$_POST['platform_id'];//当前外部账号 id
            $operating='asinImport';//'操作说明,asinImport,导入',
            $log=new \Home\Model\Account_logModel();
            $loggingid=$log->addlog($platform_account_id,$operating);//操作记录
            $loggingid=(int)$loggingid;//添加的操作id
            foreach ($Amazon as $key=>$value )
            {
                //data 为存入 asin_sku 表的表关系
                $date[]=array(
                            'sku'=>$value[0],
                            'asin'=>$value[1],
                            'price'=>$value[2],
                            'status'=>1,
                            'account_id'=>$platform_account_id ,
                            'logging_id'=>$loggingid
                    );
            }
            fclose($file);//关闭资源
            //账号下的asku 标记
            //标记为逻辑删除的所有
            $where['account_id']=$platform_account_id;
            $delnumber=M('asin_sku')->where($where)->setField('status','2');
            if($delnumber>0){
                $operating='asin\\tdell\\t'.(string)$delnumber;   //操作说明,dell,导入'
                //todo 需要消息注入,需要一个可逆操作的标识
                //todo 需要删除.2019年1月7日18:30:41
                //$xxx=new \Home\Model\Account_logModel();
                $delllogid=$log->addlog($platform_account_id,$operating);//操作记录 删除了多少
            }
            $return=M('asin_sku')->addAll($date);
            $ppt='成功添加asin'.(string)$return.'条记录';
            $ppt=$ppt.'<br />成功删除asin'.(string)$delnumber.'条记录';
            $this->success($ppt, U("Order/asinlinkSkuOrder"));
        }
        return null;

    }
    //平台主页
    public function plindex()
    {
        $map['status'] = '1';
        $list = M('platform')->where($map)->select(); //查询条件状态为1
        $this->assign('list',$list);
        $this->display();
    }
    //添加平台
    public function plAdd()
    {
        if (IS_POST){
            $lis['name'] = trim(I('post.name'));//trim 去掉传过来值两边的空格
            $lis['type'] = I('post.type');
            $lis['status'] = '1';
            $where['name'] = $lis['name'];
            $where['status'] = '1';
            $where['type'] = $lis['type'];
            $userInfo = M('platform')->where($where)->find();
            if (empty($lis['name']) AND empty($lis['type'])){
                $this->ajaxReturn('KO','JSON');
            }elseif (!empty($userInfo['id'])){  //判断平台名称，状态，类型都符合（不为空）情况下则为真
                $this->ajaxReturn('NO','JSON');
            }else{
                $info = M('platform')->data($lis)->add();
                $this->ajaxReturn('OK','JSON');
            }
        }
    }
    //修改平台
    public function plupdate()
    {
        if (IS_POST){
            $id = I('post.id');
            $lis['name'] = trim(I('post.name'));//trim 去掉传过来值两边的空格
            $lis['type'] = I('post.type');
            $where['name'] = $lis['name'];
            $where['type'] = $lis['type'];
            $where['status'] = '1';
            $userInfo = M('platform')->where($where)->find();
            if (empty($lis['name'])) {
                $this->ajaxReturn('KO', 'JSON');
            }elseif (!empty($userInfo['id'])){
                $this->ajaxReturn('NO','JSON');
            }else{
                $map['id']=$id;
                $info = M('platform')->where($map)->save($lis);
                $this->ajaxReturn('OK','JSON');
            }
        }
    }
    //删除平台
    public function pldelete(){
        if (IS_POST) {
            $id = I('post.id');
            $map['id'] = $id; //平台id
            $data['status'] = '2';
            $data = M('platform')->where($map)->setField($data); //修改对应表指定字段(状态)为2
            $this->ajaxReturn($data);
        }
    }
    //外部帐号信息
    public function plShow(){
        $id = I('get.id');
        $map=array();
        $map['platform_id'] = $id;
        $search = trim($_GET['search']);//获取搜索条件
        if (!empty($search))
        {
            $map['platform_account.account_number'] = array('like', "%" .$search. "%", 'or');
            //将get传过来的值赋值给platform_account表里的字段account_number
        }
        $x=new  \Home\Model\Platform_accountModel();
        $result=$x->accountShow($map); //查询platform_account表里的字段account_number值为搜索传来的值
        $this->assign('pid',$map['platform_id']);
        $this->assign('list',$result['list']);
        $this->assign('page',$result['page']);
        $this->display();
    }
    //添加外部账号
    public function zhAdd(){
        if (IS_POST){
            $data['account_number'] = trim(I('post.account_number'));//trim 去掉传过来值两边的空格
            $data['account_number_name'] = trim(I('post.account_number_name'));
            $data['platform_id'] = I('post.platform_id');
            $data['status'] = '1';
            $where['account_number'] = $data['account_number'];
            $where['platform_id'] = $data['platform_id'];
            $where['status'] = '1';
            $userInfo = M('platform_account')->where($where)->find();
            if (empty($data['account_number']) AND empty($data['account_number_name'])){
                $this->ajaxReturn('KO','JSON');
            }elseif (!empty($userInfo['id'])){
                $this->ajaxReturn('NO','JSON');
            }else{
                $info = M('platform_account')->data($data)->add();
                $this->ajaxReturn('OK','JSON');
            }
        }
    }
    //修改外部账号
    public function upAccount(){
        if (IS_POST){
            $map['id'] = I('post.id');
            $lis['account_number'] = trim(I('post.account_number'));//trim 去掉传过来值两边的空格
            $where['account_number'] = $lis['account_number'];
            $where['platform_id'] = I('post.pid');
            $where['status'] = '1';
            $userInfo = M('platform_account')->where($where)->find();
            if (empty($lis['account_number'])) {
                $this->ajaxReturn('KO', 'JSON');
            }elseif (!empty($userInfo['id'])){
                $this->ajaxReturn('SO','JSON');
            }else{
                $info = M('platform_account')->where($map)->save($lis);
                $this->ajaxReturn('OK','JSON');
            }
        }
    }
    //删除外部账号
    public function zhDel(){
        if (IS_POST){
            $id = I('post.id');
            $map['id'] = $id;
            $data['status'] = '2';
            $data = M('platform_account')->where($map)->setField($data);
            $this->ajaxReturn($data);
        }
    }
    //用户本机的关联外部账号
    public function externalMe()
    {
        $id = I('get.id');
        $map['pl_account_user.pl_account_id']=$id; //关联外部账号id
        $map['pl_account_user.status'] = '1';
        $user = M('pl_account_user')->where($map)
            ->field('
                    user_info.lastnamezh as lastnamezh,
                    user_info.namezh as namezh,
                    user_info.id as id,
                    user_info.uid as uid
            ')
            ->join('LEFT JOIN user_info ON pl_account_user.uid=user_info.uid')
            ->select();
        $np['id']=$id;//关联外部账号id
        $np['status'] = '1';
        $pid = M('platform_account')->where($np)->field('id,account_number,platform_id')->find();
        $mab['id'] = $pid['platform_id'];   //将关联外部账号表的platform_id赋值给平台表的id
        $pt = M('platform')->where($mab)->field('name')->find();    //查询平台id
        $this->assign('ptname',$pt['name']);
        $this->assign('pid',$pid['account_number']);
        $this->assign('sid',$pid['id']);
        $this->assign('list',$user);
        $this->display();
    }
    //添加内部用户
    public function externalAdd(){
        if (IS_POST) {
            $map['status'] = "1";
            $list = M('user_info')->where($map)->field('id,lastnamezh,namezh,uid,status')->select();
            $this->ajaxReturn($list);
        }
    }
    //执行内部用户添加
    public  function externalInster(){
        if (IS_POST) {
            $map['pl_account_id'] = I('post.pl_account_id');
            $map['status'] = '1';
            $uid = I('post.uid');
            foreach ($uid as $k => $v) {
                $map['uid'] = $uid[$k]; //遍历$uid下标赋值给$map['uid']
                $Result = M('pl_account_user')->data($map)->add();
            }
            $this->ajaxReturn($Result);
        }
    }
    //删除内部用户
    public function externalDel(){
        if (IS_POST) {
            $uid = I('post.uid');
            $map['uid'] = $uid; //内部用户uid
            $data['status'] = '2';
            $data = M('pl_account_user')->where($map)->setField($data);
            $this->ajaxReturn($data);
        }
    }
    //订单列表
    public function orderlist(){
        $this->display();
    }

    //订单详情
    public function orderdetails(){
        $map=array();
        $map['asin_sku.status']= 1;
        $map['order_customer.id']=(int)$_POST['oid'];
        $user = new \Home\Model\Order_customerModel();
        $list=$user->orderdetails($map);
        $this->ajaxReturn($list);
    }

    //订单查询
    public function ordertrack(){
        $this->display();
    }

    //订单搜索
    public function ordersearch(){
        $user=new \Home\Model\Order_customerModel();
        $list=$user->ordersearch();
        $this->ajaxReturn($list);
    }

    //更新订单
    public function updateorder(){
        $map['id']=$_POST['id'];
        $data['recipient_first_name']=$_POST['recipient_first_name'];
        $data['country']=$_POST['country'];
        $data['state']=$_POST['state'];
        $data['city']=$_POST['city'];
        $data['buyer_phone']=$_POST['buyer_phone'];
        $data['buyer_email']=$_POST['buyer_email'];
        $data['street_1']=$_POST['street_1'];
        $data['street_2']=$_POST['street_2'];
        $data['street_3']=$_POST['street_3'];
        $data['zip']=$_POST['zip'];
        $result=M()->table('order_customer')->where($map)->save($data);//更新订单信息
        if($result){
            $list='1';
        }else{
            $list='0';
        }
        $log=new Order_customer_logModel();
        //日志内容
        $o_id=$_POST['o_number'];
        $modify='save.recipient_first_name.'.$data['recipient_first_name'].'&country.'.$data['country'].'&state.'.$data['state']
                .'&city.'.$data['city'].'&buyer_phone.'.$data['buyer_phone'].'&buyer_email.'.$data['buyer_email']
                .'&street_1.'.$data['street_1'].'&street_2.'.$data['street_2'].'&street_3.'.$data['street_3'].'&zip.'.$data['zip'];
        $log->logs($modify,$o_id);
        $this->ajaxReturn($list);
    }

    //下拉查询
    public function seachproduct(){
        $search=trim($_POST['search']);  //去除空格
        if (!empty($search)) {
            $map['product.namezh'] = array('like', $search);
            $list=M('product')->where($map)->field('id','namezh')->select();
            $this->ajaxReturn($list);
        }
    }

    //产品表
    public function productlist(){
        $map['product.status']='1';
        $product = M('product')->where($map)
            ->join('LEFT JOIN order_customer_bom on product.id = order_customer_bom.pid')
            ->field('product.id,
                     product.bclass,
                     product.sclass,
                     product.number,
                     product.namezh,
                     product.status,
                     product.thumb,
                     product.shortname,
                     order_customer_bom.pid,
                     order_customer_bom.price,
                     order_customer_bom.number as num')
            ->select();//查询产品表
        $this->ajaxReturn($product);
    }

    //产品价格表
    public function productprice(){
        $map['product.status']='1';
        $price=M('product')->where($map)
            ->join('RIGHT JOIN order_customer_bom on product.id = order_customer_bom.pid')
            ->field('product.id,
                     product.namezh,
                     order_customer_bom.price')
            ->select();
        $this->ajaxReturn($price);
    }

    //打印
    public function printorder(){
        $map = $_POST['arr'];//修改条件
        $where['id']=array('in',$map);
        $data['status_id']=4;//赋值需要改变的状态
        $result=M()->table('order_customer')->where($where)->save($data);
        if($result){
            $list='1';
        }else{
            $list='0';
        }
        $log=new Order_customer_logModel();
        $o_number=$_POST['o_number'];
        $count=count($o_number);
        for($i=0;$i<$count;$i++){
            $o_id=$o_number[$i];
            $modify='save.status_id.'.$data['status_id'];//日志内容
            $log->logs($modify,$o_id);
        }
        $this->ajaxReturn($list);
    }

    //打印完成
    public function notship(){
        $map = $_POST['arr'];//修改条件
        $where['id']=array('in',$map);
        $data['status_id']=5;//赋值需要改变的状态
        $result=M()->table('order_customer')->where($where)->save($data);
        if($result){
            $list='1';
        }else{
            $list='0';
        }
        $log=new Order_customer_logModel();
        $o_number=$_POST['o_number'];
        $count=count($o_number);
        for($i=0;$i<$count;$i++){
            $o_id=$o_number[$i];
            $modify='save.status_id.'.$data['status_id'];//日志内容
            $log->logs($modify,$o_id);
        }
        $this->ajaxReturn($list);
    }

    // 发货
    public function shipped(){
        $map['id'] = $_POST['id'];//修改条件
        $data['logistics_number']=$_POST['logistics'];//获取物流追踪号
        $data['status_id']=6;//赋值需要改变的状态
        $result=M()->table('order_customer')->where($map)->save($data);
        if($result){
            $list='1';
        }else{
            $list='0';
        }
        $log=new Order_customer_logModel();
        $o_id=$_POST['o_number'];
        $modify='save.status_id.'.$data['status_id'];//日志内容
        $log->logs($modify,$o_id);
        $modify='add.logistics_number.'.$data['logistics_number'];//日志内容
        $log->logs($modify,$o_id);
        $this->ajaxReturn($list);
    }

    //问题订单页面
    public function problemorder(){
        $this->display();
    }

    //问题订单
    public function sickorder(){
        $map['id'] = $_POST['id'];//修改条件
        $data['status_id']=7;//赋值需要改变的状态
        $result=M()->table('order_customer')->where($map)->save($data);
        if($result){
            $list='1';
        }else{
            $list='0';
        }
        $addnotice=new NoticeModel();
        $type=50;
        $text_id=1;
        $direction='Order/problemorder';
        $addnotice->addnotice($type,$text_id,$direction);
        $log=new Order_customer_logModel();
        $o_id=$_POST['o_number'];
        $modify='save.status_id.'.$data['status_id'];//日志内容
        $log->logs($modify,$o_id);
        $this->ajaxReturn($list);
    }

    //取消问题订单
    public function cancelsickorder(){
        $map['id'] = $_POST['id'];//修改条件
        $data['status_id']=2;//赋值需要改变的状态
        $result=M()->table('order_customer')->where($map)->save($data);
        if($result){
            $list='1';
        }else{
            $list='0';
        }
        $log=new Order_customer_logModel();
        $o_id=$_POST['o_number'];
        $modify='save.status_id.'.$data['status_id'];//日志内容
        $log->logs($modify,$o_id);
        $this->ajaxReturn($list);
    }

    //中国问题订单
    public function problemCHN(){
        $data['status_id']=7;
        $data['country']='China';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $orderjson=json_encode($list['list']);
        $this->assign('orderjson',$orderjson);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','chn');
        $this->display('problemorder');
    }

    //美国问题订单
    public function problemUSA(){
        $data['status_id']=7;
        $data['country']='America';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $orderjson=json_encode($list['list']);
        $this->assign('orderjson',$orderjson);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','usa');
        $this->display('problemorder');
    }
    //澳大利亚问题订单
    public function problemAUS(){
        $data['status_id']=7;
        $data['country']='Australia';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $orderjson=json_encode($list['list']);
        $this->assign('orderjson',$orderjson);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','aus');
        $this->display('problemorder');
    }
    //加拿大问题订单
    public function problemCAN(){
        $data['status_id']=7;
        $data['country']='Canada';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $orderjson=json_encode($list['list']);
        $this->assign('orderjson',$orderjson);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','can');
        $this->display('problemorder');
    }
    //墨西哥问题订单
    public function problemMEX(){
        $data['status_id']=7;
        $data['country']='Mexico';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $orderjson=json_encode($list['list']);
        $this->assign('orderjson',$orderjson);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','mex');
        $this->display('problemorder');
    }

    //中国未打印订单
    public function orderCHN(){
        $data['status_id']=2;
        $data['country']='China';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $orderjson=json_encode($list['list']);
        $this->assign('orderjson',$orderjson);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','chn');
        $this->display('orderlist');
    }
    //美国未打印订单
    public function orderUSA(){
        $data['status_id']=2;
        $data['country']='America';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $orderjson=json_encode($list['list']);
        $this->assign('orderjson',$orderjson);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','usa');
        $this->display('orderlist');
    }
    //澳大利亚未打印订单
    public function orderAUS(){
        $data['status_id']=2;
        $data['country']='Australia';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $orderjson=json_encode($list['list']);
        $this->assign('orderjson',$orderjson);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','aus');
        $this->display('orderlist');
    }
    //加拿大未打印订单
    public function orderCAN(){
        $data['status_id']=2;
        $data['country']='Canada';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $orderjson=json_encode($list['list']);
        $this->assign('orderjson',$orderjson);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','can');
        $this->display('orderlist');
    }
    //墨西哥未打印订单
    public function orderMEX(){
        $data['status_id']=2;
        $data['country']='Mexico';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $orderjson=json_encode($list['list']);
        $this->assign('orderjson',$orderjson);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','mex');
        $this->display('orderlist');
    }

    //打印中订单
    public function orderinprint(){
        $this->display();
    }

    //中国打印中订单
    public function orderingCHN(){
        $data['status_id']=4;
        $data['country']='China';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $orderjson=json_encode($list['list']);
        $this->assign('orderjson',$orderjson);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('areaing','chn');
        $this->display('orderinprint');
    }
    //美国打印中订单
    public function orderingUSA(){
        $data['status_id']=4;
        $data['country']='America';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $orderjson=json_encode($list['list']);
        $this->assign('orderjson',$orderjson);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('areaing','usa');
        $this->display('orderinprint');
    }
    //澳大利亚打印中订单
    public function orderingAUS(){
        $data['status_id']=4;
        $data['country']='Australia';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $orderjson=json_encode($list['list']);
        $this->assign('orderjson',$orderjson);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('areaing','aus');
        $this->display('orderinprint');
    }
    //加拿大打印中订单
    public function orderingCAN(){
        $data['status_id']=4;
        $data['country']='Canada';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $orderjson=json_encode($list['list']);
        $this->assign('orderjson',$orderjson);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('areaing','can');
        $this->display('orderinprint');
    }
    //墨西哥打印中订单
    public function orderingMEX(){
        $data['status_id']=4;
        $data['country']='Mexico';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $orderjson=json_encode($list['list']);
        $this->assign('orderjson',$orderjson);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('areaing','mex');
        $this->display('orderinprint');
    }

    //未发货订单
    public function notshipped(){
        $this->display();
    }

    //中国未发货订单
    public function notshippedCHN(){
        $data['status_id']=5;
        $data['country']='China';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','chn');
        $this->display('notshipped');
    }

    //美国未发货订单
    public function notshippedUSA(){
        $data['status_id']=5;
        $data['country']='America';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','usa');
        $this->display('notshipped');
    }

    //澳大利亚未发货订单
    public function notshippedAUS(){
        $data['status_id']=5;
        $data['country']='Australia';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','aus');
        $this->display('notshipped');
    }

    //加拿大未发货订单
    public function notshippedCAN(){
        $data['status_id']=5;
        $data['country']='Canada';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','can');
        $this->display('notshipped');
    }

    //墨西哥未发货订单
    public function notshippedMEX(){
        $data['status_id']=5;
        $data['country']='Mexico';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','mex');
        $this->display('notshipped');
    }

    //已发货订单
    public function ordershipped(){
        $this->display();
    }

    //中国已发货订单
    public function shippedCHN(){
        $data['status_id']=6;
        $data['country']='China';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','chn');
        $this->display('ordershipped');
    }

    //美国已发货订单
    public function shippedUSA(){
        $data['status_id']=6;
        $data['country']='America';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','usa');
        $this->display('ordershipped');
    }

    //澳大利亚已发货订单
    public function shippedAUS(){
        $data['status_id']=6;
        $data['country']='Australia';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','aus');
        $this->display('ordershipped');
    }

    //加拿大已发货订单
    public function shippedCAN(){
        $data['status_id']=6;
        $data['country']='Canada';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','can');
        $this->display('ordershipped');
    }

    //墨西哥已发货订单
    public function shippedMEX(){
        $data['status_id']=6;
        $data['country']='Mexico';
        $pagen=$_POST['pagen'];
        if(empty($pagen)){
            $pagen=10;
        }
        $order=new Order_customerModel();
        $list=$order->orderstatus($data,$pagen);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('area','mex');
        $this->display('ordershipped');
    }

    //ajax获取pid
    public function getAjaxPid(){
        $pid=$_POST['pid'];
        $this->ajaxReturn($pid);
    }

}