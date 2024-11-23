<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::prefix('/news')->group(function () {
    Route::get('/', [NewsController::class, 'get_news']);
    Route::post('/', [NewsController::class, 'create_news']);
    Route::get('/{id}', [NewsController::class, 'get_news_item']);
    Route::put('/{id}', [NewsController::class, 'update_news']);
    Route::delete('/{id}', [NewsController::class, 'delete_news']);

    Route::prefix('/{newsId}/articles')->group(function () {
        Route::get('/', [ArticleController::class, 'get_articles']);
        Route::post('/', [ArticleController::class, 'create_article']);
        Route::get('/{id}', [ArticleController::class, 'get_article']);
    });
});