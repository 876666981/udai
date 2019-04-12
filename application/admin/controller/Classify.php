<?php
	namespace app\admin\controller;
	use think\Session;
	use think\Controller;
	use think\Request;
	use think\Config;
	use app\admin\controller\Common;
	class Classify extends Common{
		public function classify_list(){
			$list=db('type')->field('id,name,pid,path,concat(path,pid) as npath')->order("path")->select();
			foreach($list as $k=>$v){
		    	$list[$k]['npath'] = str_repeat('|----', substr_count($v['npath'],','));
		    }
		    $num=db('type')->count();
			$this->assign('num',$num);
			$this->assign('list',$list);
			return view();
		}
		public function classify_add(){
			$id=input('id');
			$list=db('type')->where('id',$id)->find();
			$this->assign('list',$list);
			return view();
		}
		public function classify_adds(){
			return view();
		}
		public function classify_insert(){
			$list=input('post.');
			$list['path']='0,';
			$id=db('type')->insertGetId($list);
			$path=$list['path'].$id;
			$num=db('type')->where('id',$id)->update(['path'=>$path]);
			return $num;
		}
		public function classify_inserts(){
			$list=input('post.');
			$data=db('type')->where('id',$list['pid'])->find();
			$list['path']=$data['path'].',';
			$id=db('type')->insertGetId($list);
			$path=$list['path'].$id;
			$num=db('type')->where('id',$id)->update(['path'=>$path]);
			return $num;
		}
		public function classify_edit(){
			$id=input('id');
			$list=db('type')->where('id',$id)->find();
			$this->assign('list',$list);
			return view();
		}
		public function classify_update(){
			$list=input('post.');
			$num=db('type')->where('id',$list['id'])->update($list);
			return $num;
		}
		public function classify_del(){
			$id=input('id');
			$t=db('type')->field('count(*) as num')->where('pid',$id)->select();
			if ($t[0]['num']>0) {
				return 'zilei';
			}
			$tg=db('type,goods')->field('count(*) as num')->where("goods.typeid={$id}")->select();
			if ($tg[0]['num']>0) {
				return 'goods';
			}
			$num=db('type')->where('id',$id)->delete();
			return $num;
		}
	}