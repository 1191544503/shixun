<?php if (!defined('THINK_PATH')) exit();?><!--<html>-->
<!--<head>-->
    <!--<meta charset="UTF-8">-->
<!--</head>-->
<!--<body align="center">-->
<!--<h1>33333</h1>-->

<!--<?php if(is_array($result)): foreach($result as $key=>$li): ?>-->
    <!--<a href="<?php echo U('File/downloadFile',array('folders'=>$li['filesavefolder'],'file'=>$li['filesavename'],'reallyfile'=>$li['filename']));?>"><?php echo ($li["filename"]); ?></a>-->
    <!--&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($li["upfile_time"]); ?>&nbsp &nbsp-->
    <!--<a href="<?php echo U('File/onlineShow',array('folders'=>$li['filesavefolder'],'file'=>$li['filesavename'],'reallyfile'=>$li['filename']));?>">在线浏览</a>-->
    <!--&nbsp;&nbsp;&nbsp;&nbsp;-->

    <!--<br>-->
<!--<?php endforeach; endif; ?>-->

<!--</body>-->
<!--</html>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/test2.0/Public/CSS/index.css">
</head>
<body>
<article class="">
    <div class="list">
        <form method="post" action="<?php echo U('file/showFileSearch',array('fileusername'=>$result[0]['fileusername']));?>">
        <span>文件名</span>
        <span>上传时间</span>
        <span>上传人</span>
        <span style="width:325px;">标签
            <?php if($showsearchLabel == 1 ): ?><select name="label">
                    <option value ="所有">所有</option>
                    <?php if(is_array($label)): foreach($label as $key=>$li): if($li['filelabel'] != '公共文件'): ?><option value ="<?php echo ($li["filelabel"]); ?>"><?php echo ($li["filelabel"]); ?></option><?php endif; endforeach; endif; ?>
                </select><?php endif; ?>

        搜索:<input type="text" name="search" size="15"><input type="submit" name="submit" value="搜索"></span>
        </form>
    </div>
    <hr />

    <section>

        <ul>
            <?php if(is_array($result)): foreach($result as $key=>$li): ?><li>
                <div class="list">
                    <span><a href="<?php echo U('File/downloadFile',array('folders'=>$li['filesavefolder'],'file'=>$li['filesavename'],'reallyfile'=>$li['filename'],'fileusername'=>$li['username']));?>" style="color:blue;"><?php echo ($li["filename"]); ?></a></span>
                    <span><a href=""><?php echo ($li["upfile_time"]); ?></a></span>
                    <span><a href=""><?php echo ($li["fileusername"]); ?></a></span>
                    <span><a href=""><?php echo ($li["filelabel"]); ?></a></span>
                </div>
            </li><?php endforeach; endif; ?>
        </ul>
        <div class="pages">
            <?php echo ($page); ?>
        </div>
    </section>
</article>
</body>
</html>