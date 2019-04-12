<?php
	namespace app\admin\controller;
	use think\Session;
	use think\Controller;
	use think\Request;
	use think\Config;
	use app\admin\controller\Common;
	use think\Validate;
	use app\admin\validate\User;
	class  Admin extends Common{
		public function admin_list(){
			$arr=input('get.');
			$sex=input('get.sex');
			$admin_name=input('get.admin_name');
			$pageParam=['query'=>[]];
			$where=array();
			if ($sex) {
				$where['sex']=array('like',"%{$sex}%");
				$this->assign('sex',$sex);
				$pageParam['query']['sex']=$sex;
			}
			if ($admin_name) {
				$where['admin_name']=array('like',"%{$admin_name}%");
				$this->assign('admin_name',$admin_name);
				$pageParam['query']['admin_name']=$admin_name;
			}

			$list=db('admin')->where($where)->join('auth_group_access','auth_group_access.uid=admin.id','left')->order('id desc')->paginate(3,"",$pageParam);
			$arr=db('auth_group')->select();
		    $totol =db('admin')->count('id');
		    $page=$list->render();
		    $this->assign('arr',$arr);
		    $this->assign('page',$page);
			$this->assign("list", $list);
			$this->assign("totol", $totol);
			return view();
			
		}
		public function admin_add(){
			$list=db('auth_group')->select();
			$this->assign('list',$list);
			return view();

		}
		public function admin_show(){
			$id=input('id');
      		$list=db('admin')->find($id);
         	$this->assign("list",$list);
			return view();

	 	}
		public function admin_edit(){
			$id=input('id');
      		$list=db('admin')->find($id);
         	$this->assign("list",$list);
         	$arr=db('auth_group')->select();
			$this->assign('arr',$arr);
			return view();
		}
		public function admin_del(){
			$id=input('id');
	        $m=db('admin')->delete($id);
	        return $m;
		}
		public function deleteall(){
			$getid = input('id'); //获取选择的复选框的值
	        if (!$getid)
	            $this->error('未选择记录'); //没选择就提示信息
		        $getids = explode(',', $getid); //选择一个以上，就用,把值连接起来(1,2,3)这样
		        $id = is_array($getid) ? $getids : $getid; 
		        //如果是数组，就把用,连接起来的值覆给$id,否则就覆获取到的没有,号连接起来的值
		     	//最后进行数据操作,
		     	if(!is_array($id)){
		     		 $Result = db("admin")->delete($id);
		     	}else{
					foreach ($id as $v) {
					      $Result = db("admin")->delete($id['$v']);
					  }
		     	}
			    $say = '删除成功';
		        if ($Result === false) {
		            $this->error('操作失败');
		        } else {
		            $this->success($say);
		        }
		    
	    }	        	  
		public function admin_rule(){
			$list=db('auth_rule')->field("*,concat(name) as name")->order('name')->select();
			$num=db('auth_rule')->count();
			foreach($list as $k=>$v){
				if ($list[$k]['level']!=0) {
					$list[$k]['title'] = str_repeat('|--',$list[$k]['level']).$list[$k]['title'];
				}
		    }
			$this->assign('num',$num);
			$this->assign('list',$list);
			return view();
		}
		public function rule_add(){
			$list=db('auth_rule')->field("*,concat(name) as name")->order('name')->select();
			foreach($list as $k=>$v){
				if ($list[$k]['level']!=0) {
		    		$list[$k]['title'] = str_repeat('|--',$list[$k]['level']).$list[$k]['title'];
		    	}
		    }
		    $this->assign('list',$list);
			return view();
		}
		public function rule_insert(){
			$list=input('post.');
			$plevel=db('auth_rule')->field('level')->where('id',$list['pid'])->find();
			if ($plevel) {
				$list['level']=$plevel['level']+1;
			}else{
				$list['level']=0;
			}
			$num=db('auth_rule')->insert($list);
			return $num;
		}
		public function rule_edit(){
			$list=db('auth_rule')->field("*,concat(name) as name")->order('name')->select();
			foreach($list as $k=>$v){
				if ($list[$k]['level']!=0) {
		    		$list[$k]['title'] = str_repeat('|--',$list[$k]['level']).$list[$k]['title'];
		    	}	
		    }
		 	$id=input('id');
		    $arr=db('auth_rule')->where('id',$id)->find();
		    $this->assign('arr',$arr);
		    $this->assign('list',$list);
			return view();
		}
		public function rule_update(){
			$list=input('post.');
			if (!isset($list['status'])){
				$list['status']='off';
			}
			$plevel=db('auth_rule')->field('level')->where('id',$list['pid'])->find();
			if ($plevel) {
				$list['level']=$plevel['level']+1;
			}else{
				$list['level']=0;
			}
			$num=db('auth_rule')->where('id',$list['id'])->update($list);
			return $num;
		}
		public function rule_del(){
			$id=input('id');
			$ids=$this->getChildrenIds($id);
			$idss=explode(",",$ids);
			foreach ($idss as $k => $v) {
				$num=db('auth_rule')->where('id',$v)->delete();
			}
			return $num;
		}
		public function getChildrenIds($id){
			$ids="{$id}";
			$arr=db('auth_rule')->where('pid',$id)->select();
			if ($arr) {
				foreach ($arr as $k => $v) {
					$ids.=','.$v['id'];
				}
			}
			return $ids;
		}
		public function _getChildrenIds($id){
			$ids="{$id}";
			$arr=db('auth_rule')->where('pid',$id)->select();
			if ($arr) {
				foreach ($arr as $k => $v) {
					$ids.='-'.$v['id'];
				}
			}
			return $ids;
		}
		public function admin_role(){
			$list=db('auth_group')->select();
			$num=db('auth_group')->count();
			$this->assign('num',$num);
			$this->assign('list',$list);
			return view();
		}
		public function role_add(){
			$list=db('auth_rule')->field("*,concat(name) as name")->order('name')->select();
			$ids='';
			foreach($list as $k=>$v){
				if ($list[$k]['level']!=0) {
					$list[$k]['title'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$list[$k]['level']).$list[$k]['title'];
				}
				$ids.='-'.$list[$k]['id'];
				$ids=trim($ids,'-');
				$list[$k]['dataid']=$ids;
			}
			$this->assign('list',$list);
			return view();
		}
		public function role_insert(){
			$list=input('post.');
			if (array_key_exists('rules',$list)) {
				$rules=implode(",",$list['rules']);
				$list['rules']=$rules;
			}else{
				$list['rules']=0;
			}
			
			$num=db('auth_group')->insert($list);
			return $num;
		}
		public function role_edit(){
			$id=input('id');
			$list=db('auth_rule')->field("*,concat(name) as name")->order('name')->select();
			$ids='';
			foreach($list as $k=>$v){
				if ($list[$k]['level']!=0) {
					$list[$k]['title'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$list[$k]['level']).$list[$k]['title'];
				}
				$ids.='-'.$list[$k]['id'];
				$ids=trim($ids,'-');
				$list[$k]['dataid']=$ids;
			}
			$arr=db('auth_group')->where('id',$id)->find();
			$this->assign('arr',$arr);
			$this->assign('list',$list);
			return view();
		}
		public function role_update(){
			$list=input('post.');
			$rules=implode(",",$list['rules']);
			$list['rules']=$rules;
			$num=db('auth_group')->where('id',$list['id'])->update($list);
			return $num;
		}
		public function role_del(){
			$id=input('id');
			$list=db('auth_group')->where('id',$id)->find();
			$arr=explode(",",$list['rules']);		
			foreach ($arr as $k => $v) {
				$a=db('auth_rule')->where('id',$v)->delete();
			}
			$num=db('auth_group')->where('id',$id)->delete();
			return $num;
		}
		public function admin_update(){
			$list=input('post.');
	        unset($list['repass']);
	         $result = $this->validate($list,'User');
			if(true !== $result){
    			// 验证失败 输出错误信息
    			return ($result);
			}
	        $m=db('admin')->update($list);
	        return $m;

		}
	public function admin_insert(){
		$list=input('post.');

	    $result = $this->validate($list,'User');
		if(true !== $result){
			// 验证失败 输出错误信息
			$arr=['code'=>1,'result'=>$result];
			$str=json_encode($arr);
			return $str;
		}

		if(!empty($list['repass'])&&!empty($list['address'])&&$list['repass']==$list['password']){
		  	 unset($list['repass']);
		  	 $list['password']=md5($list['password']);
		  	 $list['addtime']=time();
		  	 $m=db("admin")->insertGetId($list);
		  	 if ($m>0) {
		  	 	$a=db('auth_group_access')->insert(['uid'=>$m,'group_id'=>$list['group']]);
		  	 	return 3;
		  	 }
		}
					
    }

    public function admin_state(){
    	$id=input('id');
    	$g=db('admin')->where('id',$id)->find();
    	if ($g['status']==1) {
    		$m=db('admin')->where('id',$id)->update(['status'=>2]);
    		// var_dump($m);
	    	if ($m>0) {
	    		$list=db('admin')->where('id',$id)->find();
	    		$arr=db('auth_group')->where('id',$list['group'])->find();
	    		$m2=db('auth_group')->where('id',$list['group'])->update(['status'=>'off']);
	    		// var_dump($m2);
	    		if ($m2>0) {
	    			$rule=explode(",",$arr['rules']);
		    		foreach ($rule as $key => $value) {
		    			if ($value>0) {
		    				$m3=db('auth_rule')->where('id',$value)->update(['status'=>'off']);
		    				// var_dump($m3);
		    			}
		    		}
	    		}
	    		return $m;
	    	}
    	}else{
    		$m=db('admin')->where('id',$id)->update(['status'=>1]);
    		// var_dump($m);
	    	if ($m>0) {
	    		$list=db('admin')->where('id',$id)->find();
	    		$arr=db('auth_group')->where('id',$list['group'])->find();
	    		$m2=db('auth_group')->where('id',$list['group'])->update(['status'=>'on']);
	    		// var_dump($m2);
	    		if ($m2>0) {
	    			$rule=explode(",",$arr['rules']);
		    		foreach ($rule as $key => $value) {
		    			// var_dump($value);
		    			if ($value>0) {
		    				$m3=db('auth_rule')->where('id',$value)->update(['status'=>'on']);
		    				// var_dump($m3);
		    			}
		    		}
	    		}
	    		return $m;
	    	}
    	}
    	
    }



}
