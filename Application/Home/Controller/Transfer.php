<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 2018/1/10
 * Time: 14:38
 * 用于封装断点续传类
 */
class Transfer {
    const BUFF_SIZE = 5120; // 1024 * 5
    private $filePath;
    private $fileSize;
    private $mimeType;
    private $range;
    private $showname;
    private $isLog = false;
    /**
     *
     * @param <String> $filePath 文件路径
     * @param <String> $mimeType  文件类型
     * @param <String> $range 请求区域（范围）
     */
    function __construct($filePath, $mimeType = null , $range = null,$showname) {
        $this->filePath = $filePath;
        $this->fileSize = sprintf('%u',filesize($filePath));
        $this->mimeType = ($mimeType != null)?$mimeType:"application/octet-stream"; //  bin
        $this->range = trim($range);
        $this->showname=$showname;
    }
    /**
     *  获取文件区域
     * @return <Map> {'start':long,'end':long} or null
     */
    private function getRange() {
        if (!empty($this->range)) {
            $range = preg_replace('/[\s|,].*/','',$this->range);
            $range = explode('-',substr($range,6));
            if (count($range) < 2 ) {
                $range[1] = $this->fileSize; // Range: bytes=-100
            }
            $range = array_combine(array('start','end'),$range);
            if (empty($range['start'])) {
                $range['start'] = 0;
            }
            if (!isset ($range['end']) || empty($range['end'])) {
                $range['end'] = $this->fileSize;
            }
            return $range;
        }
        return null;
    }
    /**
     * 向客户端发送文件
     */
    public function send() {
        $fileHande = fopen($this->filePath, 'rb');
        if ($fileHande) {
            // setting
            ob_end_clean();// clean cache
            ob_start();
            ini_set('output_buffering', 'Off');
            ini_set('zlib.output_compression', 'Off');
            $magicQuotes = get_magic_quotes_gpc();
            set_magic_quotes_runtime(0);
            // init
            $lastModified = gmdate('D, d M Y H:i:s', filemtime($this->filePath)).' GMT';
            $etag = sprintf('w/"%s:%s"',md5($lastModified),$this->fileSize);
            $ranges = $this->getRange();
            // headers
            header(sprintf('Last-Modified: %s',$lastModified));
            header(sprintf('ETag: %s',$etag));
            header(sprintf('Content-Type: %s',$this->mimeType));
            $disposition = 'attachment';
            if (strpos($this->mimeType,'image/') !== FALSE) {
                $disposition = 'inline';
            }
            header(sprintf('Content-Disposition: %s; filename="%s"',$disposition,basename($this->showname)));

            if ($ranges != null) {
                if ($this->isLog) {
                    $this->log(json_encode($ranges).' '.$_SERVER['HTTP_RANGE']);
                }
                header('HTTP/1.1 206 Partial Content');
                header('Accept-Ranges: bytes');
                header(sprintf('Content-Length: %u',$ranges['end'] - $ranges['start']));
                header(sprintf('Content-Range: bytes %s-%s/%s', $ranges['start'], $ranges['end'],$this->fileSize));
                //
                fseek($fileHande, sprintf('%u',$ranges['start']));
            }else {
                header("HTTP/1.1 200 OK");
                header(sprintf('Content-Length: %s',$this->fileSize));
            }
            // read file
            $lastSize = 0;
            while(!feof($fileHande) && !connection_aborted()) {
                set_time_limit(0);
                $lastSize = sprintf("%u", bcsub($this->fileSize+1,sprintf("%u",ftell($fileHande))));
                if (bccomp($lastSize,self::BUFF_SIZE) > 0) {
                    $lastSize = self::BUFF_SIZE;
                }
          //      echo " ";
                echo fread($fileHande, $lastSize);
                ob_flush();
                flush();
                //  sleep(1);
            }
               set_magic_quotes_runtime($magicQuotes);
            ob_end_flush();
        }
        if ($fileHande != null){
            fclose($fileHande);
        }
    }
    /**
     * 设置记录
     * @param <Boolean> $isLog  是否记录
     */
    public function setIsLog($isLog = true) {
        $this->isLog = $isLog;
    }
    /**
     * 记录
     * @param <String> $msg  记录信息
     */
    private function log($msg) {
        try {
            $handle = fopen('transfer_log.txt', 'a');
            fwrite($handle, sprintf('%s : %s'.PHP_EOL,date('Y-m-d H:i:s'),$msg));
            fclose($handle);
        }catch(Exception $e) {
            // null;
        }
    }
}
?>