<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\DashController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/' , [PostController::class , 'index']);
Route::resource('/post', PostController::class);
Route::post('/search', [PostController::class , 'search'])->name('search');
Route::get('/category/{id}/{slug}', [PostController::class , 'getByCategory'])->name('category');

Route::resource('/comment' , CommentController::class);
Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('reply.add');

Route::post('/notification', [NotificationController::class, 'index'])->name('notification');
Route::get('/notification' , [NotificationController::class, 'allNotification'])->name('all.Notification');

Route::get('user/{id}' , [UserController::class , 'getPostsByUser'])->name('profile');
Route::get('user/{id}/comments' , [UserController::class , 'getCommentsByUser'])->name('user_comments');

Route::get('admin/dashboard' , [DashController::class, 'index'])->name('admin.dashboard');

Route::resource('admin/category', CategoryController::class);
Route::get( '/admin' ,function(){
    return View('admin.theme.default');
    })->name('admin');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require_once __DIR__ .'/fortify.php';
