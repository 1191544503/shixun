<?php if (!defined('THINK_PATH')) exit();?><!--<html>-->
<!--<meta http-equiv="content-type" content="text/html; charset=utf-8">-->
<!--<link rel="stylesheet" type="text/css" href="/test2.0\Application\Home\View\Index\mas.css">-->
<!--<body align="center">-->

<!--<?php if($_SESSION['isteacher'] == 1): ?>-->
    <!--<a href="<?php echo U('File/displayup');?>">上传文件</a>-->
<!--<?php endif; ?>-->

<!--<a href="<?php echo U('File/showfolder');?>">下载文件</a>-->

<!--<?php if($_SESSION['isteacher'] == 1): ?>-->
    <!--<a href="<?php echo U('User/userinfo');?>">我的文件</a>-->
<!--<?php endif; ?>-->

<!--<div class="page_bbs">-->
    <!--<div class="bbs_page">-->
        <!--11111111-->
    <!--</div>-->
<!--</div>-->
<!--</body>-->
<!--</html>-->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>资源管理器</title>
    <link rel="stylesheet" type="text/css" href="/test2.0/Public/CSS/main.css">
</head>
<body>

<div id="body">
    <div id="page">
        <div id="teacher"><button class="button button2" onclick="teacher()">教师文件</button></div>
        <div id="show">
            <button class="button button2" ><a href="<?php echo U('file/showfile',array('filesavefolder'=>'testdata'));?>">公共文件</a></button>
        </div>

        <div id="file">
            <?php if(is_array($fileusername)): foreach($fileusername as $key=>$li): ?><div class="folder"><a href="<?php echo U('file/showfile',array('filesavefolder'=>'ziyuan','fileusername'=>$li['fileusername']));?>"><?php echo ($li["fileusername"]); ?></a></div><?php endforeach; endif; ?>
        </div>
        <?php if($_SESSION['isteacher'] == 1): ?><ul class="nav">
            <li><a href="<?php echo U('File/displayup');?>"  >上传文件</a></li>

            <li><a href="<?php echo U('User/userinfo');?>">我的文件</a></li>
        </ul><?php endif; ?>
    </div>
</div>
</body>
</html>

<script type="text/javascript">
    function teacher()
    {
        var t=document.getElementById('file');
        t.style.display="block";
    }
</script>