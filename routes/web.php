<?php

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

Route::get('/', \App\Http\Livewire\Home::class)->name('index');


Route::get('login/github', [\App\Http\Controllers\LoginController::class, 'githubView'])->name('github.auth');
Route::get('login/github/callback', [\App\Http\Controllers\LoginController::class, 'githubCallback'])->name('github.callback');

Route::view('about','about')->name('about');
Route::get('message-board',\App\Http\Livewire\MessageBoard::class)->name('message.board');


Route::get('post-show/{post}', \App\Http\Livewire\PostShow::class)->name('post.show');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth:sanctum','verified']],function (){
    Route::get('chat',\App\Http\Livewire\Chat::class)->name('chat');
});


