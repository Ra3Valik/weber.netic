<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;

Route::prefix( 'books' )->group( function () {
    Route::get( '/', [BookController::class, 'index'] );
    Route::post( '/', [BookController::class, 'store'] );
    Route::get( '{book}', [BookController::class, 'show'] );
    Route::put( '{book}', [BookController::class, 'update'] );
    Route::delete( '{book}', [BookController::class, 'destroy'] );
} );
