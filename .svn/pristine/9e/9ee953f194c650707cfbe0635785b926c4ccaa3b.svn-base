<?php
	namespace app\admin\controller;
	use think\Session;
	use think\Controller;
	use think\Request;
	use think\Config;
	use app\admin\controller\Common;
	class Url extends Common{
		public function url_list(){
			$list=db('url')->order('id desc')->paginate(4);
			$page=$list->render();
			$num=db('url')->count();
			$this->assign('num',$num);
			$this->assign('page',$page);
			$this->assign('list',$list);
			return view();
		}
		public function url_add(){
		
			return view();
		}
		public function url_insert(){
            $list['name']=input('name');
            $list['url']=input('url');
            $list['addtime']=date('Y-m-d H:i:s',time());
			$num=db('url')->insert($list);
			return $num;
		}
		public function url_edit(){
			$id=input('id');
			$list=db('url')->where('id',$id)->find();
			$this->assign('list',$list);
			return view();
		}
		public function url_update(){
			$list=input("post.");
			$num=db('url')->where('id',$list['id'])->update($list);
			return $num;
			}
		public function url_del(){
			$id=input('id');
			$list=db('url')->where('id',$id)->find();
			$num=db('url')->where('id',$id)->delete();
			return $num;
		}

		// 批量删除
		
		public function deleteall(){
			$getid = input('id'); //获取选择的复选框的值
			// echo $getid;
			  if (!$getid)
	            $this->error('未选择记录'); //没选择就提示信息
		        $getids = explode(',', $getid); //选择一个以上，就用,把值连接起来(1,2,3)这样
		        $id = is_array($getid) ? $getids : $getid; 
		        //如果是数组，就把用,连接起来的值覆给$id,否则就覆获取到的没有,号连接起来的值
		     	//最后进行数据操作,
		     	if(!is_array($id)){
		     		 $Result = db("url")->delete($id);
		     	}else{
					foreach ($id as $v) {
					      $Result = db("url")->delete($id['$v']);
					  }
		     	}
			    $say = '删除成功';
		        if ($Result === false) {
		            $this->error('操作失败');
		        } else {
		            $this->success($say);
		        }
	    }	   
	}