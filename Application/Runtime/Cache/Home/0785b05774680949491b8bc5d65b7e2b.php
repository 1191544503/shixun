<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>文件&软件下载站(测试版)</title>
  <link rel="stylesheet" href="/shixun/Public/js/semantic.min.css">
  <script type="text/javascript" src="/shixun/Public/js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="/shixun/Public/js/semantic.min.js"></script>
  <link rel="stylesheet" href="/shixun/Public/CSS/ZY.css">
  <link rel="stylesheet" href="/shixun/Public/CSS/font-awesome.min.css">

</head>
<body>
<header>
  <span><img src="/shixun/Public/image/1.png" width="100" alt="">资源下载站 </span>
  <?php if($_SESSION['islogin'] != 1): ?><a class="item" onclick="$('#re').modal('show');" style="display:inline-block;float:right"><i class="yellow user icon"></i>注册</a>
    <a class="item" onclick="$('#login').modal('show'); " style="display:inline-block;float:right">
      <i class="olive sign in icon"></i> 登录&nbsp&nbsp&nbsp&nbsp
    </a><?php endif; ?>
  <?php if($_SESSION['islogin'] == 1): ?><a href="<?php echo U('User/teacherShow');?>" style="margin:20px; display:inline-block;float:right">个人中心</a><?php endif; ?>

</header>
<article class="container">
  <div class=" left">
    <i class="fa fa-linode fa-2x"></i>文件列表
    <select class="" name="listone" id="Sel" onchange="Change()">
      <option value="none" disabled selected>---请选择---</option>
      <option value="common">公共资源</option>
      <option value="private"> 私有资源</option>
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
      <li><a href="http://210.30.1.126/index.php/Index">XXXXXXXXXXXX</a></li>
      <li><a href="http://210.30.1.126/index.php/Problems/all">XXXXXXXXXXXX</a></li>
      <li><a href="http://210.30.1.126/index.php/Competition">XXXXXXXXXX</a></li>
      <li><a href="http://210.30.1.126/index.php/Test">XXXXXXXXXXXXXX</a></li>
      <li><a href="http://210.30.1.126/index.php/Exam">XXXXXXXXXXXXX</a></li>
      <li><a href="http://210.30.1.126/index.php/Bbs/invitation_list">XXXXXXXXXX</a></li>
      <li><a href="http://210.30.1.126/index.php/Home/help">XXXXXXXXXXXX</a></li>
      <li>意见反馈<br/>imax2017@yeah.net</li>
    </ul>
  </nav>

</article>
<div class="ui small modal" id="login">
  <div class="ui error message" id="error" hidden></div>
  <i class="close icon"></i>
  <form class="ui  form" action="">
    <div class="ui padded column aligned very relaxed stackable grid">
      <div class="column">
        <div class="field">
          <label>Username</label>
          <div class="ui left icon input" style="padding: 0">
            <input name="username" placeholder="用户名" type="text" id="username" onkeydown="key_login(event)">
            <i class="user icon"></i>
          </div>
        </div>
        <div class="field">
          <label>Password</label>
          <div class="ui left icon input" style="padding: 0">
            <input name="" placeholder="密码" type="password" id="password" onkeydown="key_login(event)">
            <i class="lock icon"></i>
          </div>
        </div>
        <div class="ui blue submit button" id="Login">Login</div>
      </div>
    </div>
    <!-- <div class="ui error message"></div> -->
  </form>
</div>
<script type="text/javascript">
    function key_login(event) {
        if (event.keyCode == 13) {
            login();
        }
    }

    function show_error(error) {
        $("#error").text(error);
        $("#error").show();
    }

    function success(session_id) {
        window.location.href = "<?php echo U('Index/index');?>";
    }

    function login() {
        $("#Login").addClass("loading");
        $.ajax({
            url: "<?php echo U('User/login');?>",
            type: 'POST',
            data: {
                "username": $("#username").val(),
                "password": $("#password").val(),
                //"_csrf": document.head.getAttribute('data-csrf-token')
            },
            async: true,
            success: function(data) {
                console.log(data);
                error_code = data.error_code;
                switch (error_code) {
                    case 1001:
                        show_error("用户不存在");
                        break;
                    case 1002:
                        show_error("密码错误");
                        break;
                    case 1:
                        success(data.session_id);
                        return;
                    default:
                        show_error("未知错误");
                        break;
                }
                $("#Login").text("login");
                $("#Login").removeClass("loading");

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                // alert(XMLHttpRequest.responseText);
                show_error("未知错误");
                $("#Login").text("登录");
                $('.ui.small.modal').modal('hide');
            }
        });
    }
    $(document).ready(function() {
        $("#Login").click(function() {
            login();
        });
    });
</script>
<div class="ui large modal " id="re">
  <div class="ui error message" id="errorinfo" hidden></div>
  <i class="close icon"></i>
  <form class="ui form">
    <div class="ui padded  column middle aligned very relaxed stackable grid">
      <div class="column">
        <div class="field">
          <label for="username1">用户名</label>
          <input type="text" placeholder="" id="username1" required>
        </div>
        <div class="field">
          <label for="email">邮箱</label>
          <input type="email" placeholder="" id="email">
        </div>
        <div class="two fields">
          <div class="field">
            <label class="ui header">密码</label>
            <input type="password" placeholder="" id="password1" required>
          </div>
          <div class="field">
            <label class="ui header">确认密码</label>
            <input type="password" placeholder="" id="password2" required>
          </div>
        </div>

        <!--<a id="sign_up" class="ui button" href="javascript:(0);">注册</a>-->
        <div id="sign_up" class="ui blue submit button">注册</div>
      </div>
    </div>
  </form>

  <script type="text/javascript">
      function show_error1(error) {
          $("#errorinfo").text(error);
          $("#errorinfo").show();
      }

      function success1() {
          alert("注册成功");
          window.location.href = "<?php echo U('/list');?>";
      }

      function submit() {
          if ($("#password1").val() != $("#password2").val()) {
              show_error1("两次输入的密码不一致");
              return;
          }
          $("#sign_up").addClass("loading");
          $.ajax({
              url: "<?php echo U('User/register');?>",

              type: 'POST',
              async: true,
              data: {
                  username: $("#username1").val(),
                  password1: $("#password1").val(),
                  password2: $("#password2").val(),
                  email: $("#email").val(),
                  // _csrf: document.head.getAttribute('data-csrf-token')
              },
              success: function(data) {
                  console.log(data);

                  error_code = data.error_code;
                  switch (error_code) {
                      case 2001:
                          show_error1("服务器未收到数据");
                          break;
                      case 2005:
                      case 2002:
                          show_error1("用户名为学号");
                          break;
                      case 2007:
                      case 2003:
                          show_error1("密码不得为空");
                          break;
                      case 2008:
                          show_error1("已经有人用过这个用户名了");
                          break;
                      case 2009:
                          show_error1("两次密码不一样");
                          break
                      case 2010:
                          show_error1(data.error);
                          break
                      case 1:
                          success1();
                          break;
                      default:
                          show_error1("未知错误：" + JSON.stringify(data));
                          break;
                  }
                  $("#sign_up").removeClass("loading");
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                  alert(XMLHttpRequest.responseText);
                  show_error("未知错误");
                  $("#sign_up").removeClass("loading");
              }
          });
      }
      $(document).ready(function() {
          $("#sign_up").click(function() {
              submit();
          });
      });
  </script>
</div>
<footer>
  <img src="/shixun/Public/image/name.png" width="500" alt="">
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
        console.log("请求成功，响应数据为:",text);
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
        console.log("请求成功，响应数据为:",text);
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