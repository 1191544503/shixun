<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 2018/1/4
 * Time: 13:42
 */
namespace Home\Controller;
use Think\Controller;

class AdminController extends BaseController{
    public function index(){
        if(session('?admin')){
            $this->display('index');
        }else{
            $this->display('login');
        }
    }
    public function login(){
        $username=I('post.txtName');
        $password=I('post.txtPass');
        $adminModel=D('Admin');
        if($adminModel->correctAdminPwd($username,$password)) {
            $_SESSION['admin']=1;
            $this->display('index');
        }else{
            echo "<script>alert('用户名或密码错误！');</script>";
            $this->display('login');
        }
    }
}

?>