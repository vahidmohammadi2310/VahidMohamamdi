<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\UserArticleController;
use App\Http\Controllers\ArticleController;

require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function (){

    Route::get('articles',[ArticleController::class,'listOfArticles'])
        ->name('article.index');

    Route::middleware('admin')->group(function (){
        Route::name('admin.article.')->group(function (){
            Route::controller(AdminArticleController::class)->group(function (){
                Route::get('article/approve/{id}','approveArticle')
                    ->name('approve')
                    ->whereUuid('id');
                Route::delete('article/{id}','deleteArticle')
                    ->name('delete')
                    ->whereUuid('id');
                Route::get('articles/history','HistoryOfArticles')
                    ->name('history');
                Route::get('article/history/restore/{id}','restoreArticle')
                    ->name('restore')
                    ->whereUuid('id');
            });
        });
    });

    Route::middleware('user')->group(function (){
        Route::name('user.article.')->group(function (){
            Route::controller(UserArticleController::class)->group(function (){
                Route::get('article/create','createNewArticle')
                    ->name('create');
                Route::post('article/store','storeArticle')
                    ->name('store');
                Route::get('article/{id}/edit','editArticle')
                    ->name('edit')
                    ->whereUuid('id');
                Route::put('article/update/{id}','UpdateArticle')
                    ->name('update');
                Route::get('article/{id}','showArticle')
                    ->name('show')
                    ->whereUuid('id');
            });
        });
    });
});




