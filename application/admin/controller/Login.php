<?php
	namespace app\admin\controller;
	use think\Session;
	use think\Controller;
	use think\Request;
	use think\Config;
	class Login extends Controller{
		public function index(){
			return view();
		}
		public function dologin(){
			if (Request::instance()->isPost()) { //判断是否是是否为 POST 请求  
	            $data = input('post.');
	            $username = $data['admin_name'];
	            $password = md5($data['password']);
	            $code = $data['code'];
	            //查询数据试库  
	            $where['admin_name'] = $username;
	            $userInfo = db('admin')->where($where)->find();
	            if (!captcha_check($code)) {
	            	return 'NO';
	            	die();
	            }
	            if ($userInfo && $userInfo['password'] == $password) {
					// 登录成功写入session
	                Session::set('admin_name', $userInfo['admin_name']); 
	                Session::set('admin_id', $userInfo['id']);  
	                return 'OK';
	            }
			}
		}
		public function eliminate(){
			$id=Session::get('admin_id');
			$list=db('admin')->where('id',$id)->find();
			$logins=$list['logins']+1;
			$m=db('admin')->where('id',$id)->update(['logins'=>$logins]);
			Session::delete('admin_name');//清除session
			Session::delete('admin_id');
			$this->redirect('admin/index/index');	//重定向
		}
	}