<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{

    protected $casts = [
        'id'            =>'integer',
        'dev_id'        => 'string',
        'token'         => 'string',
        'client_type'   => 'string',
        'expire'        => 'integer',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'

    ];


    protected $dates = ['created_at', 'updated_at'];

    protected $hidden = ['token'];
    //
}
