<?php
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
use App\Jobs\SendEmailJob;
//Laravel Version:
Route::get('/laravel-version', function() {
    echo App::version();
});
//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});
//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});
//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});
//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});
//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});
//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
Route::get('/all-clear', function() {
   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');
   return "Cleared!";
});
Route::get('/', function(){
    return view('welcome');
});
Route::redirect('here', 'there', 301);
Route::get('there', function(){
    return view('welcome');
});
Route::get('user/{name?}', function ($name = null) {
    return $name;
});
Route::get('user/{name?}', function ($name = 'John') {
    return $name;
});
Route::get('queue-email-test', function(){
    $details['email'] = 'hardik.chauhan111@mailinator.com';
    dispatch(new SendEmailJob($details));
    dd('done');
});
Auth::routes();
Route::group(['prefix'=>'admin','middleware'=>['auth']], function(){
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/home1', 'HomeController@index1')->name('home1');
  Route::get('/profile', 'UserController@profile')->name('profile');
  Route::get('/users/change-password', 'UserController@changePassword');
  Route::post('/users/change-password', 'UserController@storeNewPassword');
  Route::post('/users/listings', 'UserController@listings');
  Route::resource('users', 'UserController');
  Route::resource('roles', 'RoleController');
  Route::resource('permissions', 'PermissionController');
  Route::resource('posts', 'PostController');
});