<?php
    namespace app\admin\controller;
    use think\Session;
    use think\Controller;
    use think\Request;
    use think\Config;
    use \auth\Auth;
    class Common extends Controller{
        public function _initialize(){
            //任何操作加载的时候，会调用此函数
            if(!session("admin_id")){
                 $this->error('您没有该操作的权限!',url('admin/login/index'),'',10);      
            }
            $auth=new Auth();
            $mod=request()->module();
            $con=request()->controller();
            $act=request()->action();
            $str=$mod.'/'.$con.'/'.$act; //把模块、控制器和方法转换成一个字符串
            // if(!$auth->check($str,session("admin_id"))){
            //     $this->error('您没有该操作的权限!',url('admin/index/index'),'',10);
            // }
        }
    }