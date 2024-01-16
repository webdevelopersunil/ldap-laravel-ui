<?php

use LdapRecord\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\ProfileController;
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
    
});

Auth::routes();

// Route::fallback(function () {
//     return redirect()->route('home');
// });

Route::group(['middleware' => ['auth']], function () {
     
    // Management Index Route
    Route::get('/manage/manage/index', [ManageController::class, 'manageIndex'])->name('manage.index');

    // Framework
    Route::get('/manage/database/create', [ManageController::class, 'databaseCreate'])->name('database.create');
    Route::post('/manage/database/store', [ManageController::class, 'databaseStore'])->name('database.store');
    Route::get('/manage/database/edit/{id}', [ManageController::class, 'databaseEdit'])->name('database.edit');
    Route::post('/manage/database/update', [ManageController::class, 'databaseUpdate'])->name('database.update');
    Route::get('/manage/database/delete/{id}', [ManageController::class, 'databaseDelete'])->name('database.delete');

    // Framework
    Route::get('/manage/framework/create', [ManageController::class, 'frameworkCreate'])->name('framework.create');
    Route::post('/manage/framework/store', [ManageController::class, 'frameworkStore'])->name('framework.store');
    Route::get('/manage/framework/edit/{id}', [ManageController::class, 'frameworkEdit'])->name('framework.edit');
    Route::post('/manage/framework/update', [ManageController::class, 'frameworkUpdate'])->name('framework.update');
    Route::get('/manage/framework/delete/{id}', [ManageController::class, 'frameworkDelete'])->name('framework.delete');

    // Programming Language
    Route::get('/manage/language/create', [ManageController::class, 'languageCreate'])->name('language.create');
    Route::post('/manage/language/store', [ManageController::class, 'languageStore'])->name('language.store');
    Route::get('/manage/language/edit/{id}', [ManageController::class, 'languageEdit'])->name('language.edit');
    Route::post('/manage/language/update', [ManageController::class, 'languageUpdate'])->name('language.update');
    Route::get('/manage/language/delete/{id}', [ManageController::class, 'languageDelete'])->name('language.delete');

    // Operating System
    Route::get('/manage/os/create', [ManageController::class, 'osCreate'])->name('os.create');
    Route::get('/manage/os/edit/{id}', [ManageController::class, 'osEdit'])->name('os.edit');
    Route::post('/manage/os/update', [ManageController::class, 'osUpdate'])->name('os.update');
    Route::post('/manage/os/store', [ManageController::class, 'osStore'])->name('os.store');
    Route::get('/manage/os/delete/{id}', [ManageController::class, 'osDelete'])->name('os.delete');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', function(){ return redirect()->route('home'); })->name('profile.index');
    

    // for filteration
    Route::post('/project', [App\Http\Controllers\ProjectController::class, 'index'])->name('project.index.filter');
    
    // for sorting
    Route::get('/project/{sort}/{by}', [App\Http\Controllers\ProjectController::class, 'index'])->name('project.index.sort');

    // Website project
    Route::get('/project', [App\Http\Controllers\ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('project.create');
    Route::post('/project/store', [App\Http\Controllers\ProjectController::class, 'store'])->name('project.store');
    Route::get('/project/edit/{id}', [App\Http\Controllers\ProjectController::class, 'edit'])->name('product.edit');

    Route::get('/edit/website/{id}', [App\Http\Controllers\ProjectController::class, 'editWebsite'])->name('edit.website');
    Route::post('/update/website', [App\Http\Controllers\ProjectController::class, 'websiteUpdate'])->name('website.update');
    Route::get('/website/delete/{id}', [ProjectController::class, 'deleteWebsite'])->name('delete.website');

    
    
    // Templates Routes
    Route::get('/template', [App\Http\Controllers\ProjectController::class, 'templatesIndex'])->name('template.index');
    Route::post('/set/template', [App\Http\Controllers\ProjectController::class, 'setTemplate'])->name('set.template');
    Route::get('/project/set/template/{id}', [App\Http\Controllers\ProjectController::class, 'projectSetTemplate'])->name('project.set.template');
    
});

Route::group(['middleware' => 'guest'], function () {
    
    Route::get('/', function () {
        return view('auth.login');
    });
});