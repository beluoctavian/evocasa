<?php
/*Administrators*/
//Route::get('printeaza-anunt/{id}', 'UsersController@getPrinteaza');

/*Customers*/
//Route::get('clienti', 'CustomersController@getCustomers');
//Route::get('edit-client/{id}', 'CustomersController@editCustomer');
//Route::post('edit-client', 'CustomersController@postEditCustomer');
//Route::post('adauga-client', 'CustomersController@addCustomer');
//Route::post('cauta-client', 'CustomersController@search');
//Route::get('delete-client/{id}', 'CustomersController@deleteCustomer');

/* ----------------- REFACTORED ROUTES ----------------- */

/*Session*/
Route::get('login', 'SessionsController@create');
Route::post('auth/login', 'SessionsController@store');
Route::get('auth/logout', 'SessionsController@destroy');

/* Pages */
Route::get('/', 'PagesController@index');
Route::get('anunturi', 'PagesController@postSearch');
Route::get('anunturi/{id}', 'AdvertController@viewEntity');
Route::get('despre-noi', 'PagesController@despreNoi');
Route::get('servicii', 'PagesController@servicii');
Route::get('contact', 'PagesController@contact');
Route::post('contact', 'ContactController@store');

/* Admin */
Route::controller('advert/add', 'AdvertController');
Route::get('advert/edit/{id}', 'AdvertController@getEditEntity');
Route::post('advert/edit/{id}', 'AdvertController@postEditEntity');
Route::post('advert/delete', 'AdvertController@postDeleteEntity');
Route::get('advert/update/{id}', 'AdvertController@updateDate');
Route::post('advert/add-status/{id}', 'AdvertController@postAddStatus');
Route::post('advert/delete-status/{id}', 'AdvertController@postDeleteStatus');
Route::get('advert/delete-observation/{id}', 'AdvertController@postDeleteObservation');
Route::get('advert/images/{id}', 'AdvertController@getImages');
Route::post('advert/images/{id}', 'AdvertController@postImages');
Route::post('advert/change-image-order/{id}', 'AdvertController@changeImageOrder');
Route::post('advert/delete-image/{id}', 'UsersController@postDeleteFile');

/* Settings */
Route::get('settings', 'UsersController@getSettings');
Route::post('settings/user', 'UsersController@postUserSettings');
Route::post('settings/website', 'UsersController@postWebsiteSettings');
Route::post('settings/website/delete-file', 'UsersController@postDeleteFile');
