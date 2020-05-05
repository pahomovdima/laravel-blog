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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function () {
    Route::resource('posts', 'PostController')->names('blog.posts');
});


// Админка блога
$groupData = [
    'namespace' => 'Blog\Admin',
    'prefix' => 'admin/blog',
    'middleware' => 'auth'
];
Route::group($groupData, function () {
    // BlogCategory
    $methods = ['index', 'edit', 'store', 'update', 'create', 'destroy'];
    Route::resource('categories', 'CategoryController')
        ->only($methods)
        ->names('blog.admin.categories');

    // BlogPost
    Route::resource('posts', 'PostController')
        ->except(['show'])
        ->names('blog.admin.posts');
});

// Пользователи в админке
$groupData = [
    'namespace' => 'User\Admin',
    'prefix' => 'admin/user',
    'middleware' => 'auth'
];
Route::group($groupData, function () {
    // User
    Route::resource('users', 'UserController')
        ->except(['show'])
        ->names('admin.users');

    // UserGroup
    Route::resource('user_groups', 'UserGroupController')
        ->except(['show'])
        ->names('admin.user_groups');
});
