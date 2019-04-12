<?php
	namespace app\admin\controller;
	use think\Session;
	use think\Controller;
	use think\Request;
	use think\Config;
	use app\admin\controller\Common;
	class Comment extends Common{
		public function comment_list(){
			$list=db('evaluate')->order('id desc')->paginate(4);
			$page=$list->render();
			$num=db('evaluate')->count();
			$this->assign('num',$num);
			$this->assign('page',$page);
			$this->assign('list',$list);
			return view();
		}
		public function comment_edit(){
			$id=input('id');
			$list=db('evaluate')->where('id',$id)->find();
			$goods=db('goods')->where('id',$list['goodsid'])->find();
			$goodsname=$goods['goods_name'];
			$user=db('user')->where('id',$list['userid'])->find();
			$username=$user['phone'];
			$this->assign('goodsname',$goodsname);
			$this->assign('username',$username);
			$this->assign('list',$list);
			return view();
		}
		public function comment_update(){
			$list=input('post.');
			$m=db('evaluate')->where('id',$list['id'])->update(['restore'=>$list['restore']]);
			return $m;
		}
		
	}
