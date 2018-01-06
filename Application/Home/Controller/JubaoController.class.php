<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 2018/1/5
 * Time: 15:25
 */
namespace Home\Controller;
use Think\Controller;

class JubaoController extends BaseController{
    /**
     *处理举报信息
     */
    public function fileJubao()
    {
        $data['filesavename'] = I('post.filesavename');
        $data['count'] = 1;
        $data['isdelete'] = 0;
        //查询该文件是否被举报过如果被举报过则+1
        $jubaoModel = D('Jubao');
        if ($jubaoModel->queryFileisExist($data['filesavename'])) {
            $jubaoModel->addCount($data['filesavename']);
        } else {
            $jubaoModel->adddata($data);
        }
        echo "1002";
    }
}