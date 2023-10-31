<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EstablishmentTypeController;
use App\Http\Controllers\Auth\AuthenticationSessionController;
use App\Http\Controllers\Auth\RegisterEstablishmentController;
use App\Http\Controllers\Auth\RegisterPersonController;
use App\Http\Controllers\Auth\SelectUserController;

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

//=================   ADMIN  ===================
Route::get('/admin', [AdminController::class, 'welcomeAdmin'])->name('welcome_admin');
Route::get('/establishment', [AdminController::class, 'welcomeEstablishment'])->name('welcome_establishment');
Route::get('/user', [AdminController::class, 'welcomeUser'])->name('welcome_user');

Route::resource('/admin/establishment_types', EstablishmentTypeController::class);
Route::resource('/admin/categories', CategoryController::class);
Route::resource('/admin/brands', BrandController::class);
Route::resource('/admin/userAccounts', UserController::class);

Route::resource('/establishment/products', ProductController::class);

//=================   LOGIN   ==================
Route::get('/login', [AuthenticationSessionController::class, 'create'])->name('login');

//===============   REGISTER   =================
Route::get('/register', [SelectUserController::class, 'create'])->name('selectUser');
Route::get('/register/person', [RegisterPersonController::class, 'create'])->name('registerPerson');
Route::post('/register/person', [RegisterPersonController::class, 'store'])->name('savePerson');

Route::get('/register/establishment', [RegisterEstablishmentController::class, 'create'])->name('registerEstablishment');