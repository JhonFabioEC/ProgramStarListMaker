<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\SelectUserController;
use App\Http\Controllers\EstablishmentTypeController;
use App\Http\Controllers\PersonProfileUserController;
use App\Http\Controllers\PersonProfileAdminController;
use App\Http\Controllers\Auth\RegisterPersonController;
use App\Http\Controllers\Auth\AuthenticationSessionController;
use App\Http\Controllers\Auth\RegisterEstablishmentController;

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

//=================   HOME   ===================
Route::get('/', [HomeController::class, 'home'])->name('home');

//=================   LOGIN   ==================
Route::get('/login', [AuthenticationSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticationSessionController::class, 'store'])->name('start');
Route::post('/logout', [AuthenticationSessionController::class, 'destroy'])->name('logout');

//===============   REGISTER   =================
Route::get('/register', [SelectUserController::class, 'create'])->name('selectUser');
Route::get('/register/person', [RegisterPersonController::class, 'create'])->name('registerPerson');
Route::post('/register/person', [RegisterPersonController::class, 'store'])->name('savePerson');

Route::get('/register/establishment', [RegisterEstablishmentController::class, 'create'])->name('registerEstablishment');
Route::post('/register/establishment', [RegisterEstablishmentController::class, 'store'])->name('saveEstablishment');

//=================   ADMIN  ===================
Route::get('/admin', [AdminController::class, 'welcomeAdmin'])->name('welcome_admin')->middleware('auth');

Route::resource('/admin/management/establishment_types', EstablishmentTypeController::class)->middleware('auth');
Route::resource('/admin/management/categories', CategoryController::class)->middleware('auth');
Route::resource('/admin/management/brands', BrandController::class)->middleware('auth');
Route::resource('/admin/management/user_accounts', UserController::class)->middleware('auth');
Route::get('/admin/management/user_accounts/account_status/{id}', [UserController::class, 'setAccountStatus'])->name('set_account_status')->middleware('auth');

Route::get('/admin/profile', [PersonProfileAdminController::class, 'index'])->name('admin_profile')->middleware('auth');
Route::get('/admin/profile/edit', [PersonProfileAdminController::class, 'edit'])->name('admin_edit_profile')->middleware('auth');
Route::put('/admin/profile/edit', [PersonProfileAdminController::class, 'update'])->name('updatePersonAdmin')->middleware('auth');
Route::get('/admin/profile/delete/{id}', [PersonProfileAdminController::class, 'destroy'])->name('destroyPersonAdmin')->middleware('auth');

Route::get('/user/profile', [PersonProfileUserController::class, 'index'])->name('user_profile')->middleware('auth');
Route::get('/user/profile/edit', [PersonProfileUserController::class, 'edit'])->name('user_edit_profile')->middleware('auth');
Route::put('/user/profile/edit', [PersonProfileUserController::class, 'update'])->name('updatePersonUser')->middleware('auth');
Route::get('/user/profile/delete/{id}', [PersonProfileUserController::class, 'destroy'])->name('destroyPersonAdmin')->middleware('auth');

Route::get('/establishment', [AdminController::class, 'welcomeEstablishment'])->name('welcome_establishment')->middleware('auth');

Route::resource('/establishment/management/products', ProductController::class)->middleware('auth');

Route::get('/user', [AdminController::class, 'welcomeUser'])->name('welcome_user')->middleware('auth');
