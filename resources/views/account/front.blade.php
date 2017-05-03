<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>设置</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no,maximum-scale=1.0">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{URL::asset('assets/accountv2')}}/images/icon-72.png">
    <link rel="apple-touch-startup-image" sizes="1024x748" href="{{URL::asset('assets/accountv2')}}/images/icon-1024x748.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="stylesheet" href="{{URL::asset('assets/accountv2')}}/css/jqueryMobile.css">
    <script type="text/javascript" src="{{URL::asset('assets/accountv2')}}/js/jquery.js"></script>
    <script type="text/javascript" src="{{URL::asset('assets/accountv2')}}/js/jqueryMobile.js"></script>
    <link href="{{URL::asset('assets/accountv2')}}/css/mobiscroll.css" rel="stylesheet" type="text/css" />
    <script src="{{URL::asset('assets/accountv2')}}/js/mobiscroll.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/accountv2')}}/css/style.css">
    <script type="text/javascript" src="{{URL::asset('assets/accountv2')}}/js/date.js"></script>
    <script src="{{URL::asset('assets/accountv2')}}/js/mobiscroll_date.js" charset="utf-8"></script>
    <script type="text/javascript" src="{{URL::asset('assets/accountv2')}}/js/select.js"></script>
    <script type="text/javascript" src="{{URL::asset('assets/accountv2')}}/js/rangeslider.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/accountv2')}}/css/rangeslider.css">
</head>

<body>
<div data-role="page" id="pageLogin">
    <div data-role="header">
        <h1>用户注册</h1>
        <a href="#pageSetting" data-transition="slide" class="ui-btn ui-corner-all"><img src="{{URL::asset('assets/accountv2')}}/images/back.png" class="back"></a>
    </div>
    <div class="head"><img src="{{URL::asset('assets/accountv2')}}/images/logo.png" class="logo"/></div>

    <form action="" method="POST" name="loginForm">
    <div class="input">
        <p style="display:none;" class="notice"></p>
        <input type="text" placeholder="手机号" id="loginMobile" name="mobile" class="input-txt">
        <input type="password" placeholder="密码" id="loginPwd" name="password" class="input-txt">
    </div>
    <div class="txt">
        <div class="txt1"><a href="#pageRertieve" data-transition="slide">忘记密码</a>
        </div>
        <div class="txt2"><a href="#pageRegister" data-transition="slide">注册</a>
        </div>
    </div>
    <div class="input">
        <input type="button" id="login-submit" value="登录" class="login_btn"/>
    </div>
    </form>

    <div class="line">——————其他登录方式——————</div>
    <ul>
        <li>
            <a data-ajax="false" href="#"><img src="{{URL::asset('assets/accountv2')}}/images/QQ1.png" /></a>
        </li>
        <li>
            <a data-ajax="false" href="#"><img src="{{URL::asset('assets/accountv2')}}/images/weibo1.png" /></a>
        </li>
        <li>
            <a data-ajax="false" href="#"><img src="{{URL::asset('assets/accountv2')}}/images/weixin1.png" /></a>
        </li>
    </ul>
</div>
<div data-role="page" id="pageRegister">
    <div data-role="header">
        <h1>注册</h1>
        <a href="#pageLogin" data-transition="slide" class="ui-btn ui-corner-all"><img src="{{URL::asset('assets/accountv2')}}/images/back.png" class="back" ></a>
    </div>

    <form action="" method="post">
    <div class="input">
        <input type="text" placeholder="请输入手机号" id="regMobile" name="mobile">
        <input type="password" placeholder="输入密码" id="regPassword" name="password" >
        <input type="text" placeholder="输入验证码" id="regVcode" name="vcode" >
        <button id="getCode" type="button" class="psw_btn">获取验证码</button>
        <a href="#pageone" data-transition="slide"><input type="button" id="register-submit" value="注册" class="submit-btn" /></a>
    </div>
    <div class="footer">
        <p>我已阅读并同意<a href="#pageStatement" data-transition="slide" >隐私政策</a></p>
    </div>

    </form>
</div>
<div data-role="page" id="pageRertieve">
    <div data-role="header">
        <h1>找回密码</h1>
        <a href="#pageLogin" data-transition="slide" class="ui-btn ui-corner-all"><img src="{{URL::asset('assets/accountv2')}}/images/back.png" class="back" ></a>
    </div>
    <div class="input">
        <p style="display:none;" class="notice"></p>
        <input type="text" placeholder="请输入手机号" id="resetMobile" name="mobile" >
        <input type="password" placeholder="输入新密码" id="resetPassword" name="password">
        <input type="text" placeholder="验证码" id="resetVcode" name="vcode">
        <button type="botton" id="getCode1">获取验证码</button>
        <input type="button" value="重置密码" id="resetpwd-submit" class="submit-btn" />
    </div>
    <div class="retrieveFailed">
        <p>您的手机号还未注册</p>
        <p>快去<a data-ajax="false" href="/signup/#pageRegister">注册</a>吧</p>
    </div>
</div>


<div data-role="page" id="pageSetting">
    <div data-role="header">
        <h1>家长设置</h1>
        <a href="#pageLogin" data-transition="slide" class="ui-btn ui-corner-all"><img src="{{URL::asset('assets/accountv2')}}/images/back.png" class="back" ></a>
    </div>
    <div class="time_control">
        <p>宝宝游戏时间控制</p>
        <div class="select">
            <input type="range" min="10" max="60" value="30" step="10"  data-highlight="true">
            <input type="submit"  id="time_btn" value="确定" >
        </div>
    </div>
    <div class="user-ui-btn" data-role="controlgroup">
        <a data-role="button" data-iconpos="top" class="setting_text">心理帮助</a>
        <a data-role="button" data-iconpos="top"  class="setting_text">宝宝商店</a>
        <a data-role="button" data-iconpos="top"  class="setting_text">分享</a>
        <a data-role="button" data-iconpos="top"  class="setting_text">ps</a>
    </div>
    <div class="footer">
        <div class="login_bx" id="login_bx">
            <a href="#pageLogin" data-role="button">登录</a>
        </div>
        <div class="quit_bx" id="quit_bx">
            <input type="button" class="quit_btn" id="quit" value="退出登录"></p>
        </div>
    </div>
</div>



<div data-role="page" id="pageone">
    <div data-role="header" id="top">
        <h1>宝宝信息</h1>
        <a href="#pageLogin" data-transition="slide" class="ui-btn ui-corner-all"><img src="{{URL::asset('assets/accountv2')}}/images/back.png" class="back" ></a>
    </div>
    <div data-role="content">
        <form>
            <div class="pic_logo"><img src="{{URL::asset('assets/accountv2')}}/images/monkey_logo.png" class="pic"/></div>
            <p>宝宝姓名</p>
            <input type="text" id="baby_name"  />
            <p>宝宝的性别</p>
            <select id="sex" name="baby_sex" data-native-menu="false">
                <option selected></option>
                <option id="1" value="1">男孩</option>
                <option id="2" value="2">女孩</option>
            </select>
            <p>我是宝宝的</p>
            <select id="parents" name="baby_parents" data-native-menu="false">
                <option selected></option>
                <option id="3" value="3">父亲</option>
                <option id="4" value="4">母亲</option>
            </select>
            <!-- 日期插件 -->
            <p>宝宝的生日</p>
            <input type="text" data-role="datebox" id="txtBirthday" name="txtBirthday" />
            <p> </p>
            <input type="submit" value="提交" id="btnSubmit"  class="submit_btn" onClick="messageCheck()"/>
        </form>
    </div>
</div>
</div>
<div data-role="page" id="pageStatement">
    <div data-role="header" id="top">
        <h1 >隐私政策</h1>
        <a href="#pageRegister" data-transition="slide" class="ui-btn ui-corner-all"><img src="{{URL::asset('assets/accountv2')}}/images/back.png" class="back" ></a>
    </div>
    <div class="statement"><p>
            悠优互娱尊重并保护所有使用服务用户的个人隐私权。为了给您提供更准确、更有个性化的服务，悠优互娱会按照本隐私权政策的规定使用和披露您的个人信息。但悠优互娱将以高度的勤勉、审慎义务对待这些信息。除本隐私权政策另有规定外，在未征得您事先许可的情况下，悠优互娱不会将这些信息对外披露或向第三方提供。悠优互娱会不时更新本隐私权政策。 您在同意悠优互娱服务使用协议之时，即视为您已经同意本隐私权政策全部内容。本隐私权政策属于悠优互娱服务使用协议不可分割的一部分。</p>
        <h2>1.	适用范围</h2>
        <p>a) 在您注册悠优互娱帐号时，您根据悠优互娱要求提供的个人注册信息；
        <p>b) 在您使用悠优互娱网络服务，或访问悠优互娱平台网页时，悠优互娱自动接收并记录的您的浏览器和计算机上的信息，包括但不限于您的IP地址、浏览器的类型、使用的语言、访问日期和时间、软硬件特征信息及您需求的网页记录等数据；</p>
        <p>c) 悠优互娱通过合法途径从商业伙伴处取得的用户个人数据。</p>
        <p>您了解并同意，以下信息不适用本隐私权政策：</p>
        <p>a) 您在使用悠优互娱平台提供的搜索服务时输入的关键字信息；</p>
        <p>b) 悠优互娱收集到的您在悠优互娱发布的有关信息数据，包括但不限于参与活动、成交信息及评价详情；</p>
        <p>c) 违反法律规定或违反悠优互娱规则行为及悠优互娱已对您采取的措施。</p>
        <h2>2.	信息使用  </h2>
        <p>a) 悠优互娱不会向任何无关第三方提供、出售、出租、分享或交易您的个人信息，除非事先得到您的许可，或该第三方和悠优互娱（含悠优互娱关联公司）单独或共同为您提供服务，且在该服务结束后，其将被禁止访问包括其以前能够访问的所有这些资料。</p>
        <p>b) 悠优互娱亦不允许任何第三方以任何手段收集、编辑、出售或者无偿传播您的个人信息。任何悠优互娱平台用户如从事上述活动，一经发现，悠优互娱有权立即终止与该用户的服务协议。</p>
        <p>c) 为服务用户的目的，悠优互娱可能通过使用您的个人信息，向您提供您感兴趣的信息，包括但不限于向您发出产品和服务信息，或者与悠优互娱合作伙伴共享信息以便他们向您发送有关其产品和服务的信息（后者需要您的事先同意）。</p>
        <h2>3.	信息披露   </h2>
        <p>在如下情况下，悠优互娱将依据您的个人意愿或法律的规定全部或部分的披露您的个人信息： </p>
        <p>a) 经您事先同意，向第三方披露；</p>
        <p>b) 为提供您所要求的产品和服务，而必须和第三方分享您的个人信息；</p>
        <p>c) 根据法律的有关规定，或者行政或司法机构的要求，向第三方或者行政、司法机构披露；</p>
        <p>d) 如您出现违反中国有关法律、法规或者悠优互娱服务协议或相关规则的情况，需要向第三方披露；</p>
        <p>e) 如您是适格的知识产权投诉人并已提起投诉，应被投诉人要求，向被投诉人披露，以便双方处理可能的权利纠纷；</p>
        <p>f) 在悠优互娱平台上创建的某一交易中，如交易任何一方履行或部分履行了交易义务并提出信息披露请求的，悠优互娱有权决定向该用户提供其交易对方的联络方式等必要信息，以促成交易的完成或纠纷的解决。</p>
        <p>g) 其它悠优互娱根据法律、法规或者网站政策认为合适的披露。</p>
        <h2>4.	信息存储和交换 </h2>
        <p>悠优互娱收集的有关您的信息和资料将保存在悠优互娱及（或）其关联公司的服务器上，这些信息和资料可能传送至您所在国家、地区或悠优互娱收集信息和资料所在地的境外并在境外被访问、存储和展示。</p>
        <h2>5.	Cookie的使用 </h2>
        <p>a) 在您未拒绝接受cookies的情况下，悠优互娱会在您的计算机上设定或取用cookies ，以便您能登录或使用依赖于cookies的悠优互娱平台服务或功能。悠优互娱使用cookies可为您提供更加周到的个性化服务，包括推广服务。  </p>
        <p>b) 您有权选择接受或拒绝接受cookies。您可以通过修改浏览器设置的方式拒绝接受cookies。但如果您选择拒绝接受cookies，则您可能无法登录或使用依赖于cookies的悠优互娱网络服务或功能。</p>
        <p>c) 通过悠优互娱所设cookies所取得的有关信息，将适用本政策。</p>
        <h2>6.	信息安全  </h2>
        <p>a) 悠优互娱帐号均有安全保护功能，请妥善保管您的用户名及密码信息。悠优互娱将通过对用户密码进行加密等安全措施确保您的信息不丢失，不被滥用和变造。尽管有前述安全措施，但同时也请您注意在信息网络上不存在“完善的安全措施”。</p>
        <p>b) 在使用悠优互娱网络服务进行网上交易时，您不可避免的要向交易对方或潜在的交易对
            方披露自己的个人信息，如联络方式或者邮政地址。请您妥善保护自己的个人信息，仅在必要的情形下向他人提供。如您发现自己的个人信息泄密，尤其是悠优互娱用户名及密码发生泄露，请您立即联络悠优互娱客服，以便悠优互娱采取相应措施。
        </p>
    </div>
</div>
<script src="{{URL::asset('assets')}}/common/js/hitMessage.js"></script>
<script type="text/javascript">
    $("#login-submit").click(function(){
        $.ajax({
            type: "POST",
            url: "/login",
            rsync: false,
            data: {_token: "{{csrf_token()}}", 'mobile': $('#loginMobile').val(), 'password': $('#loginPwd').val()},
            success:function(res){
                console.log(res);
                if(res.error==0){
                    //alert('登录成功！');
                    //location.href='/signup/pageSetting';
                    //location.href='/api/account/getToken?api_token='+res.api_token;
                    window.getUserInfo.actionFromJsWithParam(res.api_token);

                }else {
                    alert(res.message)
                }
            }

        });
        return false;
    });

    $("#register-submit").click(function(){
        $.ajax({
            type: "POST",
            url: "/signup",
            data: {_token: "{{csrf_token()}}", 'mobile': $('#regMobile').val(), 'password': $('#regPassword').val(),'vcode': $('#regVcode').val()},
            success:function(res){
                //alert(res.message);
                console.log(res);
                if(res.error==0){
                    alert("注册成功，去登录账号吧！");
                    location.href='/signup/#pageLogin';
                    //location.href='/login';
                }else {
                    alert(res.message)
                }
             }
        });
        return false;
    });

    $("#resetpwd-submit").click(function(){
        $.ajax({
            type: "POST",
            url: "/resetpwd",
            data: {_token: "{{csrf_token()}}", 'mobile': $('#resetMobile').val(), 'password': $('#resetPassword').val(),'vcode': $('#resetVcode').val()},
            success:function(res){
                //alert(res.message);
                console.log(res);
                if(res.error==0){
                    alert(res.message);
                    location.href='/signup';
                    //location.href='/login';
                }else {
                    alert(res.message)
                }
            }
        });
        return false;
    });
</script>
</body>
</html>
