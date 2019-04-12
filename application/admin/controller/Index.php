<?php
	namespace app\admin\controller;
	use think\Session;
	use think\Controller;
	use think\Request;
	use think\Config;
	use app\admin\controller\Common;
	class Index extends Common{
		public function index(){
			// if (empty(Session::has('admin_name'))) {	//判断session是否为空
			// 	$this->redirect('admin/login/index');	//重定向
			// }else{
				return view();
			// }
		}
		function get_files($path, $absolute=1) {
		    $files = array();
		    $_path = realpath($path);
		    if (!file_exists($_path)) return false;
		    if (is_dir($_path)) {
		        $list = scandir($_path);
		        foreach ($list as $v) {
		            if ($v == '.' || $v == '..') continue;
		            $_paths = $_path.'/'.$v;
		            if (is_dir($_paths)) {
		                //递归
		                $files = array_merge($files, $this->get_files($_paths,$absolute));
		            } else {
		                $files[] = $absolute>0 ? $_paths : $v;
		            }
		        }
		    } else {
		        if (!is_file($_path)) return false;
		        $files[] = $_path;
		    }
		    return $files;
		}
		public function welcome(){
			//登录次数
			$id=Session::get('admin_id');
			$list=db('admin')->where('id',$id)->find();
			$num=$list['logins'];
			$this->assign('num',$num);
			//上次登录IP
			$IP=getenv('REMOTE_ADDR');

			$comment=db('evaluate')->count();
			
			// 图片库
			$flm=$this->get_files('uploads');
			$filenum=count($flm);
			$this->assign('filenum',$filenum);
			//产品库
			$product=db('goods')->count();
			//用户
			$member=db('user')->count();
			// 管理员
			$admin=db('admin')->count();
			//服务器计算机名
			$Fname=$_SERVER['SERVER_ADDR'];
			//服IP
			$FIP=$_SERVER['REMOTE_ADDR'];
			//服务器域名
			$FY=$_SERVER['SERVER_NAME'];
			//服务器端口
			$FD=$_SERVER['SERVER_PORT'];
			
			//本文件所在文件夹
			$WJ=substr(__FILE__,0,-11);
			//服务器操作系统
			$FC=PHP_OS;
			//服务器脚本超时时间
			$overtime=get_cfg_var("max_execution_time");
			//服务器的语言种类
			$language=$_SERVER['HTTP_ACCEPT_LANGUAGE'];			
			//服务器当前时间
			$newtime= date("Y-m-d l H:i:s A");       
			//服务器IE版本
			$IE=strtolower($_SERVER["HTTP_USER_AGENT"]);
			//虚拟内存
			$virtual=round((disk_free_space(".")/(1024*1024)),2).'M';
			//当前程序占用内存 
			$usen=(memory_get_usage()/1024)."Kb";
			$sesid=session_id();
			
			$this->assign('IP',$IP);
			$this->assign('comment',$comment);
			$this->assign('product',$product);
			$this->assign('member',$member);
			$this->assign('admin',$admin);
			$this->assign('Fname',$Fname);
			$this->assign('FIP',$FIP);
			$this->assign('IE',$IE);
			$this->assign('FY',$FY);
			$this->assign('FD',$FD);
			$this->assign('WJ',$WJ);
			$this->assign('FC',$FC);
			$this->assign('overtime',$overtime);
			$this->assign('language',$language);
			$this->assign('newtime',$newtime);
			$this->assign('virtual',$virtual);
			$this->assign('usen',$usen);
			$this->assign('sesid',$sesid);
			return view();
		}
		public function useradmin(){
			$id=input('id');
			$list=db('admin')->where('id',$id)->find();
			$group=db('auth_group')->where('id',$list['group'])->find();
			$this->assign('list',$list);
			$this->assign('group',$group);
			return view();
		}
}