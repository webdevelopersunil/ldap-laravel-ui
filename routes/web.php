<?php

use Illuminate\Support\Facades\Route;
use LdapRecord\Container;
use App\Http\Controllers\ProjectController;
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

        dd(Adldap::auth()->attempt('CN=Boardportal Admin,OU=Users,OU=ScopeMinar,OU=Delhi,OU=CorporateOffice,DC=ONGC,DC=ONGCGroup,DC=co,DC=in', 'SRee56##@ad'));
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/project', [App\Http\Controllers\ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('project.create');
    Route::post('/project/store', [App\Http\Controllers\ProjectController::class, 'store'])->name('project.store');
});

Route::group(['middleware' => 'guest'], function () {
    
    Route::get('/', function () {
        return view('welcome');
    });
});