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
    return redirect('login');
});

Auth::routes();


Route::get('/admin', 'AdminController@index')->name('admin.home')->middleware('admin');
Route::get('/user', 'UserController@index')->name('user.home')->middleware('user');
 
Route::group(['middleware' => ['admin']], function() {

    /////////////////////////// Rack  /////////////////////////////////////
    
    Route::get('Racks', 'RackController@Racks')->name('Rack');
    Route::get('AddRack', 'RackController@AddRack')->name('add.Rack');
    Route::post('SaveRack', 'RackController@SaveRack')->name('save.Rack');
    Route::post('Edit-Rack', 'RackController@EditRack')->name('edit.Rack');
    Route::post('UpdateRack', 'RackController@UpdateRack')->name('update.Rack');
    Route::get('DeleteRack', 'RackController@DeleteRack')->name('delete.Rack');
    
    /////////////////////////// Book  /////////////////////////////////////
    
    Route::get('Books', 'BookController@Books')->name('Book');
    Route::get('AddBook', 'BookController@AddBook')->name('add.Book');
    Route::post('SaveBook', 'BookController@SaveBook')->name('save.Book');
    Route::post('Edit-Book', 'BookController@EditBook')->name('edit.Book');
    Route::post('UpdateBook', 'BookController@UpdateBook')->name('update.Book');
    Route::get('DeleteBook', 'BookController@DeleteBook')->name('delete.Book');
    });

    
Route::group(['middleware' => ['user']], function() {

    /////////////////////////// Rack  /////////////////////////////////////
    
    Route::get('Rackss', 'RackController@Racks')->name('Rackview');
      
    /////////////////////////// Book  /////////////////////////////////////
    
    Route::get('Book', 'BookController@Books')->name('Bookview');
     
    });