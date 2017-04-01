<?php
namespace App\Services;

use Lang;
use ThrowExpectation;
/*
 *  test sms account
 *
 * 测试用户名:jzyy800  密码:888888
 * 测试签名:建周科技
 *
 *
 * document: http://jianzhou.mydoc.io/
 */
class Sms
{
    public    static    $_instance  =   null;
    protected static    $config     =   [];
    protected static    $message    =   [];
    private             $business   = null;  //业务类型


    public static function getInstance(){
        if( ! (self::$_instance instanceof self )){
            self::$_instance = new self;
        }
        self::$config   = \config(env("SMS_ENV"));

        return self::$_instance;
    }

    // 验证是否合法：发送过多 、已经发送
    private function validate(){

    }
    private function saveSms(){

    }

    public  function send($msg=[]){//self::$msg = $msg;

        if(!self::$config) {
            dd("SMS  Config Failure!");
        }
        //['mobile'=>'13817366371', 'code'=>"您的验证码是：1234", 'business'=>'reg']
        //App\Services\Sms::getInstance()->send(['mobile'=>'13817366371', 'code'=>"您的验证码是：1234", 'business'=>'reg']);

        if(!$msg  || !in_array(['mobile','code','business'], [array_keys($msg)])) {

            dd("No sms msg to send!");
        }

        $ch = curl_init();
        $lang_pre   =   'sms.'.$msg['business'].".";
        $expire     =   Lang::get($lang_pre . "expire");

        $post_data = array(
            "account"       => self::$config['username'], //"jzyy800",
            "password"      => self::$config["password"], //"888888",
            "destmobile"    => $msg["mobile"],   //"13817366371",
            "msgText"       => Lang::get($lang_pre."msg", ['code'=>$msg['code'], 'expire'=>$expire]) . self::$config["signature"],
            //sprintf(self::$message[$this->businessId], $msg['code']) . self::$config["signature"],        //"6666你好【建周科技】",
            "sendDateTime" => ""
        );
dd($post_data);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);

        $post_data = http_build_query($post_data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_URL, self::$config['getCodeUrl']);//'http://www.jianzhou.sh.cn/JianzhouSMSWSServer/http/sendBatchMessage');
        $res = curl_exec($ch);

        curl_close($ch);

        return $res;
    }

}