<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ManageUsersController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserPermissionController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return view('welcome');
});

Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){ 
    Route::get('/dashboard/home', function () {
    return view('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard.user');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



############# Role Management #############

Route::resource('roles', RoleController::class)
    ->middleware(['auth', 'verified']); 

Route::post('roles/{id}/assign-permissions', [RoleController::class, 'assignPermissions'])
    ->name('roles.assignPermissions');

    ########## Permission Management #############
Route::get('permissions/index', [PermissionController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('permissions.index');
Route::get('permissions/create', [PermissionController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('permissions.create');
Route::post('permissions', [PermissionController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('permissions.store');
Route::get('permissions/edit/{id}', [PermissionController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('permissions.edit');
Route::patch('permissions/update/{id}', [PermissionController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('permissions.update');
Route::delete('permissions/destroy/{id}', [PermissionController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('permissions.destroy');  


############# User Management #############

Route::get('users/index', [ManageUsersController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('users.index');
Route::get('users/show/{id}', [ManageUsersController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('users.show');

Route::get('users/edit/{id}', [ManageUsersController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('users.edit');

Route::patch('users/update/{id}', [ManageUsersController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('users.update');

Route::delete('users/destroy/{id}', [ManageUsersController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('users.destroy');

Route::post('users/{id}/assign-permissions', [ManageUsersController::class, 'assignPermissions'])
    ->middleware(['auth', 'verified'])
    ->name('users.assignPermissions');
Route::get('users/{id}/permissions', [UserPermissionController::class, 'edit'])->name('users.permissions.edit');
Route::put('users/{id}/permissions', [UserPermissionController::class, 'update'])->name('users.permissions.update');

############ employee Management #############

Route::resource('employees', EmployeeController::class)
    ->middleware(['auth', 'verified']);

############ Post Management #############

Route::resource('posts', PostController::class)
        ->middleware(['auth', 'verified']);

########### Status Management #############

Route::resource('statuses', StatusController::class)
    ->middleware(['auth', 'verified']);

########### Contract type Management #############

Route::resource('contracts', ContractTypeController::class)
    ->middleware(['auth', 'verified']);

########## Client Management #############

Route::resource('clients', ClientController::class)
    ->middleware(['auth', 'verified']);

########## Project Management #############

Route::resource('projects', ProjectController::class)
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';


});

