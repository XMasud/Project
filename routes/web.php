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

use Illuminate\Support\Facades\Response;





    Route::get('/', function () {
        return view('user');
    });

    Route::get('add_user','UserController@add_user');
    Route::get('view_user','UserController@view_user');
    Route::get('editUser','UserController@editUser');

    Route::resource('user','UserController');


    Route::delete('/deleteUser/{id?}', function ($id) {

        $user = \App\User::destroy($id);
        return response::json($user);
    });

