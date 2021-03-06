<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DemoClassController;
use App\Http\Controllers\ClassController;


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


Route::get('/', [SiteController::class,'showHome']);
Route::get('/visitor', [VisitorController::class,'showVisitor']);


Route::get('/course', [CourseController::class,'showCourse']);
Route::get('/getCourseData', [CourseController::class,'getCourseData']);
Route::post('/CourseDelete', [CourseController::class,'CourseDelete']);
Route::post('/CourseDetails', [CourseController::class,'getCourseDetails']);
Route::post('/CourseUpdate', [CourseController::class,'CourseUpdate']);
Route::post('/CourseAdd', [CourseController::class,'CourseAdd']);

Route::get('/democlass', [DemoClassController::class,'showDemoClass']);
Route::get('/getDemoClass', [DemoClassController::class,'getDemoClass']);
Route::post('/DemoClassDelete', [DemoClassController::class,'DemoClassDelete']);
Route::post('/getDemoDetails', [DemoClassController::class,'getDemoDetails']);
Route::post('/DemoClassUpdate', [DemoClassController::class,'DemoClassUpdate']);
Route::post('/DemoClassAdd', [DemoClassController::class,'DemoClassAdd']);   


Route::get('/classroom', [ClassController::class,'showClass']);
Route::get('/getClass', [ClassController::class,'getClass']);
Route::post('/ClassDelete', [ClassController::class,'ClassDelete']);
Route::post('/getDetails', [ClassController::class,'getDetails']);
Route::post('/ClassUpdate', [ClassController::class,'ClassUpdate']);
Route::post('/ClassAdd', [ClassControllerr::class,'ClassAdd']);   


