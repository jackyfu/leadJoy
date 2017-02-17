<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class SignupController extends Controller
{

    /**
     * 账号注册 验证重复和合法性（长度、字符）
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function anyIndex(){

        if($this->request->username){
            $user = new User;
            $user->username = $this->request->username;
            $user->checkUsername($this->request->username);

            $user->setPassword($this->request->password);
            $user->save();
            return response()->Json(['error'=>0,"message"=>$user->user_id]);
        }

        return view('signup.register'); //'register';
    }


    /**
     * 登录
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function anyLogin(){

        if($this->request->username){
            $user = new User;
            $auth['channel']        =   'username';
            $auth[$auth['channel']] = $this->request->username;
            $auth['password']       = $this->request->password;

            $res = $user->auth($auth);

            return response()->Json($res);
        }

        return view('signup.login');//'Login';
    }
}