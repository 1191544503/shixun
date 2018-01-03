<?php
/**
 * Created by PhpStorm.
 * User: acm
 * Date: 2017/9/25
 * Time: 15:14
 */
namespace Home\Model;
use Think\Model;

class FileModel extends  BaseModel{
    public function insertData($data){
        if($this->data($data)->add()){
            return true;
        }else{
            return false;
        }
    }

    public function queryData(){
        $result = $this->where(1)->query();
        return $result;
    }

    public function queryDataByUsername($username){//查询该老师在特定文件夹下的 文件
        $result = $this->where("fileusername='{$username}'and isdelete=0 and filesavefolder='ziyuan'")->order('upfile_time desc')->select();
        return $result;
    }

    public function queryAllUsername(){//查询所有的用户名
        $result = $this->distinct(true)->field('fileusername')->where("filesavefolder='ziyuan'")->select();
        return $result;
    }

    public function queryFileByFolder($folder){//根据文件夹名查询所有数据
        $result = $this->field('filename,filesavename,upfile_time,filesavefolder,fileusername,filelabel')->where("filesavefolder='{$folder}' and isdelete=0")->order('upfile_time desc')->select();
        return $result;
    }

    public function queryFileCountByFolder($folder){
        $result=$this->where("filesavefolder='{$folder}' and isdelete=0")->count();
        return $result;
    }
    public function queryFileByFolderAndUsername($folder,$username){
        $result=$this->where("filesavefolder='{$folder}' and username='{$username}' and isdelete=0")->count();
        return $result;
    }
    public function deleteFile($filesavename){
        $sql = "update file set isdelete=1 where filesavename='{$filesavename}'";
        if($this->execute($sql)){
            return true;
        }else{
            return false;
        }
    }

    public function queryFileCountByUsername($username){//根据用户名查询文件的数量
        $result = $this->where("fileusername='{$username}'and isdelete=0 and filesavefolder='ziyuan'")->count();
        return $result;
    }

    public function addCount($file){//下载次数
        $sql="update file set file.count=file.count+1 where filesavename ='{$file}'";
        $this->execute($sql);
    }

    public function queryFileByUsername($username){//查询出该用户的所有上传文件，包括教师文件和共有文件
        $result = $this->field('count,filename,filesavename,upfile_time,filesavefolder,fileusername,filelabel')->where("fileusername='{$username}'and isdelete=0")->order('upfile_time desc')->select();
        return $result;
    }
    public function queryAllCountByUsername($username){//查询出该用户的所有上传文件，包括教师文件和共有文件
        $count = $this->where("fileusername='{$username}'and isdelete=0")->count();
        return $count;
    }
    public function searchFileByLabel($folder,$label){//////////////////////////////
        $data=$this->where("filesavefolder='{$folder}' and isdelete=0 and filelabel='{$label}'")->order('upfile_time desc')->select();
        return $data;
    }
    public function searchFileCountByfilename($username,$search="",$label=""){
        $count=$this->where("fileusername='{$username}'and isdelete=0 and filename like '%{$search}%' and filelabel like '%{$label}%'")->count();
        return $count;
    }
    public function searchFileByfolder($folder,$search){//////////////////////////////
        $data=$this->where("filesavefolder='{$folder}'and isdelete=0 and filename like '%{$search}%'")->order('upfile_time desc')->select();
        return $data;
    }
    public function searchFileCountByfolder($folder,$search){//////////////////////////////
        $count=$this->where("filesavefolder='{$folder}'and isdelete=0 and filename like '%{$search}%'")->count();
        return $count;
    }

    public function searchLabelByUsername($username){//查询出该用户已有标签
        $result = $this->distinct(true)->field('filelabel')->where("fileusername='{$username}' and isdelete=0 and filelabel !=''")->select();
        return $result;
    }
}
?>