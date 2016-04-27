<?php

/*Session*/
Route::get('login', 'SessionsController@create');
Route::post('auth/login', 'SessionsController@store');
Route::get('auth/logout', 'SessionsController@destroy');

/*Pages*/
Route::get('/', 'PagesController@index');
Route::get('anunturi', 'PagesController@anunturi');

Route::get('anunturiSearch', 'PagesController@postSearch');
Route::get('anunturi/{id}', 'PagesController@detalii');
Route::get('despre-noi', 'PagesController@despreNoi');
Route::get('servicii', 'PagesController@servicii');
Route::get('contact', 'PagesController@contact');
Route::post('contact', 'ContactController@store');

/*Administrators*/
Route::get('adauga-anunt', 'UsersController@viewAdauga');
Route::post('adauga-anunt', 'UsersController@postAdauga');
Route::get('editeaza-anunt/{id}', 'UsersController@getEditeaza');
Route::post('editeaza-anunt', 'UsersController@postEditeaza');
Route::get('upload-images/{id}', 'UsersController@getUpload');
Route::post('upload-images', 'UsersController@postUpload');
Route::post('delete-image', 'UsersController@deleteImage');
Route::post('change-image-number', 'UsersController@changeImageNumber');
Route::post('sterge-anunt', 'UsersController@sterge');
Route::get('printeaza-anunt/{id}', 'UsersController@getPrinteaza');
Route::get('update-date/{id}', 'UsersController@updateDate');
Route::get('settings', 'UsersController@getSettings');
Route::post('settings', 'UsersController@postSettings');

/*Customers*/
Route::get('clienti', 'CustomersController@getCustomers');
Route::get('edit-client/{id}', 'CustomersController@editCustomer');
Route::post('edit-client', 'CustomersController@postEditCustomer');
Route::post('adauga-client', 'CustomersController@addCustomer');
Route::post('cauta-client', 'CustomersController@search');
Route::get('delete-client/{id}', 'CustomersController@deleteCustomer');

/* ----------------- REFACTOR ALL ROUTES ----------------- */

/* Pages */
Route::controller('advert/add', 'AdvertController');

Route::get('anunturi/{id}', 'AdvertController@viewEntity');

/* Admin */
Route::controller('advert/add', 'AdvertController');
Route::get('advert/edit/{id}', 'AdvertController@getEditEntity');
Route::post('advert/edit/{id}', 'AdvertController@postEditEntity');
Route::controller('advert/add', 'AdvertController');

// Search routes
Route::get('/migrate', 'PagesController@migrate');


Route::post('advert/add-status/{id}', 'AdvertController@postAddStatus');
