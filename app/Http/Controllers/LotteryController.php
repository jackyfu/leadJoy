<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Lottery;
use Cookie;


use App\Http\Controllers\Controller;
class LotteryController extends Controller
{

    protected $request;
    protected $response;

    const LOTTERY_KEY = 'Leadjoy-Lottery';

    public function __construct(Request $request, Response $response){
        $this->request = $request;
        $this->response = $response;
    }


    /**
     * 账号注册 验证重复和合法性（长度、字符）
     * error: 0 正常，可以抽奖 1: COOKIE异常 2:数据看记录已经抽奖 3:COOKIE 记录已经抽奖
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function anyDraw(){
        $setCookie  = false;
        $ifRate     = 0; //0 未抽奖  1 已抽奖
        if(!Cookie::get(self::LOTTERY_KEY)){
             $setCookie=true;
             $lottery_key = Cookie::make(self::LOTTERY_KEY, md5(microtime() . str_shuffle(uniqid())), 1440);
        }else{
            $lottery_key = Cookie::make(self::LOTTERY_KEY,Cookie::get(self::LOTTERY_KEY));
            $cookie_id   = Cookie::get(self::LOTTERY_KEY);
            $ifRate      = Cookie::get("ifRate");
        }

        if($this->request->ajax){
           $res = $this->rate($setCookie, $ifRate, $cookie_id);
           return response()->Json($res)->withCookie(Cookie::make('ifRate', $res['ifRate'], 1440));
        }

        if($this->request->mobile){
            return response()->Json($this->updateMobile());
        }

        //var_dump($setCookie,$_COOKIE, Cookie::get('status'));
        $data = [];

        return !$setCookie
                ? Response(view('lottery.lottery',$data))
                : Response(view('lottery.lottery',$data))->withCookie($lottery_key)->withCookie(Cookie::make('ifRate', $ifRate, 1440));

    }


    private function rate($setCookie,$ifRate,$cookie_id){
        $gift_id = $this->getGift();

        $res = ['error'=>0,'num'=>1,'ifRate'=>$ifRate,'gift_id'=>$gift_id];
        if($setCookie || $ifRate) {
            $res=['error'=> $ifRate?3:1,'ifRate'=>$ifRate,'num'=>0];

        }else{
            $user = \App\Models\Lottery::where("cookie", $cookie_id)->first();
            if($user){
                $res=['error'=>2, 'ifRate'=>$ifRate,'num'=>0];

            }else{
                \App\Models\Lottery::create(['cookie'=>$cookie_id,'mobile'=>$this->request->mobile??'',"gift_id"=>$gift_id, 'status'=>0]);
                $res = ['error'=>0,'ifRate'=>1,'num'=>0, 'gift_id'=>$gift_id];//提交成功
            }
        }
        return $res;
    }
    private function getGift(){
        $giftOn = 0;
        $ids    = [2,5];
        $today  = date("Y-m-d", time());
        $hasGiftToday = \App\Models\Lottery::whereRaw("gift_id=8 and substring(created_at,1,10)='{$today}'")->first();

        (!$hasGiftToday  && (int)date("H",time())==11) &&   $giftOn = 1;
        return $giftOn ? 8 : $ids[array_rand([2,5])];
    }

    private function updateMobile(){
        $res = ['error'=>1,'msg'=>'请填写正确的手机号，不可以重复领奖！'];
        $user = \App\Models\Lottery::where('status',0)->where("cookie", Cookie::get(self::LOTTERY_KEY))->first();
        if(preg_match("/^[1][345789]{1}[0-9]{9}$/",$this->request->mobile) &&$user){
            $user->mobile = $this->request->mobile;
            $user->status = 1;
            $user->save();
            $res = ['error'=>0,'msg'=>'恭喜您登记成功！'];
        }
        return $res;
    }
}
