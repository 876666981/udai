<?php
	namespace app\admin\controller;
	use think\Session;
	use think\Controller;
	use think\Request;
	use think\Config;
	use app\admin\controller\Common;
	class Order extends Common{
		public function order_list(){
			$list=db('order')->where('strike',0)->order('id desc')->paginate(4);
			$page=$list->render();
			$num=db('order')->where('strike',0)->order('id desc')->count();
			$this->assign('num',$num);
			$this->assign('page',$page);
        	$this->assign('list',$list);  
        	return $this->fetch();
		}
		public function order_show(){
			$id=input('id');
			$list=db('order')->where('id',$id)->find();
			$dt=db('detail')->where("orderid",$id)->select();
			foreach($dt as $v){
			}
			$this->assign('list',$list); 
			$this->assign('v',$v); 

			return view();
		}
		public function order_fahuo(){
			$id=input('id');
			$m=db('order')->where('id',$id)->update(['state'=>2]);
			return $m;
		}
	}