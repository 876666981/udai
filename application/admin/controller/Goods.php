<?php
	namespace app\admin\controller;
	use think\Session;
	use think\Controller;
	use think\Request;
	use think\Config;
	use app\admin\controller\Common;
	class Goods extends Common{
		public function goods_list(){
			$list=input('get.');
			$name=input('goods_name');
			$goods_name=input('get.goods_name');			
			$pageParam=['query'=>[]];
			$where=array();
			if ($goods_name) {
				$where['goods_name']=array('like',"%{$goods_name}%");
				$this->assign('goods_name',$goods_name);
				$pageParam['query']['goods_name']=$goods_name;
			}
				$list=db('goods')->where($where)->field('goods.*,type.name')->join('type','goods.typeid=type.id','left')->order('id desc')->paginate(4,"",$pageParam);
			// }
			$page=$list->render();
			
			$num=db('goods')->count();
			$this->assign('num',$num);
			$this->assign('page',$page);
        	$this->assign('list',$list);  
        	return $this->fetch();	
		}
		public function goods_add(){
			$list=db('type')->field('id,name,pid,path,concat(path,pid) as npath')->order("path")->select();
			
			foreach($list as $k=>$v){
		    	$list[$k]['npath'] = str_repeat('|--', substr_count($v['npath'],','));
		    	$num[]=db('type')->field('count(*) as num')->where('pid',$v['id'])->select();

		    }  
		   $a=array();
		   foreach ($num as $k =>$v) {
			  foreach ($v as $key => $value) {
			  		$a[$k]=$value;
			  }
		   }
		   $this->assign('a',$a);
		    $this->assign('list',$list);
			return view();
		}

		public function goods_insert(){
			$list=input('post.');
			$list['addtime']=time();
			$list['number']=substr(time(),0,8);
			$num=db('goods')->insert($list);
			return $num;
		}
		
		public function goods_edit(){
			$list=db('type')->field('id,name,pid,path,concat(path,pid) as npath')->order("path")->select();
			foreach($list as $k=>$v){
		    	$list[$k]['npath'] = str_repeat('|--', substr_count($v['npath'],','));
		    	$num[]=db('type')->field('count(*) as num')->where('pid',$v['id'])->select();

		    }  
		   $a=array();
		   foreach ($num as $k =>$v) {
			  foreach ($v as $key => $value) {
			  		$a[$k]=$value;
			  }
		   }
		   $this->assign('a',$a);
		   $this->assign('list',$list);
			$id=input('id');
			$arr=db('goods')->where('id',$id)->find();
			$img=array();
			$pic=array();
			$img=explode(",",$arr['img']);
			foreach ($img as $key => $value) {
				if (strlen($value)>40) {
					$pic[]=$value;
				}
			}
			$this->assign('pic',$pic);
        	$this->assign('arr',$arr);  
        	return $this->fetch();	
		}
		public function goods_update(){
			$list=input('post.');
			$arr=db('goods')->where('id',$list['id'])->find();
			if ($list['img']!=$arr['img']) {
				$num=db('goods')->where('id',$list['id'])->update($list);
				if ($num>0) {
					$img=explode(",",$arr['img']);
					foreach ($img as  $v) {
						if (file_exists("uploads/$v")) {
							unlink("uploads/$v");
						}
					}
					return $num;
				}
			 }else{
				$list['img']=$arr['img'];
				$num=db('goods')->where('id',$list['id'])->update($list);
				return $num;
			}
		}
		public function goods_del(){
			$id=input('id');
			$list=db('goods')->where('id',$id)->find();
			$attr=db('goods_attr')->where('type_id',$list['typeid'])->select();
			$val=db('goods_value')->where('goods_id',$list['id'])->select();
			$img=db('goods_img')->where('goods_id',$list['id'])->select();
			$num=db('goods')->where('id',$id)->delete();
			if ($num>0) {
				foreach ($attr as $key => $value) {
					$attr=db('goods_attr')->where('type_id',$value['type_id'])->delete();
				}
				foreach ($val as $key => $value) {
					$val=db('goods_value')->where('goods_id',$value['goods_id'])->delete();
				}
				foreach ($img as $key => $value) {

					$pic=explode(",",$value['pic']);
					$val=db('goods_img')->where('goods_id',$value['goods_id'])->delete();
					foreach ($pic as $k => $v) {
						if (file_exists("uploads/$v")) {
							unlink("uploads/$v");
						}
					}
				}
				$img=explode(",",$list['img']);
				foreach ($img as $k => $v) {
					if (file_exists("uploads/$v")) {
						unlink("uploads/$v");
					}
				}
				return $num;
			}
		}


		public function goods_show(){
		    $id=input("id");
			$list=db("goods")->field('goods.*,type.name')->join("type","goods.typeid=type.id")->where("goods.id= $id")->find();
			$arr=$list['img'];		
			$img=explode(",",$arr);
			$td=db("goods_img")->where("goods_id={$id}")->find();
			$tds=$td['pic'];
			$imgs=explode(",",$tds);
			$color=db("goods_attr")->where("goods_id",$id)->select();
			$vs=array();
			foreach ($color as $k => $v) {
				$vs[]=db("goods_value")->field('goods_value.*')->join("goods_attr","goods_value.attr_id={$v['id']}")->select();
			}
			$ata=$this->array_unset_tt($color,"attr");
			// var_dump($ata);
			$ku=array();
			foreach ($vs as $k1 => $v1) {
				foreach ($v1 as $k2 => $v2) {
					$ku[]=$v2;
				}
				
			}
			$ku=$this->array_unset_tt($ku,"value");
			$ad=array();
			foreach ($color as $k => $v) {
				foreach ($ku as $k1 => $v1) {
					if($v['id'] == $v1['attr_id']){
						$ad[][$v['attr']]=$v1;
					}
				}
			}
			$this->assign("ad",$ad);
			$this->assign("img",$img);
			$this->assign("imgs",$imgs);
			$this->assign("ata",$ata);
			$this->assign("list",$list);
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
   
		public function goods_uploads(){
			$files = request()->file('pic');
			$imgname=array();
			foreach($files as $file){
			    // 移动到框架应用根目录/public/uploads/ 目录下
			    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			    if($info){
			        $imgname[]=$info->getSaveName();
			     }else{
			         // 上传失败获取错误信息
			       return $file->getError();
			     }    
			}
			return $imgname;
		}
		public function goods_attr_add(){
			$id=input('id');
			$this->assign('id',$id);
			return view();
		}
		public function goods_attr_insert(){
			$list=input('post.');
			$arr=db('goods')->where('id',$list['id'])->find();
			$id=db('goods_attr')->insertGetId(['attr'=>$list['attr'],'type_id'=>$arr['typeid'],'goods_id'=>$arr['id']]);
			$num2=db('goods_value')->insert(['value'=>$list['val'],'attr_id'=>$id,'goods_id'=>$list['id']]);
			$num3=db('goods_img')->insert(['pic'=>$list['img'],'goods_id'=>$list['id']]);
			if ($id>0 && $num2>0 && $num3>0) {
				return 1;
			}else{
				return 0;
			}
		}


		public function goods_state(){
			$id=input('id');
			$list=db('goods')->where('id',$id)->find();
			if($list['state'] == '1'){
				$num=db('goods')->where('id',$id)->update(['state' => '2']);
				return  $num;
			}else{
				$num=db('goods')->where('id',$id)->update(['state' => '1']);
				return  $num;
			}
		}
	}