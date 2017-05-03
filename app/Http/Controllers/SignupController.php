<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Sms;

use App\Models\{User,Account,Token};
/**
 * @SWG\Swagger(
 *   @SWG\Info(
 *     title="My first swagger documented API",
 *     version="1.0.0"
 *   )
 * )
 */
class SignupController extends Controller
{
    /**
     * 账号注册 验证重复和合法性（长度、字符）
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function anyIndex(){

        if($this->request->isMethod('post') ||$this->request->mobile || $this->request->password){
            $mobile = trim($this->request->mobile);

            if( !$this->request->mobile || !$this->request->password || !(int)$this->request->vcode){
                throw new \LogicException('账号、密码、验证码不能为空！', 1100001);
            }

            //if ($this->request->isMethod('post') ) throw new \LogicException('xxx'.$this->request->isMethod('post') , 22);

            if(strlen((int)$this->request->vcode) !=4){ //验证码的格式错误
                throw new \LogicException('请填写正确的验证码！', 1101401);
            }

//            if (strlen($mobile) != 11 ){ //下面的严重已经包含这个
//                throw new \LogicException('Illegal length of mobile', 1101104);
//            }

            if(!preg_match('/^[1][34578]{1}[0-9]{9}$/', $mobile)){
                throw new \LogicException('Illegal ruler of mobile, begin with 1, combinations of  numbers, ', 1101203);
            }

            $sms_id = Sms::getInstance()->validate(['mobile'=>$mobile,'business'=>1, 'code'=>(int)$this->request->vcode]);

            $user = new Account;
            $user->mobile = $mobile;
            //$user->checkUsername($this->request->mobile);
            if ($user->checkMobile($mobile)){ //账号已经存在  1101101/1101201
                throw new \LogicException('mobile is exists', 1101101);
            }

            $user->setPassword($this->request->password);
            $user->save();

            Sms::getInstance()->setStatus($sms_id);
            return response()->Json(['error'=>0,"message"=>$user->user_id]);
        }

        //return view('signup.register'); //'register';
        return view('account.front');
    }


    /**
     * 登录
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function anyLogin(){
        if($this->request->mobile){
            $user = new Account;
            $auth['channel']        =   'mobile';
            $auth[$auth['channel']] = $this->request->mobile;
            $auth['password']       = $this->request->password;

            $res = $user->auth($auth);

            $api_token = Token::setToken($res);

            return response()->Json(['error'=>0, 'api_token'=>$api_token, 'data'=>$res]);
        }

        return view('signup.login');//'Login';
    }

    public  function resetPwd(){
        $mobile   = trim($this->request->mobile);
        $password = trim($this->request->password);

        if(!preg_match('/^[1][34578]{1}[0-9]{9}$/', $mobile)){
            throw new \LogicException('Illegal ruler of mobile, begin with 1, combinations of  numbers, ', 1101203);
        }

        $sms_id = Sms::getInstance()->validate(['mobile'=>$mobile,'business'=>2, 'code'=>(int)$this->request->vcode]);
        if(!$password){
            throw new \LogicException('请填写密码，长度不小于6位！ ', 11);
        }

        $user =  Account::where("mobile", $mobile)->first();

        if(!$user){ throw new \LogicException('账号不存在！', 11);}

        $user->setPassword($password);
        $user->save();

        Sms::getInstance()->setStatus($sms_id);
        return response()->Json(['error'=>0, "message"=>'重置成功！']);
    }

    /**
     * @SWG\Get(
     *   path="/products",
     *   summary="list products",
     *   @SWG\Response(
     *     response=200,
     *     description="A list with products"
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function postLogin(Request $request){
        //user 表里面添加 api_token
        return response()->Json($request->input());
//        if(\Auth::once($this->getCredentials($request))){
//            \Auth::user()->api_token = Str::random(60);
//            \Auth::user()->save();
//
//            return \Auth::user();
//        }else{
//            return response('Unauthorized.', 401);
//        }
    }
}
