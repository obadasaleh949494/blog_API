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


Route::group(['middleware' => 'auth:api'] , function(){

   Route::post('post' , 'PostController@store');
   Route::get('post' , 'PostController@index');
   Route::get('post/{id}' , 'PostController@getPost');
   Route::put('post/{id}' , 'PostController@editPost');
   Route::post('comment/{postId}' , 'CommentController@createComment');
   Route::get('comments/{postId}' , 'PostController@index');

    Route::delete('post/{id}' , 'PostController@deletePost');

});

Route::post('login' , 'LoginController@login');
Route::post('register' , 'LoginController@register');