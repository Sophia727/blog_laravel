<?php

use App\Http\Controllers\admin\ArticleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\User_articleController;
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


Route::get('/login', [AuthController::class, 'index'])->name('login.display');
Route::Post('/login', [AuthController::class, 'login'])->name("login");

//il faut etre authentifié pour acceder à "articles" / "logout" ...
Route::middleware(['auth', 'admin'])->group(function(){
    //admin
    Route::get('/admin', function(){
        return view('admin.home')->name('admin.dashboard');
        });
    
    Route::prefix('/admin')->group(function(){
        
        //admin/articles
        Route::get("articles", [ArticleController::class, 'index'])->name("articles.list");
        Route::get("articles/create", [ArticleController::class, 'create'])->name('articles.create');
        Route::get("articles/{article}/show", [ArticleController::class, 'show'])->name("articles.show");
        Route::get("articles/{article}/edit", [ArticleController::class, 'edit'])->name('articles.edit');
        Route::put("articles/{article}/update", [ArticleController::class, 'update'])->name('articles.update');
        Route::get("articles/destroy", [ArticleController::class, 'destroy'])->name('articles.destroy');
        Route::post("articles/store", [ArticleController::class, 'store'])->name('articles.store');

        Route::put('article/{id}/publish', [ArticleController::class, 'publish'])->name('articles.publish');
        // Route::put('article/{query}/search', [ArticleController::class, 'search'])->name('articles.search');
        Route::get('article/search', [ArticleController::class, 'search'])->name('articles.search');


        
        //admin/user
        Route::resource('users', UserController::class)->names([
            'index'=>'user_list',
            'create'=>'user.create',
        ])->except('show');
        Route::put("users/{id}/activate", [UserController::class, "activate"])->name("users.activate");
        Route::get("users/{user}/show", [UserController::class, "show"])->name("users.show");
        Route::get("users/search", [UserController::class, "search"])->name("users.search");
        
    });

    Route::get('/user', [User_articleController::class, 'index'])->name('userArticlesList');    
    
    //connecté en temps que: user
    Route::prefix('/user')->group(function(){
        Route::get('articles/index', [User_articleController::class, 'index'])->name('userArticlesList');        
        Route::get('article/{user_article_id}/show', [User_articleController::class, 'show'])->name('userArticleShow');        
        Route::get('article/search', [User_articleController::class, 'search'])->name('userArticleSearch');
       // Route::put('article/{id}/publish', [User_articleController::class, 'publish'])->name('userArticlePublish');
        Route::get('article/create', [User_articleController::class, 'create'])->name('userArticle.create');
        Route::put('article/store', [User_articleController::class, 'store'])->name('userArticle.store');
        
    
    });
    
    Route::get('/logout', [AuthController::class, 'logout'])->name("logout");

});
