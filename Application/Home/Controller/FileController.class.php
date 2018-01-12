<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 2018/1/3
 * Time: 15:38
 * 用于操作文件
 */
namespace Home\Controller;
use Think\Controller;
use think\response\Json;

header("content-type:text/html;charset=utf-8");
class FileController extends BaseController{
    public function displayup(){
        $username =$_SESSION['username'];
        $fileModel=D('file');
        $result=$fileModel->searchLabelByUsername($username);
        $this->assign(label,$result);
        $this->display('upfile');
    }
    /**
     * 展示文件
     *@return Json
     */
    public function showfile(){
        $fileModel = D('file');
        $filefolder=I('post.select');
        if($filefolder=="common") {//判断展示哪类文件
            $username=$_SESSION['username'];
            $result=$fileModel->queryFileByFolder('ziyuan');
            for($i=0;$i<count($result);$i++){
                $result[$i]['downloadurl'] = U('File/duandiandownloadFile')."&folders={$result[$i]['filesavefolder']}&file={$result[$i]['filesavename']}&reallyfile={$result[$i]['filename']}&fileusername={$result[$i]['username']}";
            }
        }
        else if($filefolder=="private"){
           $username=$_SESSION['username'];
           $result=$fileModel->queryFileByFoAndUs('testdata',$username);//查询文件夹内文件根据page分页
            for($i=0;$i<count($result);$i++){
                $result[$i]['downloadurl'] = U('File/duandiandownloadFile')."&folders={$result[$i]['filesavefolder']}&file={$result[$i]['filesavename']}&reallyfile={$result[$i]['filename']}&fileusername={$result[$i]['username']}";
            }
        }
        echo json_encode($result);
    }
    /**
     * 处理文件信息上传文件
     */
    public function up(){
        $file= $_FILES['upfile'];
        $username = session('username');
        $uptype=I('post.filetype');
        if($uptype=="teacherfile"){//上传共有文件
            $filename=$file['name'];
            $data['filelabel']=I('post.label1');//获取标签
            if($data['filelabel']==""){
                $data['filelabel']=I('post.label');
            }
            $data['filesavefolder'] = "ziyuan";
        }
        elseif($uptype=="testdata"){//上传私有文件
            $filename=$file['name'];
            $data['filesavefolder'] = "testdata";
            $data['filelabel']="私有文件";

        }
        $filenamemd5=$this->md5FileName($filename,date(Y-m-d));
        $filesavename = $this->subFilename($filename,$filenamemd5);
        $data['fileusername'] = $username;
        $data['filename'] = $filename;
        $data['filetype'] = $file['type'];
        $data['filesavename'] = $filesavename;
        $data['isdelete'] = 0;
        $data['count'] = 0;
        $data['upfile_time'] = date("Y-m-d");
        $fileModel = D('file');

        if($this->upFile($file,$filenamemd5,$data['filesavefolder'])){
            if($fileModel->insertData($data)) {
                $this->success("上传成功",U('file/displayup'));
            }else{
                $this->error("上传失败",U('file/displayup'));
            }
        }else{
            $this->error("上传失败",U('file/displayup'));
        }
    }
    /**
     * 文件上传函数
     * @param <Array> file 文件路径
     * @param <String> filename  文件名称
     * @param <String> folder 文件所在文件夹
     * @return  boolean
     */
    public function upFile($file,$filename,$folders){
        $folders = iconv("utf-8","GBK",$folders);
        $path='./Public/'.$folders.'/';
        if(!file_exists($path)){
            mkdir($path);
        }

        $upload = new \Think\Upload();
        $upload->maxSize=3145728000;
        $upload->autoSub=false;
        $upload->rootPath=$path;
        $upload->saveName = $filename;
        $upload->exts = array('jpg','jpeg','zip','doc','txt','docx','png','ppt','gif','bmp','mp4','avi','xml','rar','7z');
        $upload->uploadReplace = false;

        $info = $upload->uploadOne($file);

        if($info){
            return true;
        }else{
            $this->error=$upload->getError();
            echo $this->error;
            return false;
        }
}
     /**
      * 正常方式文件下载函数
      */
 public function downloadFile(){
        $folders=I('get.folders');
        $file = I('get.file');
        $reallyfile=I('get.reallyfile');

        $reallyfile=urlencode($reallyfile);
        $file = iconv("utf-8","GBK",$file);
        $url ='H:/AppServ/www/shixun/Public/'.$folders.'/'.$file;
        import('Org.Net.Http');
        $fileModel=D('file');
        $fileModel->addCount($file);

        $http=new \Org\Net\Http;//调用HTTP协议下载
        $http->download($url,$reallyfile);
 }

    /**
     * 断点续传方式文件下载
     */
    public function duandiandownloadFile(){
        $folders=I('get.folders');
        $file = I('get.file');
        $reallyfile=I('get.reallyfile');

        $reallyfile=urlencode($reallyfile);
        $file = iconv("utf-8","GBK",$file);
        $url ='H:/AppServ/www/shixun/Public/'.$folders.'/'.$file;
        include('Transfer.php');

        $fileModel=D('file');
        $fileModel->addCount($file);

        $type=pathinfo($url, PATHINFO_EXTENSION);
        $type=strtolower($type);
        if($type=="doc"||$type=="docx"){
            $mimeType="application/msword";
        }else if($type=="exe"){
            $mimeType="application/x-msdownload";
        }else if($type=="jpg"||$type=="jpeg"){
            $mimeType="image/jpeg";
        }else if($type=="pdf"){
            $mimeType="application/pdf";
        }else if($type=="xls"){
            $mimeType="application/vnd.ms-excel";
        }else {
            $mimeType = "application/octet-stream";
        }
        $range = isset($_SERVER['HTTP_RANGE'])?$_SERVER['HTTP_RANGE']:null;
        $transfer = new \Transfer($url,$mimeType,$range,$reallyfile);
        set_time_limit(0);
        if (1) {
            $transfer->setIsLog(true);
        }
        $transfer->send();

    }

    public function test(){

        include('Transfer.php');
        $filePath = 'C:\Users\jack\Desktop\45.txt';
        $type=pathinfo($filePath, PATHINFO_EXTENSION);
        $type=strtolower($type);
        if($type=="doc"||$type=="docx"){
            $mimeType="application/msword";
        }else if($type=="exe"){
            $mimeType="application/x-msdownload";
        }else if($type=="jpg"||$type=="jpeg"){
            $mimeType="image/jpeg";
        }else if($type=="pdf"){
            $mimeType="application/pdf";
        }else if($type=="xls"){
            $mimeType="application/vnd.ms-excel";
        }else {
            $mimeType = "application/octet-stream";
        }
        $range = isset($_SERVER['HTTP_RANGE'])?$_SERVER['HTTP_RANGE']:null;
        set_time_limit(0);
        $transfer = new \Transfer($filePath,$mimeType,$range,$reallyfile="12.txt");
        if (IS_DEBUG) {
            $transfer->setIsLog(true);
        }
        $transfer->send();

    }
    /**
     *TXT格式的在线浏览
     */
    public function onlineShow()
    {
        $folders = I('get.folders');
        $file = I('get.file');
        $reallyfile = I('get.reallyfile');
        $len=strlen($reallyfile);
        if($reallyfile[$len-3]=='t'&&$reallyfile[$len-2]=='x'&&$reallyfile[$len-1]=='t'||1) {

            $reallyfile = urlencode($reallyfile);
            $file = iconv("utf-8", "GBK", $file);
            $url = 'H:/AppServ/www/shixun/Public/'.$folders.'/'.$file;

            if (file_exists($url)) {
                $str = file_get_contents($url);//将整个文件内容读入到一个字符串中
                $str = str_replace("\r\n", "<br />", $str);
                $str = iconv("gb2312", "utf-8//IGNORE", $str);
                echo $str;

            }
        }else{
            echo "该文件类型暂不支持在线浏览";
        }
    }

    /**
     * 在showfile中检索数据
     * @return Json
     */
    public function showFileSearchByLabel(){
        $label=I('post.filelabel');
        $fileModel = D('file');
        if($label=="私有文件"){
            $result=$fileModel->searchFileBylabel('testdata', $label);
            for($i=0;$i<count($result);$i++){
                $result[$i]['downloadurl'] = U('File/duandiandownloadFile')."&folders={$result[$i]['filesavefolder']}&file={$result[$i]['filesavename']}&reallyfile={$result[$i]['filename']}&fileusername={$result[$i]['username']}";
            }
        }else {
            $result = $fileModel->searchFileBylabel('ziyuan', $label);
            for($i=0;$i<count($result);$i++){
                $result[$i]['downloadurl'] = U('File/duandiandownloadFile')."&folders={$result[$i]['filesavefolder']}&file={$result[$i]['filesavename']}&reallyfile={$result[$i]['filename']}&fileusername={$result[$i]['username']}";
            }
        }
        echo json_encode($result);
    }

    /**
     * 根据文件分类进行搜索
     * @return Json
     */
    public function UserinfoSearchByLabel(){
        $label=I('post.filelabel');
        $fileModel = D('file');
        $fileusername = $_SESSION['username'];
        $result=$fileModel->searchAllFileBylabel($label);
        echo json_encode($result);
    }
    /**
     *文件命名MD5加密
     * 通过将文件名尾部添加随机数，并进行15次md5加密
     */
 public function md5FileName($filename ,$date){
        $random=rand(1001,9999999);
        $filename.=$date;
        $filename.=$random;

        for($i=0;$i<15;$i++) {
            $filename = md5($filename);
        }

        return $filename;
 }
    /**
     * 文件名后缀拼接
     */
 public function subFilename($filename,$filesavename){

     $filesavename.=strchr($filename,".");
     return $filesavename;
 }

}
?>