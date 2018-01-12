<?php
/**
 * Created by PhpStorm.
 * User: acm
 * Date: 2018/1/3
 * Time: 15:14
 * 用于对文件表的操作
 */
namespace Home\Model;
use Think\Model;

class FileModel extends  BaseModel{
    /**
     * @param $data 文件数据
     * @return bool
     * 添加文件数据
     */
    public function insertData($data){
        if($this->data($data)->add()){
            return true;
        }else{
            return false;
        }
    }
    /**
     * @return Array
     * 查询所有文件
     */
    public function queryData(){
        $result = $this->where(1)->query();
        return $result;
    }

    /**
     * @param $username
     * @return Array
     * 查询用户的公告文件
     */
    public function queryDataByUsername($username){
        $result = $this->where("fileusername='{$username}'and isdelete=0 and filesavefolder='ziyuan'")->order('upfile_time desc')->select();
        return $result;
    }

    /**
     * @return Array
     * 查询所有用户名
     */
    public function queryAllUsername(){
        $result = $this->distinct(true)->field('fileusername')->where("filesavefolder='ziyuan'")->select();
        return $result;
    }

    /**
     * @param $folder
     * @return Array
     * 查询文件夹下文件
     */
    public function queryFileByFolder($folder){//根据文件夹名查询所有数据
        $result = $this->field('filename,filesavename,upfile_time,filesavefolder,fileusername,filelabel')->where("filesavefolder='{$folder}' and isdelete=0")->order('upfile_time desc')->select();
        return $result;
    }

    /**
     * @param $folder  文件夹名
     * @param $username 用户名
     * @return Array
     * 根据用户名和文件权限查询文件
     */
    public function queryFileByFoAndUs($folder,$username){
        $result=$this->where("filesavefolder='{$folder}' and fileusername='{$username}' and isdelete=0")->order('upfile_time desc')->select();
       // $result = $this->field('filename,filesavename,upfile_time,filesavefolder,fileusername,filelabel')->where("filesavefolder='{$folder}' and isdelete=0 and username='{$username}'")->order('upfile_time desc')->select();
        return $result;
    }

    /**
     * @param $folder 文件夹名
     * @return Array
     * 查询文件夹下的文件数量
     */
    public function queryFileCountByFolder($folder){
        $result=$this->where("filesavefolder='{$folder}' and isdelete=0")->count();
        return $result;
    }

    /**
     * @param $filesavename 文件保存名
     * @return bool
     * 删除文件
     */
    public function deleteFile($filesavename){
        $sql = "update file set isdelete=1 where filesavename='{$filesavename}'";
        if($this->execute($sql)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $username 用户名
     * @return Array
     * 根据用户名查询文件的数量
     */
    public function queryFileCountByUsername($username){
        $result = $this->where("fileusername='{$username}'and isdelete=0 and filesavefolder='ziyuan'")->count();
        return $result;
    }

    /**
     * @param $file 文件保存名
     * 文件下载次数加一
     */
    public function addCount($file){
        $sql="update file set file.count=file.count+1 where filesavename ='{$file}'";
        $this->execute($sql);
    }

    /**
     * @param $username 用户名
     * @return Array
     * 查询出该用户上传的所有文件
     */
    public function queryFileByUsername($username){
        $result = $this->field('count,filename,filesavename,upfile_time,filesavefolder,fileusername,filelabel')->where("fileusername='{$username}'and isdelete=0")->order('upfile_time desc')->select();
        return $result;
    }

    /**
     * @param $username 用户名
     * @return int
     * 查询用户上传文件的数量
     */
    public function queryAllCountByUsername($username){
        $count = $this->where("fileusername='{$username}'and isdelete=0")->count();
        return $count;
    }

    /**
     * @param $folder 文件夹名
     * @param $label  类别
     * @return Array
     *根据文件夹名和类别名查询文件
     */
    public function searchFileByLabel($folder,$label){
        $data=$this->where("filesavefolder='{$folder}' and isdelete=0 and filelabel='{$label}'")->order('upfile_time desc')->select();
        return $data;
    }

    /**
     * @param $label 类别
     * @return Array
     * 根据类别查询文件
     */
    public function searchAllFileBylabel($label){
        $data=$this->where("isdelete=0 and filelabel='{$label}'")->order('upfile_time desc')->select();
        return $data;
    }

    /**
     * @param $folder 文件夹名
     * @param $search 用户名
     * @return Array
     * 查询某用户在某文件夹内的文件信息
     */
    public function searchFileByfolder($folder,$search){//////////////////////////////
        $data=$this->where("filesavefolder='{$folder}'and isdelete=0 and filename like '%{$search}%'")->order('upfile_time desc')->select();
        return $data;
    }

    /**
     * @param $folder 文件夹名
     * @param $search 用户名
     * @return int
     * 查询文件夹内某用户文件的数量
     */
    public function searchFileCountByfolder($folder,$search){//////////////////////////////
        $count=$this->where("filesavefolder='{$folder}'and isdelete=0 and filename like '%{$search}%'")->count();
        return $count;
    }

    /**
     * @param $username 用户名
     * @return Array
     * 查询出某用户已有标签
     */
    public function searchLabelByUsername($username){
        $result = $this->distinct(true)->field('filelabel')->where("fileusername='{$username}' and isdelete=0 and filelabel !=''")->select();
        return $result;
    }

    /**
     * @return Array
     * 查询所有文件
     */
    public function queryAllFile(){
        $result = $this->where("isdelete=0")->order('upfile_time desc')->select();
        return $result;
    }
}
?>