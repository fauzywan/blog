<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SiteController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [SiteController::class,'index']);
Route::get('{post}/read', [SiteController::class,'post']);
Route::post('{post}/read', [SiteController::class,'comment']);
Route::get('category/{category}', [SiteController::class,'category']);
Route::get('about/', [SiteController::class,'about']);

Route::group(['prefix' => 'creator','middleware'=>"auth"], function () {
     Route::get('dashboard',function(){
    
        return view('admin/dashboard');
    });
    
    Route::group(['prefix' => 'comment'], function () 
    {
    Route::get('',[CommentController::class,'index']);
    Route::get('{post}/detail',[CommentController::class,'detail']);
    Route::get('{comment}/delete',[CommentController::class,'delete']);
    });


   
    Route::group(['prefix' => 'post'], function () 
    {
        Route::get('',[PostController::class,'index']);
        Route::get('draff',[PostController::class,'draff']);
        Route::get('create',[PostController::class,'create']);
        Route::post('create',[PostController::class,'store']);
        Route::get('{post}/edit',[PostController::class,'edit']);
        Route::put('{post}/save',[PostController::class,'save']);
        Route::put('{post}/publish',[PostController::class,'publish']);
        Route::get('{post}/delete',[PostController::class,'delete']);
        Route::get('confirm',[PostController::class,'confirm']);
    });

});
Route::group(['prefix' => 'admin', 'middleware' => ['MustRole','auth']], function () {
    Route::group(['prefix' => 'account'], function () 
    {
    Route::get('',[AccountController::class,'index']);
    Route::get('create',[AccountController::class,'create']);
    Route::post('create',[AccountController::class,'store']);
    Route::get('{user}/edit',[AccountController::class,'edit']);
    Route::put('{user}/edit',[AccountController::class,'update']);
    Route::get('{user}/detail',[AccountController::class,'detail']);
    Route::get('{user}/delete',[AccountController::class,'delete']);
    });




    Route::group(['prefix' => 'post'], function () 
    {
        Route::get('',[PostController::class,'index']);
        Route::get('draff',[PostController::class,'draff']);
        Route::get('confirm',[PostController::class,'confirm']);
        Route::get('create',[PostController::class,'create']);
        Route::post('create',[PostController::class,'store']);
        Route::get('{post}/edit',[PostController::class,'edit']);
        Route::put('{post}/save',[PostController::class,'save']);
        Route::put('{post}/publish',[PostController::class,'publish']);
        Route::put('{post}/approve',[PostController::class,'approve']);
        Route::get('{post}/delete',[PostController::class,'delete']);

    });

    Route::get('dashboard',function(){
        return view('admin/dashboard');
    });
    
    Route::group(['prefix' => 'comment'], function () 
    {
    Route::get('',[CommentController::class,'index']);
    Route::get('{post}/detail',[CommentController::class,'detail']);
    Route::get('{comment}/delete',[CommentController::class,'delete']);
    });

  

    Route::group(['prefix' => 'categories'], function () 
    {

    Route::get('',[CategoryController::class,'index']);
    Route::post('',[CategoryController::class,'store']);
    Route::get('{category}/edit',[CategoryController::class,'edit']);
    Route::put('{category}/edit',[CategoryController::class,'update']);
    Route::get('{category}/detail',[CategoryController::class,'detail']);
    Route::get('{category}/delete',[CategoryController::class,'delete']);
    
});



    
});
// Route::group(['prefix' => 'post'], function () {
    //     Route::get('',[CategoryController::class,'index']);
    // });

// Route::group(['prefix' => 'categoy'], function () {
//     Route::get('',[CategoryController::class,'index']);
//     Route::get('',[CategoryController::class,'index']);
// });
Auth::routes();

Route::get('/home',function(){
    if(auth()->user()->role_id!=3){
        return redirect('/admin/dashboard');
    }
    else{
        return redirect('/creator/dashboard');
        
    }
})->name('home');

Route::get('/logout', [LoginController::class,'logout'])->middleware('auth');