<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogController;

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

Route::get('/', function () {
    #if the user is logged return index view, if not logged return login view
    if (Auth::check()) {
        return view('index');
    } else {
        return view('auth.login');
    }
});

# add 'register' => false to Auth::routes() to disable registration
Auth::routes(['verify' => true]);

Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth', 'verified');
Route::post('/profile/update/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update')->middleware('auth', 'verified');
Route::post('/profile/update/theme', [ProfileController::class, 'updateTheme'])->name('profile.theme.update')->middleware('auth', 'verified');

# Permission::class

Route::get('/permissions/export/csv', [PermissionController::class, 'exportcsv'])->name('permissions.export.csv')->middleware('auth', 'verified');

Route::get('/permissions/export/xls', [PermissionController::class, 'exportxls'])->name('permissions.export.xls')->middleware('auth', 'verified'); // Export XLS

Route::get('/permissions/export/pdf', [PermissionController::class, 'exportpdf'])->name('permissions.export.pdf')->middleware('auth', 'verified'); // Export PDF

Route::resource('/permissions', PermissionController::class)->middleware('auth', 'verified'); // Resource Route, crud

# Role::class

Route::get('/roles/export/csv', [RoleController::class, 'exportcsv'])->name('roles.export.csv')->middleware('auth', 'verified'); // Export CSV

Route::get('/roles/export/xls', [RoleController::class, 'exportxls'])->name('roles.export.xls')->middleware('auth', 'verified'); // Export XLS

Route::get('/roles/export/pdf', [RoleController::class, 'exportpdf'])->name('roles.export.pdf')->middleware('auth', 'verified'); // Export PDF

Route::resource('/roles', RoleController::class)->middleware('auth', 'verified'); // Resource Route, crud

# User::class

Route::get('/users/export/csv', [UserController::class, 'exportcsv'])->name('users.export.csv')->middleware('auth', 'verified'); // Export CSV

Route::get('/users/export/xls', [UserController::class, 'exportxls'])->name('users.export.xls')->middleware('auth', 'verified'); // Export XLS

Route::get('/users/export/pdf', [UserController::class, 'exportpdf'])->name('users.export.pdf')->middleware('auth', 'verified'); // Export PDF

Route::resource('/users', UserController::class)->middleware('auth', 'verified'); // Resource Route, crud

# Log::class

Route::resource('/logs', LogController::class)->middleware('auth', 'verified')->only('show', 'index'); // Resource Route, crud
