<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/test2.0/Public/CSS/ZY.css">
  <link rel="stylesheet" href="/test2.0/Public/CSS/font-awesome.min.css">
  <title>文件&软件下载站(测试版)</title>
</head>
<body>
<header>
  <span><img src="/test2.0/Public/image/1.png" width="100" alt="">资源下载站</span>
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
      <i class="fa fl fa-superpowers fa-lg fa-border" onclick="Find()"></i>
    </label><input id="search" type="text" name="" value="" placeholder="搜 索">
    <section>
      <ul>
        <li><span><i class="fa fa-cube fa-lg"></i> Name</span><span><!--i class="fa fa-crop fa-lg"></i> UploadUser<--></span><span><i class="fa fa-calendar-minus-o fa-lg"></i> Last Update</span></li>
        <hr/>
      </ul>
      <ul id="Content">

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
  <img src="/test2.0/Public/image/name.png" width="500" alt="">
</footer>
</body>
<script type="text/javascript" >

    var FILE=[];//文件名
    const Url2="<?php echo U('File/showFileSearchByLabel');?>";
    /*  遍历渲染  ${text.fileusername}*/
    let xx=(text,i)=>{
        let str=`<li><span><a href="${text.downloadurl}">${text.filename}</a></span><span></span><span>${text.upfile_time}</span><span class="label">${text.filelabel}</span></li>`
        document.getElementById('Content').innerHTML+=str;
    }
    let xl=(name,Url)=>{
        fetch(Url,{
            method:"post",
            headers:{
                "Content-type":"application/x-www-form-urlencoded"
            },
            credentials: "same-origin",
            body:name
        })
            .then(response=>{
            if (response.status == 200){
            return response.json();
        }
    })
    .then(text=>{
            document.getElementById('Content').innerHTML='';
      //  console.log("请求成功，响应数据为:",text);
        for (let i in text) {
            xx(text[i],i);
        }
    })
    }
    /*  选择  */
    var Change=()=>{
        const url=`<?php echo U('File/showfile');?>`;
        let myselect=document.getElementById("Sel");
        let index=myselect.selectedIndex ; // selectedIndex代表的是你所选中项的index
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
            return response;
        }
    })
    .then(data=>{
            return data.json();
    })
    .then(text=>{
            document.getElementById('Content').innerHTML='';
       // console.log("请求成功，响应数据为:",text);
        FILE=[];
        for (let i in text) {
            xx(text[i],i);
            FILE[i]=text[i];
        }
        var label = document.getElementsByClassName('label');
        for (let x=0; x<label.length;x++) {
            label[x].onclick = function(){
                let tfilelabel=FILE[x].filelabel;
                tfilelabel = tfilelabel.replace(/\+/g, "%2B");
                tfilelabel = tfilelabel.replace(/\&/g, "%26");
                xl(`filelabel=${tfilelabel}`,Url2);
            }
        }
    })
    .catch(err=>{
       //     console.log("Fetch错误:"+err);
    })
    }
    /*  搜索  */
    var Find=()=>{
        let myselect=document.getElementById("search").value;
        document.getElementById('Content').innerHTML='';
     //   console.log( myselect);
        // if(!myselect)
        for (let str in FILE) {
            if(FILE[str].filename.includes(myselect))
            {
        //        console.log(FILE[str]);
                xx(FILE[str],str);
            }
        }
        document.getElementById("search").value='';
        var label = document.getElementsByClassName('label');
        for (let x=0; x<label.length;x++) {
            label[x].onclick = function(){
                let tfilelabel=FILE[x].filelabel;
                tfilelabel = tfilelabel.replace(/\+/g, "%2B");
                tfilelabel = tfilelabel.replace(/\&/g, "%26");
                xl(`filelabel=${tfilelabel}`,Url2);
            }
        }
    }

</script>
</html>