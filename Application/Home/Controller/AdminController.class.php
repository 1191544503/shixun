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
            echo "<script>alert('用户名或密码错误! ');</script>";
            $this->display('login');
        }
    }
    public function managefile(){
        $this->display('managefile');
    }
    public function dealManageFile(){
        $fileModel = D('file');
        $result=$fileModel->queryAllFile();
        for($i=0;$i<count($result);$i++){
            $result[$i]['downloadurl'] = U('File/downloadFile')."&folders={$result[$i]['filesavefolder']}&file={$result[$i]['filesavename']}&reallyfile={$result[$i]['filename']}&fileusername={$result[$i]['username']}";
        }
        echo json_encode($result);
    }
    public function dealJubaoFile(){
        $jubaoModel=D('jubao');
        $result=$jubaoModel->queryJubaoFile();
        for($i=0;$i<count($result);$i++){
            $result[$i]['downloadurl'] = U('File/downloadFile')."&folders={$result[$i]['filesavefolder']}&file={$result[$i]['filesavename']}&reallyfile={$result[$i]['filename']}&fileusername={$result[$i]['username']}";
        }
        echo json_encode($result);
    }
    public function jubaofile(){
        $this->display('jubaofile');
    }
}

?>