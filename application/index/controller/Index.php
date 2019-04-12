<?php
    namespace app\index\controller;
    use think\Controller;
    use think\Request;
    use think\Config;
    use think\Session;

class Index extends Controller

{
     protected $beforeActionList = [
        'first'
    ];
    public function first(){
         if (empty(Session::has('phone'))) {
            $this->assign('username','登录');
            $this->assign('zc','注册');
            $this->assign('tc','');
        }else{
            $this->assign('username','');
            $this->assign('zc','');
            $this->assign('tc','退出');
        }
        //链接
        $url=db('url')->select();
        $this->assign('url',$url);
    }
    public function index()
    {   
          //搜索
        $gets=input("get.");
        $goods_name=input("get.goods_name");
        $this->assign("goods_name", $goods_name);   
        //爆款
        $hoot=db('type')->where('pid=0 ')->order('id asc')->select();
        $list=db('goods,type')->field("goods.*,type.name")->where("goods.typeid=type.id")->where("hot","yes")->where('goods_name','like','%'.$goods_name.'%')->where("state","1")->order('id desc')->limit(0,8)->select();
        //女装:1楼
        // 类别
       $app=db('type')->field('id,name,pid,path')->where("pid=0")->where("path","0,1")->find();
       // var_dump($app);die;
       $aps=db("type")->field('id,name,pid,path')->where("pid",$app['id'])->select();
       //商品
        $shop=db('goods,type')->field("goods.*,type.name")->where("goods.typeid=type.id")->where("floor","1")->where('goods_name','like','%'.$goods_name.'%')->where("state","1")->order('id desc')->limit(0,8)->select();

        //男装:2楼
        // 类别
        $sps=db('type')->field('id,name,pid,path')->where("pid=0")->where("path","0,2")->find();
        $das=db("type")->field('id,name,pid,path')->where("pid",$sps['id'])->select();
        //商品
        $hop=db('goods,type')->field("goods.*,type.name")->where("goods.typeid=type.id")->where("floor","2")->where('goods_name','like','%'.$goods_name.'%')->where("state","1")->order('id desc')->limit(0,8)->select();

         //童装:3楼
        // 类别
        $hps=db('type')->field('id,name,pid,path')->where("pid=0")->where("path","0,3")->find();
        $kas=db("type")->field('id,name,pid,path')->where("pid",$hps['id'])->  select();
         //商品
        $nop=db('goods,type')->field("goods.*,type.name")->where("goods.typeid=type.id")->where("floor","3")->where('goods_name','like','%'.$goods_name.'%')->where("state","1")->order('id desc')->limit(0,8)->select();
        
        //包包:4楼
        // 类别
        $px=db('type')->field('id,name,pid,path')->where("pid=0")->where("path","0,5")->find();
        $kms=db("type")->field('id,name,pid,path')->where("pid",$px['id'])->select();
        $nsp=db('goods,type')->field("goods.*,type.name")->where("goods.typeid=type.id")->where('goods_name','like','%'.$goods_name.'%')->where("floor","4")->where("state","1")->order('id desc')->limit(0,8)->select();

         //鞋:5楼
        // 类别
        $dok=db("type")->field('id,name,pid,path')->where("pid=0")->where("path","0,4")->find();
        $haps=db("type")->field('id,name,pid,path')->where("pid",$dok['id'])->select();
        $esp=db('goods,type')->field("goods.*,type.name")->where("goods.typeid=type.id")->where('goods_name','like','%'.$goods_name.'%')->where("floor","5")->where("state","1")->order('id desc')->limit(0,8)->select();
        //1
        $this->assign("app", $app);
        $this->assign("aps", $aps);
        $this->assign("shop",$shop);
        //2
        $this->assign("sps", $sps);
        $this->assign("das", $das);
        $this->assign("hop",$hop);
        //3
        $this->assign("hps", $hps);
        $this->assign("kas", $kas);
        $this->assign("nop", $nop);
        //4
        $this->assign("px", $px);
        $this->assign("kms", $kms);
        $this->assign("nsp", $nsp);
        //5
        $this->assign("dok", $dok);
        $this->assign("haps", $haps);
        $this->assign("esp", $esp);

        $this->assign("hoot", $hoot); 
        $this->assign("list", $list);
        if (empty(Session::has('phone'))) {
            $this->assign('username','登录');
            $this->assign('zc','注册');
            $this->assign('tc','');
            $this->assign('dcdl','点此登录');
            $this->assign('fxgd','，发现更多精彩');
            $this->assign('nhao','你好');
            $this->assign('jf','');
        }else{
            $this->assign('username','');
            $this->assign('zc','');
            $this->assign('tc','退出');
            $this->assign('dcdl','');
            $this->assign('fxgd','');
            $this->assign('nhao','');
            $this->assign('jf','积分');
        }
        //轮播图
    	$ban=db('banner')->limit(0,5)->select();
    	$this->assign('ban',$ban);

        //分类
        $plist=db('type')->where('pid',0)->select();
        $plist2=array();
        $plist3=array();
        foreach ($plist as $k => $v) {
            $plist[$k]['child']=array();
            $plist2=db('type')->where('pid',$v['id'])->select();
            foreach ($plist2 as $key => $value) {
                array_push($plist[$k]['child'],$plist2);
                $plist[$k]['child'][$key]['child2']=array(); 
                $plist3=db('type')->where('pid',$value['id'])->select();
                foreach ($plist3 as $v2) {
                     array_push($plist[$k]['child'][$key]['child2'],$v2);
                }            
            }
        }
        if (!empty(Session::has('phone'))) {
            $id=Session::get('id');
            $user=db('user')->where("id",$id)->find();
            $this->assign("user",$user);
        }else{
            $this->assign("user",123);
        }
        $this->assign('plist',$plist);  
        return view();

    }
    public function emptysession(){
        Session::delete('phone');
        Session::delete('id');
        $this->redirect('index/index/index');
    }
    public function login(){
    	return view();
    }
    public function do_udlogin(){
            if (Request::instance()->isPost()) { //判断是否为 POST 请求  
            $data = input('post.');
            $phone = $data['phone'];  
            $password = md5($data['password']);
            //查询数据试库  
            $where['phone'] = $phone;
            $userInfo = db('user')->where($where)->find();
            // var_dump($userInfo);
            if ($userInfo['state']=='2') {
                return "NO";
            }elseif ($userInfo && $userInfo['password'] == $password) {
                // 登录成功写入session
                Session::set('phone', $userInfo['phone']);
                Session::set('id',$userInfo['id']);
                return 'OK';
            }
        }
    }
    public function register(){
    	return view();
    }
     public function do_register(){
        if (Request::instance()->isPost()) {
            $list = input('post.');
            $smscode = $list['smscode'];
            $phone = $list['phone'];
            $where['phone'] = $phone;
            $userInfo = db('user')->where($where)->find();
            if ($userInfo['phone'] == $phone) {
                return "sj";
            }elseif ($smscode==Session::get('param')){
                $data = [       //接受传递的参数  
                    'phone' => input('phone'),  
                    'password' => md5(input('password')),
                    'time' => time(),
                ];
                $info = db('user')->insert($data);
                return "OK";
            }
        }
    }
  public function sendCode(){
        $tel=input('tel');
        $param = str_pad(mt_rand(0, 999999), 6, "0", STR_PAD_BOTH);
        Session::set('param',$param);
        // echo $tel;
        $host = "https://feginesms.market.alicloudapi.com";
        $path = "/codeNotice";
        $method = "GET";
        $appcode = "a838c392599b4cea868845ae8eb7f13e";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "param={$param}&phone={$tel}&sign=1&skin=1";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        // var_dump(curl_exec($curl));
        $json=curl_exec($curl);
        $info=json_decode($json,true);
        // var_dump($info['Code']);die;
        // // var_dump($param);die;
        // if ($info['Code']=='OK') {
        return 1;
    }
    public function resetpwd(){
    	return view();
    }
   public function do_resetpwd(){
        if (Request::instance()->isPost()) {
            $list = input('post.');
            $smscode = $list['smscode'];
            $phone = $list['phone'];
            $where['phone'] = $phone;
            $userInfo = db('user')->where($where)->find();
            if (($userInfo['phone'] !== $phone)) {
                return "NO";
            }elseif (($userInfo['phone'] == $phone) && ($smscode==Session::get('param'))) {
                $data = [       //接受传递的参数  
                    'password' => md5(input('password')),
                ];
                $info = db('user')->where($where)->update($data);
                return "OK";
            }
        }
    }
    public function agent_level(){
    	return view();
    }
    public function udai_welcome(){
    if (empty(Session::has('phone'))) {
            $this->assign('tc','');
            $this->redirect('index/index/login');   //重定向
        }else{
            $this->assign('tc','退出');
        }
        $id=Session::get('id');
        $user=db('user')->where("id",$id)->find();
        $order=db('order')->where('uid',$id)->where('strike',0)->paginate(2);
        $page=$order->render();
        $arr=array();
        foreach ($order as $key => $value) {
            $arr[]=db('detail')->where('orderid',$value['id'])->select();
        }
        $as=array();
        foreach ($arr as $key => $value) {
            foreach ($value as $k => $v) {
                $as[]=$v;
            }
        }
        $list=db('goods')->where('hot','yes')->select();
        $this->assign('list',$list);
        $this->assign('order',$order);
        $this->assign('page',$page);
        $this->assign('as',$as);
        $this->assign("user",$user);
    	return view();
    }
     public function udai_integral(){
    	return view();
    }
     public function udai_shopcart(){
        $id=Session::get('id');
        $goodcar=db('car_insert')->where('pid',$id)->select();
        $goodscar=count($goodcar);
        Session::set('carcount',$goodscar);
        $this->assign('goodcar',$goodcar);
    	return view();
    }
     public function carsdel(){
        $getid = input('id'); //获取选择的复选框的值
        if (!$getid)
            $this->error('未选择记录'); //没选择就提示信息
            $getids = explode(',', $getid); //选择一个以上，就用,把值连接起来(1,2,3)这样
            $id = is_array($getid) ? $getids : $getid; 
            //如果是数组，就把用,连接起来的值覆给$id,否则就覆获取到的没有,号连接起来的值
            //最后进行数据操作,
            if(!is_array($id)){
                 $Result = db("car_insert")->delete($id);
            }else{
                foreach ($id as $v) {
                      $Result = db("car_insert")->delete($id['$v']);
                  }
            }
            if ($Result === false) {
                $this->error('操作失败');
            } else {
                $this->redirect("index/index/udai_shopcart");
            }
    }

    public function num_add(){
        $id=input('id');
        $info=db('car_insert')->where('id',$id)->select();
        $goods=db('goods')->where('id',$info[0]['sid'])->select();
        $fei=$info[0]['carnum'];
        if ($fei<$goods[0]['stock']) {
             $num=$fei+1;
        }
        $num=$fei+1;
        $m=db('car_insert')->where('id',$id)->update(['carnum'=>$num]);
    }
    public function num_sup(){
         $id=input('id');
        $info=db('car_insert')->where('id',$id)->select();
        $fei=$info[0]['carnum'];
        if ($fei>1) {
            $num=$fei-1;
        }
        $m=db('car_insert')->where('id',$id)->update(['carnum'=>$num]);
    }
    public function car_del(){
            $id=input('id');
            $m=db('car_insert')->delete($id);
            return $m;
    }
     public function class_room(){
    	return view();
    }
     public function enterprise_id(){
    	return view();
    }
     public function udai_contract(){
    	return view();
    }
     public function item_remove(){
    	return view();
    }
     public function udai_about(){
    	return view();
    }
    public function orderinfo(){
        $phone=Session::get('phone');
        $list=db('user')->where('phone',$phone)->find();
        $address=db("address")->where('pid',$list['id'])->select();
        $car=db('car_insert')->where('pid',$list['id'])->where('checked',1)->select();
        $total=0;
        foreach ($car as $key => $value) {
           $total+=($value['carnum']*$value['price']);
        }
        $time=date("Y年m月d日 H:i:s",time());
        $this->assign('time',$time);
        $this->assign('total',$total);
        $this->assign('list',$list);
        $this->assign('address',$address);
        $this->assign('car',$car);
        return view();
    }
    public function orderinsert(){
        $list=input('post.');
        $address=db("address")->where('id',$list['address'])->find();
        $carinsert=db('car_insert')->where('pid',$address['pid'])->where('checked',1)->select();
        $orderhao=time().rand(1000,9999);
        $add=$address['location'].'/'.$address['detailed'];
        $time=time();
        $arr=array(
            "uid"=>$address['pid'],
            "orderhao"=>$orderhao,
            "linkman"=>$address['name'],
            "address"=>$add,
            "phone"=>$address['phone'],
            "total"=>$list['total'],
            "payment"=>$list['payment'],
            "createtime"=>$time,
            "state"=>0,
            "strike"=>0
        );
        $orderid=db("order")->insertGetId($arr);
        // var_dump($orderid);
        foreach ($carinsert as $key => $value) {
           $detail=db('detail')->insert(['orderid'=>$orderid,'goodsid'=>$value['sid'],'goods_name'=>$value['goodsname'],'attr'=>$value['carval'],'price'=>$value['price'],'num'=>$value['carnum'],'img'=>$value['carimg']]);
           // var_dump($detail);
           $goodsid=db('goods')->where('id',$value['sid'])->find();
           $sk=$goodsid['stock']-$value['carnum'];
           $strok=db('goods')->where('id',$value['sid'])->update(['stock'=>$sk]);
           // var_dump($strok);
           $m=db("car_insert")->delete($value['id']);
           // var_dump($m);
        }
        return $orderid;
    }
    public function dochecked(){
        $id=input('id');
        $m=db('car_insert')->where('id',$id)->update(['checked'=>1]);
        return $m;
    }
    public function docheckeds(){
        $id=input('id');
            $m=db('car_insert')->where('id',$id)->update(['checked'=>0]);
        return $m;
    }
    public function docheckedss(){
        $m=db('car_insert')->where('id','>',0)->update(['checked'=>0]);
        return $m;
    }
    public function cashier(){
        $id=input('id');
        $list=db('order')->where('id',$id)->find();
        $deta=db('detail')->where('orderid',$id)->select();
        $this->assign('list',$list);
        $this->assign('deta',$deta);
        return view();
    }
    public function pay(){
        $id=input('id');
        $list=db("order")->where('id',$id)->find();
        $m=db('order')->where('id',$id)->update(['state'=>1]);
        $this->assign('list',$list);
        return view();
    }


     public function orderinfo1(){
        $phone=Session::get('phone');
        $goodname=$_POST['goodname'];
        $goodid=$_POST['sid'];
        $carimg=$_POST['carimg'];
        $daijia=$_POST['daijia'];
        $attribute=$_POST['attribute'];
        $carnum=$_POST['carnum'];
        $list=db('user')->where('phone',$phone)->find();
        $address=db("address")->where('pid',$list['id'])->select();
        // var_dump($address);
        $time=date("Y年m月d日 H:i:s",time());
        $this->assign('time',$time);
        $this->assign('list',$list);
        $this->assign('address',$address);
        $this->assign('goodname',$goodname);
        $this->assign('carimg',$carimg);
        $this->assign('daijia',$daijia);
        $this->assign('attribute',$attribute);
        $this->assign('carnum',$carnum);
        $this->assign('goodid',$goodid);
        return view();
    }
    public function orderinsert1(){
        $list=input('post.');
        $address=db("address")->where('id',$list['address'])->find();
        $orderhao=time().rand(1000,9999);
        $time=time();
        $arr=array(
            "uid"=>$address['pid'],
            "orderhao"=>$orderhao,
            "linkman"=>$address['name'],
            "address"=>$address['location'],
            "detailed"=>$address['detailed'],
            "phone"=>$address['phone'],
            "total"=>$list['total'],
            "payment"=>$list['payment'],
            "createtime"=>$time,
            "state"=>0,
            "strike"=>0
        );
        $orderid=db("order")->insertGetId($arr);
        $detail=db('detail')->insert(['orderid'=>$orderid,'goodsid'=>$list['goodid'],'goods_name'=>$list['goodname'],'attr'=>$list['attribute'],'price'=>$list['daijia'],'num'=>$list['carnum'],'img'=>$list['img']]);
        $goodsid=db('goods')->where('id',$list['goodid'])->find();
        $sk=$goodsid['stock']-$list['carnum'];
        $strok=db('goods')->where('id',$list['goodid'])->update(['stock'=>$sk]);
        return $orderid;
    }
}
