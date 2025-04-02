<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\MyApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MyJobController;
use App\Models\Employer;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/',function(){
    return redirect()->route('jobs.index');
});
Route::resource('jobs', App\Http\Controllers\JobController::class);

Route::get('login', fn() => to_route('auth.create'))->name('login');
Route::resource('auth', AuthController::class)
    ->only(['create', 'store']);
Route::get('logout',function(){
    return redirect()->route('auth.destroy')->name('logout');
});
Route::delete('auth',[AuthController::class,'destroy'])->name('auth.destroy');

Route::middleware('auth')->group(function(){
    Route::resource('job.application',JobApplicationController::class)
    ->only(['create','store']);

    Route::resource('my-job-applications', MyApplicationController::class);

    Route::resource('employer',EmployerController::class)->only(['create','store']);

    Route::resource('my-jobs',MyJobController::class);
});