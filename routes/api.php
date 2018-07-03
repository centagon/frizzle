<?php

Route::prefix('api')->group(function () {
    // Api Token Routes...
    Route::get('/tokens', 'TokensController@index')->name('frizzle.tokens.index');
    Route::post('/tokens', 'TokensController@register')->name('frizzle.tokens.register');
    Route::delete('/tokens/{token}', 'TokensController@destroy')->name('frizzle.tokens.destroy');

    // Topic Routes...
    Route::get('/topics', 'TopicsController@index')->name('frizzle.topics.index');
    Route::post('/topics/{name}', 'TopicsController@create')->name('frizzle.topics.create');
    Route::delete('/topics/{name}', 'TopicsController@destroy')->name('frizzle.topics.destroy');

    // Subscription Routes...
    Route::get('/subscriptions', 'SubscriberController@index')->name('frizzle.subscriptions.index');
    Route::post('/subscriptions', 'SubscriberController@subscribe')->name('frizzle.subscriptions.subscribe');
    Route::delete('/subscriptions/{subscription}', 'SubscriberController@destroy')->name('frizzle.subscriptions.destroy');
});
