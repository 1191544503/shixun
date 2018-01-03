<?php if (!defined('THINK_PATH')) exit();?><!--<html>-->
<!--<head>-->
    <!--<meta charset="UTF-8">-->
<!--</head>-->
<!--<body>-->
<!--<h1>文件上传<h1>-->
    <!--<form action = "<?php echo U('File/up');?>" method="post" enctype="multipart/form-data">-->
    <!--<input type="file" name="upfile"/><input type="submit"/>-->
   <!--</form>-->

<!--</body>-->
<!--</html>-->


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>文件上传</title>
    <link rel="stylesheet" type="text/css" href="/shixun/Public/CSS/upload.css">
    <script type="text/javascript" src="/jquery.min.js"></script>
</head>
<body>
<div id="body">
    <div id="page">
        <div><a href="<?php echo U('User/teacherShow');?>">返回教师页面</a></div>
        <br>
        <div id="title"><h1>文件上传</h1></div>
        <div class="desc">
        <div class="dec">step1:选择教师文件或公共文件（教师文件只能被自己所教的学生看见）</div>
        <div class="dec">step2:选择标签或填写新标签</div>
        <div class="dec">step3:选择文件并提交，若填写了新标签会自动新建并添加到此次上传的文件</div>
        </div>
        <form action = "<?php echo U('File/up');?>" method="post" enctype="multipart/form-data">
            <input type="radio" id="T1" name="filetype" value="teacherfile" checked onchange="fun()"/><label for="T1">教师文件</label>
            <input type="radio" id="T2" name="filetype" value="testdata"  onchange="fun()"/><label for="T2">公共文件</label>
            <br>
            <br>
            <div id="testfile" style="display: none;">

            </div>
            <div id="label" style="display: block;">
                您现有标签:
                <?php if(is_array($label)): foreach($label as $key=>$li): if($li['filelabel'] != '无' and $li['filelabel'] != '公共文件'): ?><input type="radio" name="label" value="<?php echo ($li["filelabel"]); ?>"/><?php echo ($li["filelabel"]); ?>&nbsp &nbsp<?php endif; endforeach; endif; ?>
                <input type="radio" name="label" value="无" checked/>无&nbsp &nbsp &nbsp &nbsp
                <br/>
                <br/>
                新建标签:&nbsp <input type="text" name="label1" placeholder="" size="10">
            </div>
            <br>
            <br>
            <input type="file" name="upfile" id="files" >
            <input type="submit" name="submitBtn" value="提交">
        </form>
    </div>
</div>
</body>
</html>
<script>
    function fun() {
        var tt = document.getElementsByName('filetype')
        if (tt[0].checked) {
            document.getElementById('label').style.display="block";
            document.getElementById('testfile').style.display="none";
        }
        else if (tt[1].checked) {
            document.getElementById('testfile').style.display="block";
            document.getElementById('label').style.display="none";
        }
    }
</script>