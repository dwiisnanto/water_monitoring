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

Route::get('/', function () {
    return redirect('/login');
    // return view('landing');
});

// Dashboard
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/users', 'DashboardController@index')->name('users');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index');

Route::get('/superadmin', 'SuperAdminController@index');

// USER RESOURCE
Route::resource('/users', 'UserController');

// DEPARTEMENT RESOURCE
Route::resource('/departements', 'DepartementController');

// MONITORING
Route::get('/monitoring', 'MonitoringController@index');

// TRENDING
Route::get('/trending/daily', 'TrendingController@daily');
Route::get('/trending/monthly', 'TrendingController@monthly');

// API
Route::get('/api-page', 'ApiPageController@index');
Route::get('/api-page/realtime', 'ApiPageController@realtime');
Route::post('/api-page/klhk', 'ApiPageController@klhk');
Route::get('/api-page/setting', 'ApiPageController@setting');
Route::post('/api-page/setting', 'ApiPageController@save');

// SENSOR
Route::get('sensors', 'SensorController@index');
Route::get('sensors/group', 'SensorController@groupSensor');
Route::get('sensors/{id}/edit', 'SensorController@edit');
Route::get('sensors/{id}/activate', 'SensorController@activate');
Route::get('sensors/{id}/deactivate', 'SensorController@deactivate');
Route::delete('sensors/{id}', 'SensorController@destroy');
Route::patch('sensors/{id}', 'SensorController@update')->name('sensor.update');

// ALARM
Route::get('alarm/setting', 'AlarmController@setting');
Route::get('alarm/{id}/acknowledge', 'AlarmController@acknowledge');
Route::get('alarm/{id}/activate', 'AlarmController@activate');
Route::get('alarm/{id}/deactivate', 'AlarmController@deactivate');
Route::resource('alarm', 'AlarmController');

// PUSHER
Route::get('notify', 'NotificationController@notify');
Route::get('curl', 'LogController@SendNotifSocket');
Route::view('/notification', 'notification');

// GENERATE CHART
Route::get('chart', 'ChartController@index');
Route::get('chart/api', 'ChartController@echart2');
