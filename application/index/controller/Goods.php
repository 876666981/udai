<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Config;
use think\Session;
class Goods extends Controller{
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
    public function item_category(){
        $list=db('type')->where('pid',0)->select();
        $id=input('id');
        Session::set('tpid',$id);
        $list2=db('type')->where('id',$id)->find();
        $list3=db('type')->where('pid',$list2['id'])->select();
        $at=array(); 
        foreach ($list3 as $k => $v) {
          $at[]=db('goods_attr')->field('goods_attr.*')->join('type',"goods_attr.type_id={$v['id']}")->select();  
        }
        $aws=array();
        foreach ($at as $key => $value) {
            foreach ($value as $k => $v) {
                $aws[]=$v;
            }
        }
        $ae=$this->super_unique($aws);

        $aq=array();
        foreach ($ae as $key => $value) {
            foreach ($value as $k => $v) {
                $aq[]=$value['attr'];
            }
        }
        $aw=array_unique($aq);
        $val=array();
        foreach ($ae as $key => $value) {
            $val[]=db('goods_value')->field('goods_value.*')->join('goods_attr',"goods_value.attr_id={$value['id']}")->select();
        }
        $vv=array();
        foreach ($val as $key => $value) {
            foreach ($value as $k => $v) {
                $vv[]=$v;
            }
        }
        
        $vv=$this->super_unique($vv);
        $vs=$this->array_unset_tt($vv,'value');
        $aa=array();
        foreach ($ae as $key => $value) {
            foreach ($vs as $k => $v) {
                if ($value['id']==$v['attr_id']) {
                    $aa[][$value['attr']]=$v;
                }
            }
        } 
        $shop=array();
        $shop2=array();
        $plist=array();
        // 产品列表页
        if (request()->isPost()) {
            $as=input('post.');
            $tp=db('type')->select();
            $tp1=array();
            foreach ($tp as $key => $value) {
               foreach ($value as $k => $v) {
                   $tp1[]=$v;
               }
            }
            $shop5=array();
            if (in_array($as['as'],$tp1)) {
                $tp2=db('type')->where('name',$as['as'])->select();
                foreach ($tp2 as $key => $value) {
                    $shop[]=db('goods')->where('typeid',"{$value['id']}")->select();
                }
                foreach ($shop as $key => $value) {
                    foreach ($value as $k => $v) {
                        $shop5[]=$v;
                    }
                }
            }
            $vp=db('goods_value')->select();
            $vp1=array();
            foreach ($vp as $key => $value) {
               foreach ($value as $k => $v) {
                   $vp1[]=$v;
               }
            }
            if (in_array($as['as'],$vp1)) {
                $vid=db('goods_value')->where('id',$as['id'])->find();
                $aid=db('goods_attr')->where('id',$vid['attr_id'])->find();

                $tpid=db('type')->where('id',$aid['type_id'])->find();
                $tpid2=db('type')->where('id',$tpid['pid'])->find();
                $tpid3=db('type')->where('pid',$tpid2['id'])->select();
                // var_dump($tpid3);die;
                $shop4=array();
                foreach ($tpid3 as $key => $value) {
                    $shop4[]=db('goods')->field('goods.*')->join('type',"goods.typeid={$value['id']}")->select();
                }
                $vp2=db('goods_value')->where('value',$as['as'])->select();
                foreach ($vp2 as $key => $value){
                    $shop3[]=db('goods')->where('id',"{$value['goods_id']}")->select();
                }
                foreach ($shop3 as $k => $v) {
                    foreach ($v as $key => $value) {
                       $shop2[]=$value;
                    }
                }
                foreach ($shop4 as $k => $v) {
                    foreach ($v as $key => $value) {
                       $shop[]=$value;
                    }
                }
                foreach ($shop as $key => $value) {
                    foreach ($shop2 as $k => $v) {
                        if ($value['typeid']==$v['typeid'] && $value['id']==$v['id']) {
                            $shop5[]=$value;
                        }
                    }
                }
                $shop5=$this->super_unique($shop5);
            }
            sort($shop5);
            $con=count($shop5);
            $shop6=json_encode($shop5);
            return $shop6;
        }else{
            foreach ($list3 as $key => $value) {
                $shop[]=db('goods')->where("typeid","{$value['id']}")->select();
            }
            foreach ($shop as $k => $v) {
                foreach ($v as $key => $value) {
                   $shop2[]=$value;
                }
            }
            $con=count($shop2);
        }
        //爆款推荐
        $hot=db('goods')->where('hot','yes')->where('state','1')->select();
        $this->assign('hot',$hot);
        $this->assign('shop2',$shop2);
        $this->assign('plist',$plist);
        $this->assign('list',$list);
        $this->assign('list3',$list3);
        $this->assign('aw',$aw);
        $this->assign('aa',$aa);
        return view();
    }
 

    public  function array_unset_tt($arr,$key){       
        //建立一个目标数组    
        $res = array();          
        foreach ($arr as $value) {             
           //查看有没有重复项    
           if(isset($res[$value[$key]])){    
              unset($value[$key]);  //有：销毁    
           }else{      
              $res[$value[$key]] = $value;    
           }      
        }    
        return $res;    
    }



    public function super_unique($array, $recursion = false){
    // 序列化数组元素,去除重复
        $result = array_map('unserialize', array_unique(array_map('serialize', $array))); 
       // 递归调用
        if ($recursion) {
            foreach ($result as $key => $value) {
                if (is_array($value)) {
                    $result[ $key ] = super_unique($value);
               }
            }
        }
        return $result;
    }


    public function item_show(){
        if (empty(Session::has('phone'))) {
            $this->assign('username','登录');
            $this->assign('zc','注册');
            $this->assign('tc','');
        }else{
            $this->assign('username','');
            $this->assign('zc','');
            $this->assign('tc','退出');
        }
        // 爆款推荐
         $hot=db('goods')->where('hot','yes')->where('state','1')->limit(0,6)->select();
         //详情
         $id=input('id');
         // 商品表
         $all=db('goods')->where('id',$id)->find();
         $pic=$all['img'];
         $img=explode(",",$pic);
         // var_dump($img);
         // 属性和属性值
           $color=db('goods_attr')->where('goods_id',$all['id'])->select();
         
        $val=array();
         foreach ($color as $key => $value) {
            $val[]=db("goods_value")->field('goods_value.*')->join('goods_attr',"goods_value.attr_id={$value['id']}")->select();
         }
         $colors=$this->array_unset_tt($color,'attr');
         // var_dump($colors);
         $vel=array();
         foreach ($val as $k => $v) {
             foreach ($v as $key => $vl) {
                $vel[]=$vl;
             }
         }
         $vel=$this->array_unset_tt($vel,'value');
         $aa=array();
         foreach ($color as $key => $value) {
            foreach ($vel as $k => $v) {
                if ($value['id']==$v['attr_id']) {
                    $aa[][$value['attr']]=$v;
                }
            }
        }
         $comment=db('evaluate')->count();
        
        $this->assign('aa',$aa);
         $color=db('goods_attr')->where('goods_id',$all['id'])->select();
         
        $val=array();
         foreach ($color as $key => $value) {
            $val[]=db("goods_value")->field('goods_value.*')->join('goods_attr',"goods_value.attr_id={$value['id']}")->select();
         }
         $colors=$this->array_unset_tt($color,'attr');
         $vel=array();
         foreach ($val as $k => $v) {
             foreach ($v as $key => $vl) {
                $vel[]=$vl;
             }
         }
         $vel=$this->array_unset_tt($vel,'value');
         $aa=array();
         foreach ($color as $key => $value) {
            foreach ($vel as $k => $v) {
                if ($value['id']==$v['attr_id']) {
                    $aa[][$value['attr']]=$v;
                }
            }
        }
        //评论
        $pl=db('evaluate')->where('goodsid',$id)->select();
        // var_dump($pl);die;
        $num=count($pl);
        $us=db('user')->select();
        // var_dump($pl);
        $this->assign('pl',$pl);
        $this->assign('num',$num);
        $this->assign('us',$us);
        $this->assign('aa',$aa);
        $this->assign('pic',$pic);
        $this->assign('img',$img);
        $this->assign('colors',$colors);
        $this->assign('all',$all);
        $this->assign('hot',$hot);
        return view();
    }
    public function car_insert(){
      // var_dump($_POST);die;
            $sid=$_POST['sid']; 
                 $data = array(
                'carval'=>$_POST['carval'],  
                'carnum'=>$_POST['carnum'],    
                'pid'=>$_POST['pid'],
                'price'=>$_POST['price'],
                'goodsname'=>$_POST['goodsname'],
                'sid'=>$_POST['sid'],
                'carimg'=>$_POST['carimg'],
                'stock'=>$_POST['stock']
                );
               $un=strlen($data['carval']);
                $goodcar=db('car_insert')->where('carnum',$data['carnum'])->where('sid',$sid)->find();
                $num=$data['carnum']+$goodcar['carnum'];
                 if(!empty($_POST['carval'])&&($goodcar['sid']==$data['sid'])&&($goodcar['carval']==$data['carval'])) {
                    $s=db('car_insert')->where('sid',$data['sid'])->where('carval',$data['carval'])->setField('carnum',$num);
                    return $s;
                 }elseif (!empty($_POST['pid'])&&strlen($data['carval'])>=52) {
                $m=db('car_insert')->insert($data);
                return $m;
             }
        }
    public function sc_insert(){
         $data = array(    
                'pid'=>$_POST['pid'],
                'price'=>$_POST['price'],
                'goodsname'=>$_POST['goodsname'],
                'sid'=>$_POST['sid'],
                'carimg'=>$_POST['carimg'],
                );
         $id=Session::get('id');
        $controller=db('Collection')->where('pid',$id)->where('sid',$data['sid'])->find();
         if (!empty($_POST['pid'])&&empty($controller)) {
              $m=db('Collection')->insert($data);
              return $m;
         }
    }
    public function pur_chase(){
            $data = array(
                'pid'=>$_POST['pid'],
                'sid'=>$_POST['sid'],
                'carval'=>$_POST['carval'],  
                'carnum'=>$_POST['carnum'],    
                'price'=>$_POST['price'],
                'goodsname'=>$_POST['goodsname'],
                'carimg'=>$_POST['carimg'],
                'stock'=>$_POST['stock']
                );
            $id=Session::get('id');
            $info=db('Purchase')->where('pid',$id)->select();
            if (!empty($info)) {
                db('Purchase')->where('pid',$id)->delete();
            }
            if (!empty($id)&&strlen($data['carval'])>=52) {
                 $m=db('Purchase')->insert($data);
                 return $m;
            }
    }
     public function shopcar(){

        return view();
    }
      public function item_sale_page(){
        $gets=input('get.');
        // var_dump($gets);
        $goods_name=input("get.goods_name");
        $pageds=['query'=>[]];
        $where=array();
        $where['goods_name']=array('like',"%{$goods_name}%");
        $this->assign('goods_name',$goods_name);
        $pageds['query']['goods_name']=$goods_name;
           
        // var_dump($price);
        $pageds['query']['goods_name']=$goods_name;
        $goods=db("goods")->where($where)->paginate(4,"",$pageds);
             // var_dump($goods); 
        $page = $goods->render();  
        $this->assign('goods',$goods);
        $this->assign('page',$page);
        $this->assign('goods_name',$goods_name);
        return view();
    }
}
