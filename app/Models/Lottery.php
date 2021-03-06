<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Column
 *
 *
 * @property int      $id      ID
 * @property string   $cookie
 * @property string   $mobile    用户手机号
 * @property integer  $gift_id   
 * @property int      $status       0 未领取，1 已领取
 * @property datetime $created_at
 * @property datetime $updated_at
 */

class Lottery extends Model
{

    protected $table    =   'lottery';

    protected $appends  =   ['error'];


    protected $cast = [
        "id"   => 'integer',
	    "cookie"	=> 'string',
        "mobile"    => 'string',
        "gift_id"   => 'integer',
        "status"    => 'integer',
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



    protected function compareCookie($cookie){
        if (!$this->cookie){
            throw new \LogicException("user has not password, please login by thirdparty",110202);
        }
    }


    public function getErrorAttribute(){
        return $this->attributes['error'] = 0;
    }

}
