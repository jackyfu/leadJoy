<!DOCTYPE html>
<html lang="en">
<head>
    <title>Leadjoy － 登录</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=@yield('scalable', 'yes')" >
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name = "format-detection" content = "telephone=no">
    <script src="//cdn.bootcss.com/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/login.css">
    <script>
        function getFocus(obj){
            obj.className = 'input-txt input-focus';
        }
        function loseFocus(obj){
            obj.className = 'input-txt';
        }
    </script>
</head>
<body>
<div>
    <div class="head">
        <div class="head1"><img src="/assets/images/logo.png" /></div>
        <div class="head2"><a href="/login">登录</a> / <a href="/signup">注册</a></div>
    </div>
    <div>
        <div class="input">
            <p style="display:none;" class="notice"></p>
            <form action="" method="post">
                {{csrf_field()}}
                <input type="text" placeholder="请输入用户名" id="username" name="username" class="input-txt" onfocus="getFocus(this);" onblur="loseFocus(this);">
                <input type="password" placeholder="请输入密码" id="password" name="password" class="input-txt" onfocus="getFocus(this);" onblur"loseFocus(this);">
                <input type="submit" style="color:#ffffff; height:30px; width:75%; background: #14aebd;" value="登录" class="submit-btn" />
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
$(".submit-btn").click(function(){
    $.ajax({
        type: "POST",
        url: "/login",
        data: {_token: "{{csrf_token()}}", 'username': $('#username').val(), 'password': $('#password').val()},
        success:function(res){
            if(res.error==0){
                location.href='http://www.baidu.com';
            }else {
                alert(res.message)
            }
            console.log(res);
        }


    })
    return false;

});

</script>
</body>
</html>
