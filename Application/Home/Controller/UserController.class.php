<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends BaseController {
    public function userinfo(){
        $fileModel = D('file');
      //  $username=session('username');

        $username=session('username');
       // $count=$fileModel->queryAllCountByUsername($username);//查询出该用户上传的所有文件
        $result=$fileModel->queryFileByUsername($username);
        for($i=0;$i<count($result);$i++){
            $result[$i]['downloadurl'] = U('File/downloadFile')."&folders={$result[$i]['filesavefolder']}&file={$result[$i]['filesavename']}&reallyfile={$result[$i]['filename']}&fileusername={$result[$i]['username']}";
        }
        $label=$fileModel->searchLabelByUsername($username);//查询标签数据
        $this->assign(label,$label);
     //   $this->assign('result',$result);
        echo json_encode($result);
      //  $this->display('userinfo');
    }
    public function teacherShow(){
        if(I('get.adminid')!="") {
            $_SESSION['username'] = I('get.adminid');
        }
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
     *在userinfo中检索数据
     *
     */
    public function UserinfoSearch(){
        $id=$_SESSION['username'];
        $search=I('post.search');
        $label=I('post.label');
        $fileModel = D('file');
        if($label=="所有"){
            $label="";
        }
        $count=$fileModel->searchFileCountByfilename($id,$search,$label);
        $page=$this->dataPagination($count,15);//产生分页
        $result=$fileModel->searchFileByfilename($id,$search,$label,$page);
        $label=$fileModel->searchLabelByUsername($id);//查询标签数据
        $show=$page->show();

        $this->assign(page,$show);

        $this->assign(label,$label);
        $this->assign(result,$result);
        $this->display('userinfo');

    }

}