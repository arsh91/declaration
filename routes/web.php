<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeclarationUploadController;
use App\Http\Controllers\UsersController;

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
Route::get('/', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.user');
Route::get('/register', [LoginController::class, 'registerView'])->name('register.index');
Route::post('/register/save', [LoginController::class, 'registerSave'])->name('register.save');
Route::group(['middleware' => ['auth']], function() {
    Route::resource('/dashboard', DashboardController::class);
    Route::get('/declaration/upload', [DeclarationUploadController::class, 'index'])->name('declaration.index')->middleware('documentuploadpermission');;
    Route::post('/declaration/store', [DeclarationUploadController::class, 'store'])->name('declaration.store');
    Route::get('/declaration/list', [DeclarationUploadController::class, 'show'])->name('declaration.show')->middleware('documentlistpermission');;
    Route::delete('/declaration/upload/delete', [DeclarationUploadController::class, 'destroy']);
    Route::post('/declaration/status/change', [DeclarationUploadController::class, 'declarationStatusChange']);
    Route::post('/declaration/type/change', [DeclarationUploadController::class, 'declarationTypeChange']);
    Route::post('/upload/edit', [DeclarationUploadController::class, 'renameUpload']);

    Route::get('/users', [UsersController::class, 'index'])->name('users.index')->middleware('userspermission');;
    Route::post('/user/role/change', [UsersController::class, 'userRoleChange']);



});

Route::get('logout', [LoginController::class, 'logOut'])->name('logout');