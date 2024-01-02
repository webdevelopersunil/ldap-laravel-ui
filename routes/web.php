<?php

use Illuminate\Support\Facades\Route;
use LdapRecord\Container;
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


    // $ldapUser = Adldap::search()->users()->find(121149);
    // echo "<pre>"; print_r($ldapUser);die;

    // $user = Adldap::search()->users()->find(11008871);
    // echo "<pre/>"; print_r($user); die;

        //dd(Adldap::auth()->attempt('CN=Arun kumar Saw,DC=ONGC,DC=ONGCGroup,DC=co,DC=in', 'Welcome@123'));
        dd(Adldap::auth()->attempt('CN=Boardportal Admin,OU=Users,OU=ScopeMinar,OU=Delhi,OU=CorporateOffice,DC=ONGC,DC=ONGCGroup,DC=co,DC=in', 'SRee56##@ad'));
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
