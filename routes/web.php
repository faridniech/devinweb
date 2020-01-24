<?php

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

Route::get('images/{image}', function($image = null)
{
    $path = storage_path().'/images/' . $image;
    if (file_exists($path)) { 
        return Response::download($path);
    }
});

Route::resource('categories','CategorieController');
Route::resource('courses','CourseController');

Route::get('imageupload','ImageUploadController@image');
Route::post('imageupload','ImageUploadController@imagePost');