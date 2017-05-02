<?php

Route::model('annonces', '\Packages\Annonce');

Route::get('/annonces/', 'Packages\PackageAnnoncesController@getList');

Route::get('/annonces/add/', 'Packages\PackageAnnoncesController@getAdd');
Route::post('/annonces/add/', 'Packages\PackageAnnoncesController@postAdd');

Route::get('/annonces/edit/{annonces}/', 'Packages\PackageAnnoncesController@getEdit');
Route::post('/annonces/edit/{annonces}/', 'Packages\PackageAnnoncesController@postEdit');

Route::delete('/annonces/delete/{annonces}/', 'Packages\PackageAnnoncesController@deleteDelete');

Route::get('/annonces/users/{user}/', 'Packages\PackageAnnoncesController@getNewsByUser');

Route::get('/annonces/check-slug/', 'Packages\PackageAnnoncesController@getCheckSlug');
