<?php

Route::group(['middleware' => 'web'], function () {
	Route::get('contact', ['as' => 'contactform.get', 'uses' => 'KevinOrriss\ContactForm\ContactFormController@index']);
	Route::post('contact', ['as' => 'contactform.post', 'uses' => 'KevinOrriss\ContactForm\ContactFormController@post']);
});
