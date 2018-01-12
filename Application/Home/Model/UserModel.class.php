<?php
/**
 * Created by PhpStorm.
 * User: acm
 * Date: 2017/9/25
 * Time: 15:14
 * 用于对用户表的操作
 */
namespace Home\Model;
use Think\Model;

class UserModel extends  BaseModel{
    /**
     * @param $data 用户数据
     * @return bool
     * 添加用户
     */
   public function addUser($data){
       if($this->data($data)->add()){
            return true;
       }else{
           return false;
       }
   }

    /**
     * @param $username 用户名
     * @return $count
     * 判断该用户是否存在
     */
   public function isExistsUser($username){
       $count=$this->where("username='{$username}'")->select();
       return $count;
   }

    /**
     * @param $data 用户数据
     * @return bool
     * 判断用户名和密码是否匹配
     */
   public function checkcorrect($data){
       $pwd=$this->where("username='{$data['user']}'")->select();
       if($pwd[0]['password']==$data['password']){
            return false;
        }else{
            return true;
        }
   }

}
?>