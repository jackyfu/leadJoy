<?php
use Illuminate\Http\Request;
use App\Models\Token;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/sms/getVerifyCode', 'Api\SmsController@verifyCode');
Route::get('/oauth/authorize/{client}', 'Api\OAuthController@handler');
Route::get('/oauth/callback', 'Api\OAuthController@callback');
Route::get('/oauth/callback/{client}', 'Api\OAuthController@callback');

//测试用例 /api/user
Route::middleware('auth:api')->get('/user', function (Request $request) {
    $api_token = md5('2' . env('API_TOKEN_KEY') . str_random(64));
    $token = Token::where("user_id", 1)->first();
    !$token && $token = new Token();
    $token->user_id     = 1;
    $token->api_token   = $api_token;
    $token->dev_id      = "";
    $token->client_type = "";
    $token->expire      = time() + 90*86400; //有效期 90天

    $token->save();
    return $request->user();
});

Route::group(['middleware'=>'auth:api'], function(){
   Route::get('/account/getToken', 'Api\AccountController@getToken');
});
