<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Column
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $platform
 * @property string $openid
 * @property string $union_id
 * @property string $dev_id
 * @property string $dev_type
 * @property string $access_token
 * @property string $refresh_token
 * @property string $nickname
 * @property integer $expire_time
 * @property string $raw
 * @property datetime  $created_at
 * @property datetime $updated_at
 */
class OAuthToken extends Model
{
    const PLATFORM = ['wechat', 'qq', 'weibo'];

    protected $casts = [
        'id'            => 'integer',
        'user_id'       => 'integer',
        'platform'      => 'string',
        'openid'        => 'string',
        'union_id'      => 'string',
        'dev_id'        => 'string',
        'dev_type'      => 'string',
        'access_token'  => 'string',
        'refresh_token' => 'string',
        'nickname'      => 'string',
        'client_type'   => 'string',
        'expire_time'   => 'integer',
        'raw'           => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'

    ];

    protected $table = 'oauth_token';
    protected $dates = ['created_at', 'updated_at'];


    /**
     * @param Account $user
     * @return string
     */
    public static function setToken(Account $user,
                                    $extra=['dev_id'=>'', 'client_type'=>'', 'os'=>'', 'app'=>[]]){
        $api_token = md5($user->user_id . env('API_TOKEN_KEY') . str_random(64));
        $token = self::where("user_id", $user->user_id)->first();
        !$token && $token = new self();
        $token->user_id     = $user->user_id;
        $token->api_token   = $api_token;
        $token->dev_id      = $extra['dev_id'];
        $token->client_type = $extra['client_type'];
        $token->expire      = time() + 90*86400; //有效期 90天

        $token->save();
        return $api_token;
    }

    /**
     * @param Account $user
     * @return mixed
     */
    public function getToken(Account $user){
        return self::where('user_id', $user->user_id);
    }

}
