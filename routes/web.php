<?php

use LdapRecord\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TemplateController;
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

Route::get('ldap', function (Request $request) {

    $connection = Container::getConnection('default');
    $record = $connection->query()->findBy('samaccountname', 'A004112' );
    echo "<pre/>"; print_r($record); die;
    
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    
    Route::get('/project', [App\Http\Controllers\ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('project.create');
    Route::post('/project/store', [App\Http\Controllers\ProjectController::class, 'store'])->name('project.store');

    Route::post('/set/template', [App\Http\Controllers\TemplateController::class, 'setTemplate'])->name('set.template');
    Route::get('/template', [App\Http\Controllers\TemplateController::class, 'index'])->name('template.index');
});

Route::group(['middleware' => 'guest'], function () {
    
    Route::get('/', function () {
        return view('auth.login');
    });
});