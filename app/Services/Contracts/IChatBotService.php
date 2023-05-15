<?php

namespace App\Services\Contracts;

use Illuminate\Http\Request;

interface IChatBotService
{
    /**
     * 
     */
    public function subscribe(String $chatId, String $userId);

    /**
     * 
     */
    public function subscribeToChannel(String $channelId, String $userId);

    /**
     * 
     */
    public function sendMessage(Request $request);

    /**
     * 
     */
    public function webhook(Request $request);

    /**
     * 
     */
    public function setWebhook(String $url);
    
}
