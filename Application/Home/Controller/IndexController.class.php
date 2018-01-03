<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

        $teacherid=I('get.teacherid');
        $teacherid=base64_decode($teacherid);
        $teacherid-=100861234567;
        $_SESSION['teacherid']=$teacherid;
        $fileModel = D('file');
        $result = $fileModel->queryAllUsername();
        $this->assign(fileusername,$result);
        $this->display('Index/ZY');
    }
}