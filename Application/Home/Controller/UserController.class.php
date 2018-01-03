<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends BaseController {
    public function userinfo(){
        $fileModel = D('file');
        $username=session('username');

        $result=$fileModel->queryFileByUsername($username);
        for($i=0;$i<count($result);$i++){
            $result[$i]['downloadurl'] = U('File/downloadFile')."&folders={$result[$i]['filesavefolder']}&file={$result[$i]['filesavename']}&reallyfile={$result[$i]['filename']}&fileusername={$result[$i]['username']}";
        }
        $label=$fileModel->searchLabelByUsername($username);//查询标签数据
        $this->assign(label,$label);
        echo json_encode($result);
    }
    public function teacherShow(){
        $this->display('ZYteacher');
    }

    /**
     * 文件删除
     */
    public function deleteFile(){
        $filesavename = I('post.filesavename');
        $fileModel = D('file');
        if($fileModel->deleteFile($filesavename)){
            echo "1000";
        }else{
            echo "1001";
        }
    }
    /**
     * 个人注册
     */
    public function register(){
        $flag = 1;
        $data['username'] = I('post.username');
        $data['password']  = I('post.password1');
        $data['password1'] = I('post.password2');
        $data['email'] = I('post.email');
        $data['password'] =$this->encryptPwd($data['password']);
        $data['password1'] =$this->encryptPwd($data['password1']);
        if($data['email'] == "1191544503@qq.com"){//判断是不是注册管理员
            $data['administrator'] = 1;
        }else{
            $data['administrator'] = 0;
        }
        $userModel = D('User');
        if($flag&&!$data['password']==$data['password1']){
            $data['error_code'] = 2009;
            $flag = false;
        }
        if($flag&&$userModel->isExistsUser($data['username'])){
            $data['error_code'] = 2008;
            $flag = false;
        }
        if(!$flag){
            $this->assign('data',$data);
            $this->ajaxReturn($data);
        } else{
            $userModel->addUser($data);
            $data['error_code'] = 1;
            $this->ajaxReturn($data);
        }
    }
    /**
     * 处理登陆数据
     *
     * @return void
     */
    public function login(){
        $flag = true;
        $data['user'] = I('post.username');
        $data['password'] = I('post.password');
        $data['password'] =$this->encryptPwd($data['password']);
        $userModel = D('User');
        if(!$userModel->isExistsUser($data['user'])){//判断用户名是否存在
            $flag= false;
            $data['error_code']= 1001;
            $this->ajaxReturn($data);
        }
        if($flag&&$userModel->checkcorrect($data)){//若存在继续判断密码是否正确
            $flag = false;
            $data['error_code']= 1002;
            $this->ajaxReturn($data);
        }
        if($flag){
            $_SESSION['username'] = $data['user'];
            if($userModel->queryadministrator($data['user'])){//判断是不是管理员
                $_SESSION['admin'] = 1;
            }else{
                $_SESSION['admin'] = 0;
            }
            $_SESSION['islogin']=1;
            $data['error_code'] = 1;
            $data['session_id'] = $data['user'];
            $this->ajaxReturn($data);
        }else{
            $data['error_code']= 9999;
            $this->ajaxReturn($data);
        }
    }

    /**
     *在userinfo中检索数据
     *
     */
//    public function UserinfoSearch(){
//        $id=$_SESSION['username'];
//        $search=I('post.search');
//        $label=I('post.label');
//        $fileModel = D('file');
//        if($label=="所有"){
//            $label="";
//        }
//        $count=$fileModel->searchFileCountByfilename($id,$search,$label);
//        $page=$this->dataPagination($count,15);//产生分页
//        $result=$fileModel->searchFileByfilename($id,$search,$label,$page);
//        $label=$fileModel->searchLabelByUsername($id);//查询标签数据
//        $show=$page->show();
//
//        $this->assign(page,$show);
//
//        $this->assign(label,$label);
//        $this->assign(result,$result);
//        $this->display('userinfo');
//
//    }

    /**
     * 密码md5加密
     * @param $password
     * @return string
     */
    public function encryptPwd($password){
        $password = strrev($password);
        $password = sha1($password);
        for($i = 0;$i<15;$i++){
            $password = md5($password);
        }
        return $password;
    }

}