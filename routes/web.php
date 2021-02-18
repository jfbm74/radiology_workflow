<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::group([  'prefix' => 'admin', 
                'namespace' => 'Admin',  
                'middleware' => 'auth',
                'middleware' => 'checkstaff',], 
    function () {
        Route::get('/users', 'UserController@index')->name('user.index');           
        Route::put('/user/{id}', 'UserController@email_update')->name('user.update_email');           
    }
);


Route::group([  'prefix' => 'dashboard', 
                'namespace' => 'Dashboard',  
                'middleware' => 'auth',
                'middleware' => 'checkstaff',], 
    function () {
        Route::get('/', 'ManagerController@index')->name('dashboard.manager.index');   
             
    }
);


Route::get('/home', 'HomeController@index')->name('home');

Route::group([  'prefix' => 'admission', 
                'namespace' => 'Admission',  
                'middleware' => 'auth',
                'middleware' => 'checkstaff',], 
    function () {
        Route::get('/', 'AdmissionController@index')->name('admission.index');   
        Route::get('/{admission}', 'AdmissionController@destroy')->name('admission.destroy');
        Route::get('/edit/{admission}', 'AdmissionController@edit')->name('admission.edit');
        Route::put('/edit/{admission}', 'AdmissionController@update')->name('admission.update');
        Route::post('/', 'AdmissionController@store')->name('admission.store');   
        Route::get('/confirm/{admission}', 'AdmissionController@endding')->middleware('checkdoctormail')->name('admission.endding');
        
    }
);

Route::group([  'prefix' => 'attention', 
                'namespace' => 'Attention',  
                'middleware' => 'auth',
                'middleware' => 'checkstaff',], 
    function () {
        
        Route::get('/', 'AttentionController@index')->name('attention.index');
        Route::get('/inprogress', 'AttentionController@attending')->name('attention.attending');   
        Route::post('/order', 'ServiceOrderController@create')->middleware('checkpin')->name('order.create');
        Route::get('/order/{admission}', 'ServiceOrderController@edit')->name('order.edit');
        Route::post('/order/store', 'ServiceOrderController@store')->name('order.store');
        Route::put('/order/fullfilment/', 'FullfilmentController@update')->middleware('checkpin')->name('order.fullfilment');
        Route::put('/order/complete/', 'FullfilmentController@complete')->middleware('checkpin')->name('order.complete');

        //Results Process
        Route::get('/results/pendding', 'PrintingController@pendding_list')->name('results.pendding');
        Route::put('/results/printonce', 'PrintingController@print_one')->name('results.printonce');
        Route::put('/results/printrepeated', 'PrintingController@print_repeated')->name('results.printrepeated');


        Route::post('/order/print', 'PrintingController@store')->name('printing.store');
        Route::post('/order/print/show', 'PrintingController@show')->name('printing.show');
        Route::get('/order/print/show', 'PrintingController@show')->name('printing.show');
        Route::get('/order/print/{id}}', 'PrintingController@edit')->name('printing.edit');
        Route::put('/order/print/{admission}}', 'PrintingController@update')->name('printing.update');
        
        //Photos
        Route::post('/order/{admission}/photos', 'PhotosController@store')->name('results.photos.store');
        Route::delete('/photo/{photo}', 'PhotosController@destroy')->name('results.photos.destroy');
        Route::get('/photo/confirm/{admission}', 'PrintingController@confirm_photo')->name('results.photos.confirm');
        
    }
);

Route::group([  'prefix' => 'billing', 
                'namespace' => 'Billing',  
                'middleware' => 'auth',
                'middleware' => 'checkstaff',], 
    function () {
        Route::get('/', 'BillController@index')->name('bill.index');   
        Route::get('/bill/{bill}', 'BillController@show')->name('bill.show');      
        Route::post('/bill', 'BillController@search')->middleware('checkinvoice')->name('bill.search');                   
    }
);


Route::group([  'prefix' => 'portal' ,
                'middleware' => 'auth',], 
    function () {
        //Route::get('/', 'Admission\PatientController@index')->name('patient.index');
        Route::get('/', 'PortalController@index')->name('portal.index');
        Route::get('/patient', 'Admission\PatientController@show')->name('patient.show');
        Route::get('/patient/{admission}/zoom/', 'Admission\PatientController@gallery')->name('patient.gallery');
        Route::get('/patient/{admission}/zoom/{photo}', 'Admission\PatientController@zoom')->name('patient.zoom');
    }
);

Route::post('posts/{post}/photos', 'PhotosController@store')->name('photos.store');
Route::delete('photos/{photo}', 'PhotosController@destroy')->name('photos.destroy');
