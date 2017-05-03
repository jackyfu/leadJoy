<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Column
 *
 *
 * @property int      $id      ID
 * @property string   $mobile    用户手机号
 * @property integer  $code
 * @property integer  $status
 * @property int      $business       注册／找回密码等
 * @property datetime $created_at
 * @property datetime $updated_at
 */

class SmsCode extends Model{
    const EXPIRE_IN     =  5*60;//验证码有效期
    const LIMIT_PER_MINUTE  = 60; // 短信发送间隔秒数;
    const LIMIT_PER_DAY     = 3;  //每个业务类型每天最高发送数量
    const BUSINESS          = [1, 2];// 1;//注册业务  2:重置密码业务
    const BUSINESS_KEY      = [1=>'reg', 2=>'resetpwd'];// 1;//注册业务  2:重置密码业务

    protected $table    =   'sms_code';

    protected $appends  =   ['error'];


    protected $cast = [
        "id"   => 'integer',
        "mobile"    => 'string',
        "code"      => 'integer',
        "business"  => 'integer',
        "status"    =>  'integer',
        "created_at"=> 'datetime',
        "updated_at"=> 'datetime'
    ];

    /**
     * @var integer
     */
    protected $primaryKey = 'id';


    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $guarded = [];

    public function genCookie(): self
    {
        $this->cookie = '';//$this->genPassword($raw);
        return $this;
    }

    // 1 验证码已经发送，稍后在尝试， 2 已经达到每日上限   0 可以发送
    public static function checkLimit(int $mobile, int $business){
        $date = date("Y-m-d", time());
        $return = 0;

        $count = self::where(['mobile'=>$mobile, "business"=>$business])
                ->whereBetween('created_at',[$date." 00:00:00", $date." 23:59:59"])->get()->count();
        $res = self::where(['mobile'=>$mobile, "business"=>$business, "status"=>0])->orderBy('id', 'desc')->first();
        $count>=self::LIMIT_PER_DAY && $return = 2;

        $res && (time() - strtotime($res->created_at))<=self::LIMIT_PER_MINUTE && $return = 1;
        return $return;
    }

    public static function checkCode($msg){ //$msg=['mobile'=>1111, 'business'=>1, 'code'=>2345];
        extract($msg);
        $return = false;

        $res = self::where(['mobile'=>$mobile, "business"=>$business, "status"=>0])->orderBy('id', 'DESC')->first();

        $checkExpire = $res ? time() - strtotime($res->created_at) : 10000000;
        if($res && $checkExpire<self::EXPIRE_IN){
            $return = ($res->code==$code);
        }

        $return && $return = $res->id;
        return $return;
    }


    protected function compareCookie($cookie){
        if (!$this->cookie){
            throw new \LogicException("user has not password, please login by thirdparty",110202);
        }
    }


    public function getErrorAttribute(){
        return $this->attributes['error'] = 0;
    }

}
