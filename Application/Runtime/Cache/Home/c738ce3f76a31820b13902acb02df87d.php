<?php if (!defined('THINK_PATH')) exit();?><!doctype html public "-//w3c//dtd xhtml 1.0 transitional//en" "http://www.w3.org/tr/xhtml1/dtd/xhtml1-transitional.dtd"><HTML>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!-- saved from url=(0054)http://www.happyd.com/admin/login.aspx?url=%2fadmin%2f -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html >
<head>
    <title>管理员登录</title>
    <link rel="stylesheet" type="text/css" href="/shixun/Public/style/admin/common.css" />
    <script type="text/javascript" src="/shixun/Public/js/jquery-3.2.1.min.js"></script>
    <script src="/shixun/Public/editor/kindeditor.js " language="javascript"></script>
    <script src="/shixun/Public/js/admin/admin.js " language="javascript"></script>
    <script src="/shixun/Public/js/date/WdatePicker.js" type="text/javascript" ></script>
    <script type="text/javascript">
        var PUBLIC = "/shixun/Public";
        var URL = "/shixun/index.php/Home/Admin";
        var APP = "/shixun/index.php";
    </script>
    <style type="text/css">
        Body{ font-size:12px; margin:0px; background:#efefef; }
        DIV.Nav{ background:url(/shixun/Public/image/nav_bg.gif) repeat-x; height:32px; }
        DIV.Nav A.Back{ color:#4e8c00; text-decoration:none; float:left; margin:10px auto auto 12px; }

        DIV.Login{ width:800px; height:450px; background:url(/shixun/Public/image/login_bg.gif) no-repeat; margin:120px auto auto auto; position:relative; }
        DIV.Tit{ position:absolute; left:325px; top:105px; font-size:18px; color:#999; font-weight:bold; }
        DIV.Login TABLE{ position:absolute; left:325px; top:130px; }
        DIV.Login TABLE TH{ width:40px; font-weight:normal;  padding:12px 12px 12px 0px; }
        DIV.Login TABLE TD{ vertical-align:middle; padding:6px 0px 0px 0px; width:203px; }
        DIV.Login TABLE tr.login td{ text-align:right; }
        DIV.Login TABLE tr.login td input{ border:none; background:url(/shixun/Public/image/btn_login.gif) no-repeat; width:59px; height:20px; cursor:pointer; }
        INPUT.txt{ border:none; width:203px; height:24px; padding:3px 6px 3px 8px; background:url(/shixun/Public/image/input_bg.gif) no-repeat; }
        .footer{ font-family:Arial; color:#CCC; position:absolute; left:430px; top:400px; width:330px; text-align:center; text-align:right; }
    </style>
</head>
<body onload="document.getElementById('txtName').focus();">


<form method="post" action="<?php echo U('Admin/login');?>" id="ctl01">
    <div class="Login">
        <div class="Tit">资源共享云平台 管理员登录</div>
        <table>
            <tr><th></th></tr>
            <tr>
                <th>用户名:</th>
                <td><input name="txtName" type="text" id="txtName"  class="txt" /></td>
            </tr>
            <tr>
                <th>密&nbsp;&nbsp;码:</th>
                <td><input name="txtPass" type="password" id="txtPass" class="txt" /></td>
            </tr>
            <tr class="login">
                <th></th>
                <td><input type="submit" name="btnLogin" value="" id="btnLogin" /></td>
            </tr>
            <tr><th></th></tr>
        </table>
        <div class="footer">copyright &copy; 2017 IMAX</div>
    </div>
</form>


</body>
</html>