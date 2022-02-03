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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'Templates@index')->name('index');
Route::get('/contact', 'Templates@contact')->name('contact');
Route::get('/services', 'Templates@services')->name('services');
Route::get('/map', 'Templates@map')->name('map');

Auth::routes();

Route::get('/dashboard/home', 'HomeController@index')->name('home');

/*contacto */
Route::post('contacto', 'RosarioController@contacto');

/*suscribirse */
Route::post('suscribirse', 'RosarioController@suscribirse');

/*reservacion */
Route::post('reserva', 'RosarioController@reserva');

/*dashboard register bedroom */
Route::post('registerBedroom', 'BedroomController@registerBedroom')->name('registerBedroom');

/*dashboard register Booking */
Route::post('registerBooking', 'BookingController@registerBooking')->name('registerBooking');

/*dashboard register checkin */
Route::post('registerCheckin', 'CheckinController@registerCheckin')->name('registerCheckin');

/*dashboard register orders */
Route::post('registerOrder', 'OrderController@registerOrder')->name('registerOrder');

/*dashboard viewInvoice */
Route::post('viewInvoice', 'InvoiceController@viewInvoice')->name('viewInvoice');

/*dashboard  bedroom view*/
Route::get('/dashboard/bedrooms', 'BedroomController@index')->name('/dashboard/bedrooms');

//list  bedroomms all
Route::get('/listBedroomsAll', 'BedroomController@ListBedroomsAll')->name('ListBedroomsAll');

//list  bookings all
Route::get('/listBookingsAll', 'BookingController@listBookingsAll')->name('listBookingsAll');
Route::view('/listBookingsAll/list', 'list');

//list  countries all, also delivers values ​​of unoccupied rooms
Route::get('/listCountriesAll', 'CountriesController@listCountriesAll')->name('countries');

//list  countries all, also delivers values ​​of unoccupied rooms
Route::get('/bedroomOccupation', 'OrderController@bedroomOccupation')->name('bedroomOccupation');

//genera  invoice pdf
Route::post('invoicePDF','InvoiceController@invoicePDF')->name('invoicePDF');

//genera  reporDayPDF pdf
Route::post('reportDayPDF','ReportController@reportDayPDF')->name('reportDayPDF');



