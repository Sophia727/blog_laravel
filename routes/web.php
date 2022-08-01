<?php

use App\Http\Controllers\admin\ArticleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'index']);
Route::Post('/login', [AuthController::class, 'login'])->name("login");

//il faut etre authentifié pour acceder à "articles" / "logout" ...
Route::middleware('auth')->group(function(){
    Route::get('/admin', function(){
        return view('admin.home');
    });

    Route::prefix('/admin')->group(function(){
        Route::resource("articles", ArticleController::class)->names([
            'create'=>'articles.create',
            'index'=>'articles.list',
        ]);
    });
    
    Route::get('/logout', [AuthController::class, 'logout'])->name("logout");

});
