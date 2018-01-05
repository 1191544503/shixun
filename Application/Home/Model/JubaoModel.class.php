<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 2018/1/5
 * Time: 15:25
 */
namespace Home\Model;
use Think\Model;

class JubaoModel extends  BaseModel{
    public function adddata($data){
        if($this->data($data)->add()){
            return true;
        }else{
            return false;
        }
    }
    public function queryFileisExist($filesavename){
        $result=$this->where("filesavename='{$filesavename}'")->count();
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public function addCount($filesavename){
        $sql="update Jubao set count=count+1 where filesavename='{$filesavename}'";
        $this->execute($sql);
    }

}