<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 2018/1/5
 * Time: 15:25
 *用于对举报文件表的操作
 */
namespace Home\Model;
use Think\Model;

class JubaoModel extends  BaseModel{
    /**
     * @param $data 举报文件数据
     * @return bool
     * 添加举报文件数据
     */
    public function adddata($data){
        if($this->data($data)->add()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $filesavename 文件保存名称
     * @return bool
     * 查询该文件是否被举报过
     */
    public function queryFileisExist($filesavename){
        $result=$this->where("filesavename='{$filesavename}'")->count();
        if($result){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $filesavename文件保存名称
     *增加举报次数
     */
    public function addCount($filesavename){
        $sql="update Jubao set jubaocount=jubaocount+1 where filesavename='{$filesavename}'";
        $this->execute($sql);
    }

    /**
     * @return Array
     * 查询举报文件
     */
    public function queryJubaoFile(){
        $sql="select * from file,jubao where file.filesavename=jubao.filesavename"
            ." and jubao.filesavename in (select filesavename from jubao)";
        $result=$this->query($sql);
        return $result;
    }

}