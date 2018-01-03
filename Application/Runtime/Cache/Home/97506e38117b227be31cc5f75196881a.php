<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/test2.0/Public/CSS/ZY.css">
  <link rel="stylesheet" href="font-awesome.min.css">
  <title>文件&软件下载站(测试版)</title>
</head>
<body>
  <header>
    <span><img src="../../../../../../../Users/acm/Desktop/linghaisen/1.png" width="100" alt="">资源下载站</span>
  </header>
  <article class="container">
    <div class=" left">
      <i class="fa fa-linode fa-2x"></i>文件列表
      <select class="" name="listone" id="Sel" onchange="Change()">
        <option value="none" disabled selected>---请选择---</option>
        <option value="teacher">教师文件</option>
        <option value="common"> 公共资源</option>
      </select>
      <label for="search">
        <i class="fa fl fa-superpowers fa-lg fa-border"></i>
      </label><input id="search" type="text" name="" value="" placeholder="搜 索">
      <section>
        <ul>
          <li><span><i class="fa fa-cube fa-lg"></i> Name</span><span><i class="fa fa-crop fa-lg"></i> Size</span><span><i class="fa fa-calendar-minus-o fa-lg"></i> Last Update</span></li>
          <hr/>
          <li><span>test1</span><span>testest2test2test2test2test2test2test2test2test2test2t2</span><span>test3</span></li>
          <?php if(is_array($result)): foreach($result as $key=>$li): ?><li>
              <div class="list">
                <span><a href="<?php echo U('File/downloadFile',array('folders'=>$li['filesavefolder'],'file'=>$li['filesavename'],'reallyfile'=>$li['filename'],'fileusername'=>$li['username']));?>" style="color:blue;"><?php echo ($li["filename"]); ?></a></span>
                <span><a href=""><?php echo ($li["upfile_time"]); ?></a></span>
                <span><a href=""><?php echo ($li["fileusername"]); ?></a></span>
                <span><a href=""><?php echo ($li["filelabel"]); ?></a></span>
              </div>
            </li><?php endforeach; endif; ?>

        </ul>
      </section>
    </div>
    <nav class="right">
      <ul>
        <li><a href="http://210.30.1.126/index.php/Index">首页</a></li>
        <li><a href="http://210.30.1.126/index.php/Problems/all">练习</a></li>
        <li><a href="http://210.30.1.126/index.php/Competition">竞赛</a></li>
        <li><a href="http://210.30.1.126/index.php/Test">实验</a></li>
        <li><a href="http://210.30.1.126/index.php/Exam">考试</a></li>
        <li><a href="http://210.30.1.126/index.php/Bbs/invitation_list">讨论版</a></li>
        <li><a href="http://210.30.1.126/index.php/Home/help">帮助</a></li>
        <li>意见反馈<br/>imax2017@yeah.net</li>
      </ul>
    </nav>

  </article>
  <footer>
    <!-- <img src="./name.png" width="500" alt=""> -->
  </footer>
</body>
<script type="text/javascript" >

    const url=`<?php echo U('file/showfile');?>`;
    var Change=()=>{
        let myselect=document.getElementById("Sel");
        let index=myselect.selectedIndex ; // selectedIndex代表的是你所选中项的index
        console.log(  myselect.options[index].value);
        let val=myselect.options[index].value
        fetch(url,{
            method:"post",
            headers:{
                "Content-type":"application/x-www-form-urlencoded"
            },
            credentials: "same-origin",
            body:`select=${val}`
        })
            .then(response=>{
            if (response.status == 200){
                console.log(response);
            return response;
        }
    })
    .then(data=>{
      //  console.log(data);
            return data.arrayBuffer();
    })
    .then(arrayBuffer=>{
            console.log("请求成功，响应数据为:",arrayBuffer);
    })
    .catch(err=>{
            console.log("Fetch错误:"+err);
    })
    }
</script>
</html>