<?php
namespace App\Services;

use Lang;
use ThrowExpectation;
use App\Models\SmsCode;
use App\Models\Account;
/*
 *  test sms account
 *
 * 测试用户名:jzyy800  密码:888888
 * 测试签名:建周科技
 * //['mobile'=>'13817366371', 'code'=>"您的验证码是：1234", 'business'=>'reg']
 * //App\Services\Sms::getInstance()->send(['mobile'=>'13817366371', 'code'=>"您的验证码是：1234", 'business'=>'reg']);
 *
 * document: http://jianzhou.mydoc.io/
 */
class Sms
{
    public    static    $_instance  =   null;
    protected static    $config     =   [];
    protected static    $message    =   [];
    protected static    $debug      =   false;
    private             $business   = null;  //业务类型


    public static function getInstance(){
        if( ! (self::$_instance instanceof self )){
            self::$_instance = new self;
        }
        self::$config   = \config(env("SMS_ENV"));

        self::$debug = env('APP_ENV')=='local' ? true: false;

        return self::$_instance;
    }

    /**
     * @param array $msg  $msg=['mobile'=>13817117177, 'business'=>1, 'code'=>1234]
     * @return mixed
     */
    public  function send($msg=[]){//self::$msg = $msg;

        if(!self::$config) {
            throw new \LogicException('短信配置错误，请联系客服！ ', 1101407);
            //dd("SMS  Config Failure!");
        }

        if (!$msg  || !in_array(['mobile','business'], [array_keys($msg)])) {
            throw new \LogicException('短信请求参数错误！', 1101406);
            //dd("Have not sms msg to send!");
        }

        if(!in_array($msg['business'], SmsCode::BUSINESS)){
            throw new \LogicException('短信业务类型不存在！', 1101405);
        }
//        if ($msg['business']==1 && with(new Account)->checkMobile($msg['mobile'])){ //账号已经存在
//            throw new \LogicException('mobile is exists', 1101101);
//        }

        $check = SmsCode::checkLimit($msg['mobile'], $msg['business']);

        if($check==1){
            throw new \LogicException('验证码已经发送请稍后再试！ ', 1101402);
        }
        if($check==2){
            //throw new \LogicException('短信量已达每日发送上限，请联系客服！', 1101403);
        }

        $msg['code'] = $this->genCode();
        if($this->saveSms($msg)){
            $smsErrCode = $this->doSend($msg);
            if ($smsErrCode < 0){
                throw new \LogicException('短信发送失败，错误码: ' . $smsErrCode, 1101404);
            }
        }


    }

    protected function doSend($msg){
        $lang_pre   =   'sms.' . SmsCode::BUSINESS_KEY[$msg['business']].".";
        $expire     =   Lang::get($lang_pre . "expire");

        $post_data = array(
            "account"       => self::$config['username'], //"jzyy800",
            "password"      => self::$config["password"], //"888888",
            "destmobile"    => $msg["mobile"],   //"13817366371",
            "msgText"       => Lang::get($lang_pre."msg",
                                    ['code'=>$msg['code'], 'expire'=>$expire]) . self::$config["signature"],
                                    "sendDateTime" => ""
        );
        $res='11';
if(1||env('APP_ENV') != 'local'){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $post_data = http_build_query($post_data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_URL, self::$config['getCodeUrl']);//'http://www.jianzhou.sh.cn/JianzhouSMSWSServer/http/sendBatchMessage');

    $res = curl_exec($ch);

    curl_close($ch);
}

        return $res;
    }


    /**
     * @param $msg
     *
     * @return mixed
     */
    public  function validate($msg){
        if(self::$debug){
            //return true;
        }
        if ( !($sms=SmsCode::checkCode($msg)) ){
            throw new \LogicException('验证码不正确！'.$sms.'-'.$msg['code'], 1101401);
        }

        return $sms;
    }

    /**
     * @param $id
     */
    public function setStatus($id){
        $sms = SmsCode::where('id',$id)->first();
        if($sms){
            $sms->status = 1;
            $sms->save();
        }
    }


    /**
     * @param $sms
     * @return mixed
     */
    protected function saveSms($sms){
        return SmsCode::create($sms);
    }

    /**
     * @return int
     */
    protected function genCode(){
        return rand(1256,9812);
    }

}