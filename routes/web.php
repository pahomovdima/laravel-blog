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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/test', 'TestController@index')->name('test');

Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function () {
    Route::get('/', 'PostController@index')->name('blog.posts.index');
    Route::get('/{slug}', 'PostController@show')->name('blog.posts.show');

    Route::post('/', 'CommentController@send')->name('blog.comments.send');
});


/**
 * Админка сайта
 */
$groupData = [
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'middleware' => 'article_editor'
];
Route::group($groupData, function () {
    Route::get('/', 'AdminController@index')->name('admin_index');
});

// Блог
$groupData = [
    'namespace' => '\App\Http\Controllers\Blog\Admin',
    'prefix' => 'admin/blog',
    'middleware' => 'article_editor'
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

    // Comments
    Route::resource('comments', 'CommentController')
        ->except(['show', 'create', 'store'])
        ->names('blog.admin.comments');
});

// Пользователи
$groupData = [
    'namespace' => '\App\Http\Controllers\User\Admin',
    'prefix' => 'admin/user',
    'middleware' => 'admin'
];
Route::group($groupData, function () {
    // User
    Route::resource('users', 'UserController')
        ->except(['show'])
        ->names('admin.users');

    // Role
    Route::resource('roles', 'RoleController')
        ->except(['show'])
        ->names('admin.roles');
});
