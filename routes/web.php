<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function(){
   return 'It is just a route test! Thanks!';
});

Route::any('signup', 'SignupController@anyIndex');
Route::post('resetpwd', 'SignupController@resetPwd');

Route::any('login', 'SignupController@anyLogin');
//Route::post('login', 'SignupController@postLogin');

Route::any('lottery', 'LotteryController@anyDraw');

Route::get('bindmodel/{user}', function(App\Models\User $user){
    return $user->username;
});
