<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 2018/1/3
 * Time: 13:44
 * 用于管理员的一些操作
 */
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    /**
     * 初始化主页
     */
    public function index(){
        $fileModel = D('file');
        $result = $fileModel->queryAllUsername();
        $this->assign(fileusername,$result);
        $this->islogin=0;
        $this->display('Index/ZY');
    }
}