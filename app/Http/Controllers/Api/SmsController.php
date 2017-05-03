<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Services\Sms;
use App\Models\Account;

class SmsController extends Controller
{

    /**
     * 账号注册 验证重复和合法性（长度、字符）
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function verifyCode(){

        $mobile     = trim($this->request->mobile);
        $business   = (int)$this->request->business;

//        if( !$mobile){
//            throw new \LogicException('手机号不能为空！', 11);
//        }
//
//        if (strlen($mobile) != 11 ){
//            throw new \LogicException('Illegal length of mobile', 12);
//        }

        //此验证已经包含上面两个
        if(!preg_match('/^[1][34578]{1}[0-9]{9}$/',$mobile)){
            throw new \LogicException('Illegal ruler of mobile, begin with 1, combinations of  numbers, ', 1101203);
        }
        if ($business==1 && with(new Account)->checkMobile($mobile)){ //注册验证账号是否存在
            throw new \LogicException('mobile is exists', 1101101);
        }

        if ($business==2 && !(with(new Account)->checkMobile($mobile))){ //重置密码 验证账号是否存在
            throw new \LogicException('账号不存在！', 1101102);
        }

        Sms::getInstance()->send(['mobile'=>$mobile,'business'=>$business]);

        return response()->json(['error'=>0,"message"=>'发送成功！']);
    }

//    public function send(){
//
//    }
}
