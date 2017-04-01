var wxshare;
var xbshare;

//分享
function sendInfoToJava(messagetype){
    var userid = '<%=session.getAttribute("userid")%>';
    //先请求后台获取微博和微信的分享次数，用于提示用户是否分享过
    $.ajax({
        url:"http://192.168.4.66/app/getShareNum.do?useid="+userid+"",
        type:"get",
        dataType:"json",
        success:function(data){
            wxshare = parseInt(data.wx_count);//微信分享次数 每天初始值为0 0没分享过 >0都表示分享过
            wbshare = parseInt(data.wb_count);//微博分享次数 
        }
    });

    var weixinobj = new Object();
    weixinobj.action = "share_weixin_msg";
    weixinobj.title = "titlexxxx";
    weixinobj.description = "descrxxxx";
    weixinobj.pic_url = "https://img.alicdn.com/imgextra/i4/2070193057/TB2.w8slpXXXXamXXXXXXXXXXXX_%21%212070193057.jpg";
    weixinobj.page_url = "http://www.baidu.com";
    weixinobj.js_share_callback = "shareWeiboCallback";
    var weixinjson = JSON.stringify(weixinobj);

    var weiboobj = new Object();
    weiboobj.action = "share_weibo_msg";
    weiboobj.title = "titlexxxx";
    weiboobj.description = "descrxxxx";
    weiboobj.pic_url = "https://img.alicdn.com/imgextra/i4/2070193057/TB2.w8slpXXXXamXXXXXXXXXXXX_%21%212070193057.jpg";
    weiboobj.page_url = "http://www.baidu.com";
    weiboobj.js_share_callback = "shareWeiboCallback";
    var weibojson = JSON.stringify(weiboobj);

    var Data;
    if(messagetype == "wx"){
        if(wxshare != 0){
            alert("当天已分享过朋友圈");//分享次数不为0的时候 弹框提示用户今天已经分享过，再次分享不会加抽奖次数。
        }
        Data  = weixinjson;
    }else if(messagetype == "wb"){
        if(wbshare != 0){
            alert("当天已分享过微博");
        }
        Data = weibojson;
    }

    var ua = navigator.userAgent.toLowerCase();
    if (/iphone|ipad|ipod/.test(ua)) {
        nativeNanyikuShareMessage(Data);  //ios方法
    } else if (/android/.test(ua)) {
        window.AndroidWebView.nativeNanyikuShareMessage(Data); //Android方法

    }
     
}

    
//分享成功回调函数
function shareWeixinCallback(isOK,errorString){
    
      if (isOK) {
          if(wxshare == 0){
             $.ajax({
                url:"http://192.168.4.66/app/share.do?userid="+userid+"&type=1",//type=1标示微信分享
                type:"get",
                dataType:"json",
                success:function(data){
                    location.reload();
                }
             });
          }
      } else {
            alert("share failed:"+errorString);
      }
}

//分享成功回调函数
function shareWeiboCallback(isOK,errorString){
     if (isOK) { 
           if(wbshare == 0){
                    
                $.ajax({
                    url:"http://192.168.4.66/app/share.do?userid="+userid+"&type=2",//type=2标示微信分享
                    type:"get",
                    dataType:"json",
                    success:function(data){
                         location.reload();
                    }
                });
            }

     } else {
            alert("share failed:"+errorString);
     }
} 

//页面初始化时执行的方法，用于获取抽奖次数
$(function(){
    var userid = '<%=session.getAttribute("userid")%>';
    //请求后台获取抽奖次数num
    $.ajax({
        url:"http://192.168.4.66/app/getShareNum.do?useid="+userid+"",
        type:"get",
        dataType:"json",
        success:function(data){
            var num = parseInt(data.num);
            $("#num").text(num);//将抽奖次数写到网页上
        }
    });

    var $plateBtn = $('#plateBtn');
    var $result = $('#result');
    var $resultTxt = $('#resultTxt');
    var $resultBtn = $('#resultBtn');
    
    //点击转盘按钮时执行的方法
    $plateBtn.click(function(){
        var userid = '<%=session.getAttribute("userid")%>';
        //获取网页上抽奖次数
        var numDom=document.getElementById("num");
        var numVal=parseInt(numDom.innerHTML);
        console.log(numVal);
        //抽奖次数大于0时， 请求后台接口，后台返回中奖序号result 和 最新抽奖次数num
        if(numVal>0){
           // $.ajax({
//                url:"http://192.168.4.66/app/getLottery.do?useid="+userid+"",
//                type:"get",
//                dataType:"json",
//                success: function(data){
//                    var lotterynum = parseInt(data.num);//最新中奖次数
//                    $("#num").text(lotterynum);//写到网页上去
//                    var result = parseInt(data.result);//中奖序号
                    switch(5){
                        case 0:
                            rotateFunc(0,10,'');//100元话费
                            break;
                        case 1:
                            rotateFunc(1,330);//50元花费
                            break;
                        case 2:
                            rotateFunc(2,270);//谢谢参与
                            break;
                        case 3:
                            rotateFunc(3,230);//500M流量
                            break;
                        case 4:
                            rotateFunc(4,180);//100元话费
                            break;
                        case 5:
                            rotateFunc(5,166);//谢谢参与
                            break;
                        case 6:
                            rotateFunc(6,120);//50元话费
							break;
						case 7:
                            rotateFunc(7,70);//500M流量
							break;
						case 8:
                            rotateFunc(8,33);//儿童图书
                            break;
                        default:
                            rotateFunc(0,10);//未中奖
                    }
//                }
//            });
        }else{
            alert("好像没有抽奖机会了哦，分享试试！");
        }
    });
    
    //指针转动方法
    var rotateFunc = function(awards,angle){
        $plateBtn.stopRotate();
        $plateBtn.rotate({
            angle: 0,
            duration: 5000,
            animateTo: angle + 1440,
            callback: function(){
                //根据中奖序号弹出弹框
                 switch(awards){
                        case 0:
                            $('#prize-diologsy100').css('display','block');
                            break;
                        case 1:
                            $('#prize-diologsy50').css('display','block');
                            break;
                        case 2:
                            $('#noprize-diolog').css('display','block');
                            break;
                        case 3:
                            $('#prize-diologsy500').css('display','block');
                            break;
                        case 4:
                            $('#pprize-diologsy100').css('display','block');
                            break;
                        case 5:
                            $('#noprize-diolog').css('display','block');;
                            break;
                        case 6:
                            $('#prize-diologsy50').css('display','block');
                            break;
						 case 7:
                            $('#prize-diologsy500').css('display','block');
                            break;
						case 8:
                            $('#prize-diologwy').css('display','block');
                            break;
                        default:
                            $('#noprize-diolog').css('display','block');
                    }

            }
        });
    };

    // var jumpFunc = function(){
    //     var userid = '<%=session.getAttribute("userid")%>';
    //     setTimeout(function(){
    //         window.location.href="http://app.booea.cn:8181/site/index.jsp?useid="+userid+"";
    //     },6000);
    // };

    // $resultBtn.click(function(){
    //     $result.hide();
    // });
    // 分享弹框出现
    $(document).on('click','.sharebtn',function(){
        $('#sharediolog').css('display','block');
        $('.dialogbg').css('display','block');
    });
    // 分享弹框，没中奖,遮罩消失
    $('.prize-diologimg .btn').click(function(){
        $('#sharediolog').css('display','none');
        $('#noprize-diolog').css('display','none');
        $('.dialogbg').css('display','none');
        // $('#prize-diologwy').css('display','none');
        // $('#prize-diologsy').css('display','none');
    });
    // 领奖弹框出现
    $('.prize-diologimg #getprizewybtn').click(function(){
        $('.getprize-diolog').css('display','block');
        $('.dialogbg').css('display','block');
        $('#prize-diologwy').css('display','none');
    });
    $('.prize-diologimg #getprizeybtn').click(function(){
        $('.getprize-diolog').css('display','block');
        $('.dialogbg').css('display','block');
        $('#prize-diologsy').css('display','none');
    });
	 
	 
	 $('.prize-diologimg #getprizewybtn50').click(function(){
        $('.getprize-diolog').css('display','block');
        $('.dialogbg').css('display','block');
        $('#prize-diologsy50').css('display','none');
    });
		 $('.prize-diologimg #getprizewybtn100').click(function(){
        $('.getprize-diolog').css('display','block');
        $('.dialogbg').css('display','block');
        $('#prize-diologsy100').css('display','none');
    });
         $('.prize-diologimg #getprizewybtn500').click(function(){
        $('.getprize-diolog').css('display','block');
        $('.dialogbg').css('display','block');
        $('#prize-diologsy500').css('display','none');
    });
	
	// 领奖弹框里面确定和取消
    $('#surebtn').click(function(){
        $('.getprize-diolog').css('display','none');
        $('.dialogbg').css('display','none');
    });
      $('#abandon').click(function(){
        $('.getprize-diolog').css('display','none');
        $('.dialogbg').css('display','none');
    });
});

// // 抽奖名单滚动
//  function GetListItems() {  
//     $.ajax({  
//         type: "POST",  
//         url: "/JsonService/GetItems",  
//         contentType: "application/json; charset=utf-8",  
//         data: "{}",  
//         dataType: "json",  
//         success: function (result) {  
//             DisplayListItems(result);  
//         },  
//         "error": function (result) {  
//             var response = result.responseText;  
//             alert('Error loading: ' + response);  
//         }  
//     });  
// }  



function autoScroll(obj){  
      $(obj).find("ul").animate({  
                marginTop : "-39px"  
           },500,function(){  
                $(this).css({marginTop : "0px"}).find("li:first").appendTo(this);  
           })  
}  


$(function(){  
      setInterval('autoScroll(".maquee")',3000);   
}) 

