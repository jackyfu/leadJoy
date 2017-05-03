var countdown=60;
var countdown1=60;

//$(function(){
$(document).ready(function(){
    // alert($("#getCode").val());
    $("#getCode").click(function (){  setTime($("#getCode"), $("#regMobile").val(), 1); });
    $("#getCode1").click(function (){  setTime($("#getCode1"), $("#resetMobile").val(),2); });
});


function setTime(obj, mobile,business) {
    $.ajax({
        type: "get",
        //rsync: false,
        url: "/api/sms/getVerifyCode",
        data: {_token: "{{csrf_token()}}", 'mobile': mobile, 'business': business},
        success:function(res){
            console.log(res);
            if(res.error==0){
                setLabel(obj);
                alert('发送成功！');
                //location.href='http://www.baidu.com';
            }else {
                alert(res.message)
            }
        }

    });
}

/**
 * @param obj
 */
function setLabel(obj){

    console.log(obj.html());  //13817366371  15221613780
    if (countdown == 0) {
        obj.removeAttr("disabled");
        obj.html("重新获取验证码");
        countdown = 60;
        return;
    } else {
        obj.attr("disabled", true);
        obj.html("重新发送(" + countdown + ")");
        countdown--;
    }
    setTimeout(function(){setLabel(obj)}, 1000);
}

/*
 $(function(){
 $("#getcode").click(function (){
 sendCode($("＃getcode"));
 });
 checkCountdown();
 })
 //校验打开页面的时候是否要继续倒计时
 function checkCountdown(){
 var secondsremained = $.cookie("secondsremained");
 if(secondsremained){
 var date = new Date(unescape(secondsremained));
 setCoutDown(date,$("#second"));
 }
 }
 //发送验证码
 function sendCode(obj){
 var phonenum = $("#phonenum").val();
 var result = isPhoneNum();
 if(result){
 //加载ajax 获取验证码的方法
 // doPostBack('${base}/login/getCode.htm',backFunc1,{"phonenum":phonenum});
 var date = new Date();
 addCookie("secondsremained",date.toGMTString(),60);//添加cookie记录,有效时间60s
 setCoutDown(date,obj);
 }
 }
 var nowDate = null;
 var time_difference = 0;
 var count_down = 0;
 function setCoutDown(date,obj) {
 nowDate = new Date();
 time_difference = ((nowDate- date)/1000).toFixed(0);
 count_down = 60 - time_difference;
 console.log(count_down);
 if(count_down<=0){
 obj.removeAttr("disabled");
 obj.val("免费获取验证码");
 addCookie("secondsremained","",60);//添加cookie记录,有效时间60s
 return;
 }
 obj.attr("disabled", true);
 obj.val("重新发送(" + count_down + ")");
 setTimeout(function() { setCoutDown(date,obj) },1000) //每1000毫秒执行一次
 }
 //发送验证码时添加cookie
 function addCookie(name,value,expiresHours){
 //判断是否设置过期时间,0代表关闭浏览器时失效
 if(expiresHours>0){
 var date=new Date();
 date.setTime(date.getTime()+expiresHours*1000);
 $.cookie(name, escape(value), {expires: date});
 }else{
 $.cookie(name, escape(value));
 }
 }
 //校验手机号是否合法
 function isPhoneNum(){
 var phonenum = $("#phonenum").val();
 var myreg = /^(1[34578]{1})+\d{9}$/;
 if(!myreg.test(phonenum)){
 alert('请输入有效的手机号码！');
 return false;
 }else{
 return true;
 }
 }
 */
