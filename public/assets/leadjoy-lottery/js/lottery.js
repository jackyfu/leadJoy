var wxshare;
var xbshare;

//����
function sendInfoToJava(messagetype){
    var userid = '<%=session.getAttribute("userid")%>';
    //�������̨��ȡ΢����΢�ŵķ��������������ʾ�û��Ƿ�����
    $.ajax({
        url:"http://192.168.4.66/app/getShareNum.do?useid="+userid+"",
        type:"get",
        dataType:"json",
        success:function(data){
            wxshare = parseInt(data.wx_count);//΢�ŷ������ ÿ���ʼֵΪ0 0û����� >0����ʾ�����
            wbshare = parseInt(data.wb_count);//΢��������� 
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
            alert("�����ѷ��������Ȧ");//���������Ϊ0��ʱ�� ������ʾ�û������Ѿ���������ٴη�����ӳ齱������
        }
        Data  = weixinjson;
    }else if(messagetype == "wb"){
        if(wbshare != 0){
            alert("�����ѷ����΢��");
        }
        Data = weibojson;
    }

    var ua = navigator.userAgent.toLowerCase();
    if (/iphone|ipad|ipod/.test(ua)) {
        nativeNanyikuShareMessage(Data);  //ios����
    } else if (/android/.test(ua)) {
        window.AndroidWebView.nativeNanyikuShareMessage(Data); //Android����

    }
     
}

    
//����ɹ��ص�����
function shareWeixinCallback(isOK,errorString){
    
      if (isOK) {
          if(wxshare == 0){
             $.ajax({
                url:"http://192.168.4.66/app/share.do?userid="+userid+"&type=1",//type=1��ʾ΢�ŷ���
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

//����ɹ��ص�����
function shareWeiboCallback(isOK,errorString){
     if (isOK) { 
           if(wbshare == 0){
                    
                $.ajax({
                    url:"http://192.168.4.66/app/share.do?userid="+userid+"&type=2",//type=2��ʾ΢�ŷ���
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

//ҳ���ʼ��ʱִ�еķ��������ڻ�ȡ�齱����
$(function(){
    var userid = '<%=session.getAttribute("userid")%>';
    //�����̨��ȡ�齱����num
    $.ajax({
        url:"http://192.168.4.66/app/getShareNum.do?useid="+userid+"",
        type:"get",
        dataType:"json",
        success:function(data){
            var num = parseInt(data.num);
            $("#num").text(num);//���齱����д����ҳ��
        }
    });

    var $plateBtn = $('#plateBtn');
    var $result = $('#result');
    var $resultTxt = $('#resultTxt');
    var $resultBtn = $('#resultBtn');
    
    //���ת�̰�ťʱִ�еķ���
    $plateBtn.click(function(){
        var userid = '<%=session.getAttribute("userid")%>';
        //��ȡ��ҳ�ϳ齱����
        var numDom=document.getElementById("num");
        var numVal=parseInt(numDom.innerHTML);
        console.log(numVal);
        //�齱��������0ʱ�� �����̨�ӿڣ���̨�����н����result �� ���³齱����num
        if(numVal>0){
           // $.ajax({
//                url:"http://192.168.4.66/app/getLottery.do?useid="+userid+"",
//                type:"get",
//                dataType:"json",
//                success: function(data){
//                    var lotterynum = parseInt(data.num);//�����н�����
//                    $("#num").text(lotterynum);//д����ҳ��ȥ
//                    var result = parseInt(data.result);//�н����
                    switch(5){
                        case 0:
                            rotateFunc(0,10,'');//100Ԫ����
                            break;
                        case 1:
                            rotateFunc(1,330);//50Ԫ����
                            break;
                        case 2:
                            rotateFunc(2,270);//лл����
                            break;
                        case 3:
                            rotateFunc(3,230);//500M����
                            break;
                        case 4:
                            rotateFunc(4,180);//100Ԫ����
                            break;
                        case 5:
                            rotateFunc(5,166);//лл����
                            break;
                        case 6:
                            rotateFunc(6,120);//50Ԫ����
							break;
						case 7:
                            rotateFunc(7,70);//500M����
							break;
						case 8:
                            rotateFunc(8,33);//��ͯͼ��
                            break;
                        default:
                            rotateFunc(0,10);//δ�н�
                    }
//                }
//            });
        }else{
            alert("����û�г齱������Ŷ���������ԣ�");
        }
    });
    
    //ָ��ת������
    var rotateFunc = function(awards,angle){
        $plateBtn.stopRotate();
        $plateBtn.rotate({
            angle: 0,
            duration: 5000,
            animateTo: angle + 1440,
            callback: function(){
                //�����н���ŵ�������
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
    // ���������
    $(document).on('click','.sharebtn',function(){
        $('#sharediolog').css('display','block');
        $('.dialogbg').css('display','block');
    });
    // ������û�н�,������ʧ
    $('.prize-diologimg .btn').click(function(){
        $('#sharediolog').css('display','none');
        $('#noprize-diolog').css('display','none');
        $('.dialogbg').css('display','none');
        // $('#prize-diologwy').css('display','none');
        // $('#prize-diologsy').css('display','none');
    });
    // �콱�������
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
	
	// �콱��������ȷ����ȡ��
    $('#surebtn').click(function(){
        $('.getprize-diolog').css('display','none');
        $('.dialogbg').css('display','none');
    });
      $('#abandon').click(function(){
        $('.getprize-diolog').css('display','none');
        $('.dialogbg').css('display','none');
    });
});

// // �齱��������
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

