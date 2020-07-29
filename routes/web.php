<?php

use Illuminate\Support\Facades\Route;
use App\ClassSubject;
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



Auth::routes();

Route::get('/', function(){
    return view('welcome');

});

Route::get('/about', function(){
    return view('about');

});



Route::group(['middleware' => ['web','auth']], function(){
    

    Route::get('/home', function(){
        if (Auth::user()->admin == 0){
            return view('home');
        } else{
            $users['users'] = \App\User::all();
            return view('adminhome', $users);
            
        }

    });

});



Route::group(['middleware' => ['web','auth']], function(){
    

    Route::get('/uploadvid', function(){
        if (Auth::user()->admin == 1){
            return view('uploadvid');
        } else{
            return view('unauthorized');
            
        }

    });

    Route::get('/classlist', function(){
        if (Auth::user()->admin == 1){
            $users = \App\User::all();
            return view('classlist',compact('users'));
        } else{
            return ('unauthorized');
            
        }

    });

    Route::get('/uploadnote', function(){
        if (Auth::user()->admin == 1){
            return view('uploadnote');
        } else{
            return ('unauthorized');
            
        }

    });

    Route::get('/uploaddash', function(){
        if (Auth::user()->admin == 1){
            $data = ClassSubject::all();
        return view('uploaddash', compact('data'));
        } else{
            return ('unauthorized');
            
        }

    });

    Route::get('/tuition', function(){
        if (Auth::user()->admin == 0){
            $data = ClassSubject::all();
        return view('tuition');
        } else{
            return view('welcome');           
        }
    });

    
    Route::get('/adminhome', function(){
        if (Auth::user()->admin == 1){
            return view('adminhome');
        } else{
            return ('unauthorized');
            
        }

    });

});

Route::post('/upload', 'UploadController@VideoUpload');
    Route::get('/myjambcourselist','UploadController@myjambcourselist');
    Route::get('/myietscourselist','UploadController@myietscourselist');
    Route::get('/mypostcourselist','UploadController@mypostcourselist');
    Route::get('/mysatcourselist','UploadController@mysatcourselist');
    Route::get('/mywaeccourselist','UploadController@mywaeccourselist');
