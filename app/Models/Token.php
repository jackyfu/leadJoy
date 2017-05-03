<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Column
 *
 * @property int      $id      ID
 * @property integer   $user_id
 * @property string   $dev_id
 * @property string   $api_token
 * @property string   $client_type
 * @property integer  $expire
 * @property datetime $created_at
 * @property datetime $updated_at
 */
class Token extends Model
{

    protected $casts = [
        'id'            => 'integer',
        'user_id'       => 'integer',
        'dev_id'        => 'string',
        'api_token'     => 'string',
        'client_type'   => 'string',
        'expire'        => 'integer',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'

    ];

    protected $table = 'token';
    protected $dates = ['created_at', 'updated_at'];

    //protected $hidden = ['token'];
    //

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
     * @param mixed $user
     * @return mixed
     */
    public function getToken($user){
        return self::where('user_id', $user->user_id)->first();
    }

    /**
     * @param $user
     * @return mixed
     */
    public function getUserInfo($user){
        return Account::where('user_id', $user->user_id)->first();
    }

}
