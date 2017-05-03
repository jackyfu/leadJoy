<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\{Account, Token, OpwAuthToken};


class AccountController extends Controller
{


    public function getToken(){
        $token = new Token();
        $user = $this->request->user();
        //return response()->Json(['error'=>0, 'api_token'=>$this->request->api_token,$user]);
        $userInfo = $token->getUserInfo($user);

        return response()->Json([
                                'error'=>0,
                                'api_token'=>$this->request->api_token,
                                'data'=>['user'=> $userInfo]
        ]);
    }



}
