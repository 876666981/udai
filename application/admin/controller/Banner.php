<?php
	namespace app\admin\controller;
	use think\Session;
	use think\Controller;
	use think\Request;
	use think\Config;
	use app\admin\controller\Common;
	class Banner extends Common{
		public function banner_list(){
			$list=db('banner')->order('id desc')->paginate(4);
			$page=$list->render();
			$num=db('banner')->count();
			$this->assign('num',$num);
			$this->assign('page',$page);
			$this->assign('list',$list);
			return view();
		}
		public function banner_add(){
			return view();
		}
		public function banner_insert(){
			$list=input('post.');
			$list['addtime']=time();
			$list['state']=1;
			$num=db('banner')->insert($list);
			return $num;
		}
		public function banner_edit(){
			$id=input('id');
			$list=db('banner')->where('id',$id)->find();
			$this->assign('list',$list);
			return view();
		}
		public function banner_update(){
			$list=input('post.');
			$img=db('banner')->where('id',$list['id'])->find();
			$picname=$img['imgname'];
			if ($list['imgname']!=$picname) {
				$list['imgname']=substr($list['imgname'], 9);
				$num=db('banner')->where('id',$list['id'])->update($list);
				if ($num>0) {
					if (file_exists("uploads/{$picname}")) {
						unlink("uploads/{$picname}");
					}
					return $num;
				}
			}else{
				$list['imgname']=$picname;
				$num=db('banner')->where('id',$list['id'])->update($list);
				return $num;
			}
		}
		public function banner_state(){
			$id=input('id');
			$list=db('banner')->where('id',$id)->find();
			if ($list['state']=='1') {
				$num=db('banner')->where('id',$id)->update(['state'=>2]);
				return  $num;
			}else{
				$num=db('banner')->where('id',$id)->update(['state'=>1]);
				return  $num;
			}
		}
		public function banner_del(){
			$id=input('id');
			$list=db('banner')->where('id',$id)->find();
			$picname=$list['imgname'];
			$num=db('banner')->where('id',$id)->delete();
			if (file_exists("uploads/{$picname}")) {
				unlink("uploads/{$picname}");	
			}
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
		     		 $Result = db("banner")->delete($id);
		     	}else{
					foreach ($id as $v) {
					      $Result = db("banner")->delete($id['$v']);
					  }
		     	}
			    $say = '删除成功';
		        if ($Result === false) {
		            $this->error('操作失败');
		        } else {
		            $this->success($say);
		        }
		    
	        
	    }	   
		public function banner_uploads(){
			$file =request()->file('pic');
			// 移动到框架应用根目录/public/uploads/bigpic 目录下
			$info = $file->move(ROOT_PATH . 'public' . DS .'uploads');
			if($info){

		       	return $info->getSaveName(); 
			}else{
		       	// 上传失败获取错误信息
		       	return  $file->getError();
			}
		}
	}