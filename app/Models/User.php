<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Column
 *
 * @author fuqiwei
 *
 * @property int $user_id      用户ID
 * @property string $password  用户密码
 * @property string $username  用户名
 * @property string $mobile    用户手机号
 * @property string $email     邮箱
 * @property string $nickname  昵称
 * @property string $avatar    头像
 * @property float $balance    余额 默认 0.0
 * @property string $gender    性别 男：m  女：f  未知：x  默认：x
 * @property int $age          年龄  0
 * @property int $status       1 正常状态
 * @property int integral      用户当前积分
 * @property int $level        用户等级
 * @property string $remember_token 登录token
 * @property datetime $created_at
 * @property datetime $updated_at
 */

class User extends Model
{
    const GENDERS   =   ['m', 'f','x'];   // m：男， f：女， x：未知

    const AGE       =   0;                // 默认年龄

    const STAUTS    =   1;                // 账号状态

    const level     =   [1=>'', 2=>'幼苗',3=>'小树', 4=>'大树', 5=>'两棵树',6=>'树林',7=>'森林',8=>'大才'];

    protected $table    =   'account';

    protected $appends  =   ['error'];


    protected $cast = [
        "user_id"   => 'integer',
        "username"  => 'string',
        "mobile"    => 'string',
        "email"     => 'string',
        "nickname"  => 'string',
        "balance"   => 'float',
        "avatar"    => 'string',
        "age"       => 'integer',
        "gender"    => 'string',
        "level"     => 'integer',
        "status"    => 'integer',
        "created_at"=> 'datetime',
        "updated_at"=> 'datetime'
    ];

    protected $primaryKey = 'user_id';



    protected $hidden = [
        "password"
    ];


    protected $dataFormat   =   'U';


    protected $dates = ['created_at', 'updated_at'];


    protected $guarded = [];

    public function setPassword(string $raw): self {
        $this->password = $this->genPassword($raw);
        return $this;
    }

    public function genPassword(string $raw): string {
        return password_hash($raw, PASSWORD_BCRYPT);
    }

    public static function auth(array $auth):self {

        $func = "loginBy". ucfirst(@$auth['channel']);

        $user = self::$func($auth);

//        $user->comparePassword($auth);
        //$user = self::getByMobile($mobile);

        if (!$user->comparePassword($auth)) {
            throw new \LogicException("password compare fail when user login", 1101001);
        }

        return $user;
    }

    protected function comparePassword(array $auth){
        if (!$this->password){
            throw new \LogicException("user has not password, please login by thirdparty",110202);
        }
        return password_verify($auth['password'],$this->password);
    }

    /**
     * 使用账号和密码登录
     *
     * @param array $auth
     * @return object｜array｜mixed
     */
    protected static function loginByUsername(array $auth){
        return self::getByUsername($auth['username']);
    }

    /**
     * 使用手机号和密码登录
     *
     * @param array $auth
     * @return array
     */
    protected static function loginByMobile(array $auth) {

        return self::getByMobile($auth['mobile']);
    }

    /**
     * 使用短信验证码登录
     *
     * @param array $auth
     * @return mixed
     */
    protected static function loginBySms(array $auth) {
        return \stdClass;
    }


    /**
     * 第三方登录：weChat 微信，QQ，微博
     *
     * @param array $auth
     * @return mixed
     */
    protected static function loginByThirdparty(array $auth){

        return \stdClass;
    }


    /**
     * 通过手机号查找账号
     *
     * @param string $mobile
     * @return User
     */
    public static function getByMobile(string $mobile): self {
        $user = self::query()->where('mobile', $mobile)
            ->first();
        if (!$mobile || !$user) {
            throw new \LogicException('mobile is not exists', 1101202);
        }
        return $user;
    }

    /**
     * 通过用户名查找账号
     *
     * @param string $username
     * @return User
     */
    public static function getByUsername(string $username): self {
        $user = self::query()->where('username', $username)
            ->first();
        if (!$username || !$user) {
            throw new \LogicException('username is not exists', 1101102);
        }
        return $user;
    }

    /**
     * 通过用户名查找账号
     *
     * @param string $username
     * @return User
     */
    public static function checkMobile(string $mobile) {
        return self::query()->where('mobile', $mobile)->first();
    }

    /**
     * 通过用户名查找账号
     *
     * @param string $username
     * @return User
     */
    public static function checkUsername(string $username) {
        $username = strtolower($username);
        if(strlen($username)<6 || strlen($username)>20){
            throw new \LogicException('Illegal length of username', 1101104);
        }

        if(!preg_match('/^[a-z]{1}[a-z0-9]{5,19}$/',$username)){
            throw new \LogicException('Illegal ruler of username, begin with character , combinations of letters and numbers, ', 1101103);
        }

        $user = self::query()->where('username', $username)->first();
        if ($user) {
            throw new \LogicException('username is exists', 1101101);
        }
    }

    protected function getAgeAttribute($value){
        return $value ?: 100;
    }

    public function getErrorAttribute(){
        return $this->attributes['error'] = 0;
    }

    //路由绑定 自定查询字段，与路由匹配
    public function getRouteKeyName(){
        return 'user_id';
    }

}
