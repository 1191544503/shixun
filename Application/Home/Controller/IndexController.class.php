<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $fileModel = D('file');
        $result = $fileModel->queryAllUsername();
        $this->assign(fileusername,$result);
        $this->islogin=0;
        $this->display('Index/ZY');
    }
}