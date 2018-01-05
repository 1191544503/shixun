<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 2018/1/4
 * Time: 14:12
 */
namespace Home\Model;
use Think\Model;

class AdminModel extends  BaseModel{
    public function correctAdminPwd($username,$password){
        $pwd=$this->field('password')->where("username='{$username}'")->select();
        if($pwd==$password){
            return true;
        }else{
            return false;
        }
    }
}
?>