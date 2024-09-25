<?php

use App\Http\Controllers\IssuesController;
use Illuminate\Support\Facades\Route;


Route::get('/', fn() => redirect('/home'));

Auth::routes();


Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/issues', [IssuesController::class, 'index'])->name('issues');
    Route::get('/issues/create', [IssuesController::class, 'create'])->name('issues.create')->middleware('customer');
    Route::post('/issues', [IssuesController::class, 'store'])->name('issues.store')->middleware('customer');
    Route::put('/issues/update/{issue}', [IssuesController::class, 'update'])->name('issues.update')->middleware('admin');
});