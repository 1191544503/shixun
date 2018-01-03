<?php
/**
 * Created by PhpStorm.
 * User: acm
 * Date: 2017/9/25
 * Time: 15:14
 */
namespace Home\Model;
use Think\Model;

class UserModel extends  BaseModel{
   public function addUser($data){
       if($this->data($data)->add()){
            return true;
       }else{
           return false;
       }
   }
   public function isExistsUser($username){
       $count=$this->where("username='{$username}'")->select();
       return $count;
   }
   public function checkcorrect($data){
       $pwd=$this->where("username='{$data['user']}'")->select();
       if($pwd[0]['password']==$data['password']){
            return false;
        }else{
            return true;
        }
   }
   public function queryadministrator($username){
       $flag=$this->field('administrator')->where("username='{$username}'")->select();
       return $flag;
   }
}
?>