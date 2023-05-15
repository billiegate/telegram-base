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

$router->post('/subscribe/chatbot', 'V1\SubscribeController@subscribeToChatbot');
$router->post('/subscribe/channel', 'V1\SubscribeController@subscribeToChannel');
$router->post('/send/message', 'V1\MessageController@sendMessage');
$router->post('/webhook', 'V1\WebhookController@receiveWebhook');