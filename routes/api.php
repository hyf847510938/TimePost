<?php

use Illuminate\Http\Request;

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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//初始化dingo api
$api = app('Dingo\Api\Routing\Router');

//api版本
$api->version('v1', function ($api) {
    //控制器命名空间
    $api->group(['namespace'=>'App\Http\Controllers\Api'],function ($api) {
        //登陆
        $api->post('user/login', 'AuthController@login');
        //注册
        $api->post('user/regist', 'AuthController@regist');

        $api->group(['middleware' => ['jwt.auth','jwt.refresh']], function ($api) {
            $api->post('test1', 'TestController@index');
            //获取用户信息
            $api->post('user/info', 'AuthController@user_info');

            $api->post('email/create','EmailController@create');
        });
    });
});