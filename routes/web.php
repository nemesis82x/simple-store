<?php

use App\Http\Livewire\Users\ManageUsers;
use App\Http\Livewire\Users\TrashUsers;
use App\Http\Livewire\Users\UserProfile;
use Illuminate\Support\Facades\Route;

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
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/users',ManageUsers::class)->middleware(['auth','verified'])->name('users');

Route::get('/users',ManageUsers::class)->middleware(['auth', 'verified'])->name('users');
Route::get('/trash',TrashUsers::class)->middleware(['auth', 'verified'])->name('trash');
Route::get('/profile',UserProfile::class)->middleware(['auth', 'verified'])->name('profile');


/*Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/

require __DIR__.'/auth.php';
