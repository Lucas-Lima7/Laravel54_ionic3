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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

\ApiRoute::version('v1', function (){
    ApiRoute::group([
        'namespace' => 'DeskFlix\Http\Controllers\Api',
        'as' => 'api',
        'middleware' => 'bindings'
    ], function (){
       ApiRoute::post('/access_token', [
           'uses' => 'AuthController@accessToken',
           'middleware' => 'api.throttle', //para usar sistema de bloqueio por da qtd de requisição
           'limit' => 10,  // significa que maximo de requisições que poderá ser feito
           'expires' => 1  //durante o intervalo de tempo, no caso, 1 minuto
           ])
           ->name('.access_token');
       ApiRoute::post('/refresh_token', [
           'uses' => 'AuthController@refreshToken',
           'middleware' => 'api.throttle',
           'limit' => 10,
           'expires' => 1
           ])
           ->name('.refresh_token');

//        ApiRoute::get('/plans', 'PlansController@index');

       ApiRoute::group([
           'middleware' => ['api.throttle', 'api.auth'],
           'limit' => 100,
           'expires' => 3
       ], function (){
           ApiRoute::post('/logout', 'AuthController@logout');
          ApiRoute::get('/test', function (){
              return "opa ok";
          });
          ApiRoute::get('/user', function (Request $request){
             return $request->user('api');
          });
          ApiRoute::patch('/user/settings', 'UsersController@updateSettings');

          ApiRoute::patch('/user/cpf', 'UsersController@addCpf');

          ApiRoute::get('/plans', 'PlansController@index');

           ApiRoute::post('/plans/{plan}/payments', 'PaymentsController@makePayment'); //criando pagamento
           ApiRoute::patch('/plans/{plan}/payments', 'PaymentsController@store'); //aprovando pagamento



           // ************************************
           // ÁREA DO ASSINANTE *****************
           // ************************************
           ApiRoute::group(['middleware' => 'check-subscriptions'],function(){
               ApiRoute::get('/test', function (){
                   return "opa ok";
               });
               //ApiRoute::resource('videos','VideosController',['only'=>['index','show']]);
           });
       });
    });
});

/*Route::get('/test', function (){
    return \DeskFlix\Models\User::paginate();
});*/

