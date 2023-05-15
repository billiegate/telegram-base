<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('/subscribe/chatbot', ['as' => 'subscribe.chat', 'uses' => 'V1\SubscribeController@subscribeToChatbot']);
$router->post('/subscribe/channel', ['as' => 'subscribe.channel', 'uses' => 'V1\SubscribeController@subscribeToChannel']);
$router->post('/send/message', ['as' => 'message.send', 'uses' => 'V1\MessageController@sendMessage']);
$router->post('/webhook', ['as' => 'webhook.create', 'uses' => 'V1\WebhookController@create']);
$router->post('/notification', ['as' => 'webhook.notify', 'uses' => 'V1\WebhookController@listen']);