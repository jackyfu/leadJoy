<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Overtrue\Socialite\SocialiteManager;
use Overtrue\Socialite\AccessToken;

use App\Models\{Account, Token, OAuthToken};


class OAuthController extends Controller
{
    protected  $socialite = null;

    protected $client = '';


    public function __construct(Request $request){
        $this->request = $request;
        $this->client = $this->request->client;
        if (!in_array($this->client, OAuthToken::PLATFORM)) {
            throw new \LogicException('Third platform not exists!', 1101501);
        }

        $platform = \Config::get('oauth.' . $this->client);
        $this->socialite = new SocialiteManager($platform);
    }

    /**
     *  第三方登录 显示界面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function handler(){
        $response = $this->socialite->dirver($this->client)->redirect();
        $response->send();// or echo $response;
    }

    /**
     * 验证回调  记录oauth信息 、自动注册账号、自动登录生成token
     * 通过ID／openid确认是否已经注册过  create / update
     *
     */
    public function callback(){
        $user = $this->socialite->driver($this->client)->user();

        //$user = $this->socialite->getUserByToken($accessToken);
        dd($user->getToken()); //$user->getAccessToken()

       //自动注册账号 account 并且 记录oauth_token
        return $this->saveToken($user);

    }

    /**
     * @param $user
     * @return string
     */
    protected function saveToken($user){
        $oauth      = new OauthToken();
        $account    = new Account();
        $token      = Token::setToken($account);

        $oauth::updateOrCreate(["openid"=>$user->openid], $user);

        return $token;
    }

    public function loginWithQQToken(){
        $accessToken = new AccessToken(['access_token'=>$this->request->access_token]);
        $user = $this->socialite->driver($this->client)->user($accessToken);
    }


    public function test(){

        $response = $this->socialite->driver($this->platform)->redirect();
        $response->send(); // or echo $response
    }

    public function testCallback(){
        $user = $this->socialite->dirver($this->platform)->user();
    }


}
