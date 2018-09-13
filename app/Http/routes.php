<?php
Route::group(['prefix'=>'api'], function () {
   Route::post('/find-property','AuController@findProperty');
   Route::post('/storeProperty','AuController@saveProperty');
   Route::get('/properties','AuController@index');
   Route::get('/get_suburb','PostCodeController@getPostCode');
});