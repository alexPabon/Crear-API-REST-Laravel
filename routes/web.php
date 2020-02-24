<?php

use Illuminate\Support\Facades\Artisan;
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
    return view('welcome');
});    

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/sendmail','MessagesController@store')->name('send.mail');

Route::get('/migrar',function(){
    //Artisan::call('migrate');
     //Artisan::call('queue:listen');
    //Artisan::call('migrate:install');
    // Artisan::call('migrate --seed --force');
     
     
    //Artisan::call('queue:failed-table');
    Artisan::call('schedule:run');
    // Artisan::call('config:cache');
    // Artisan::call('config:clear');
    return "Se ha migrado el proyecto";
});

    Route::get('/seeder',function(){
        Artisan::call('db:seed --force --class=UserSeeder');
        Artisan::call('db:seed --force --class=SellerSeeder');
        Artisan::call('db:seed --force --class=BuyerSeeder');
        Artisan::call('db:seed --force --class=ProductSeeder');
        Artisan::call('db:seed --force --class=TransactionSeeder');
        Artisan::call('db:seed --force --class=CategorySeeder');
        return "ya ta";
    });