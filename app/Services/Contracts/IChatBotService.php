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
    public function subscribeToChannel(Request $request);

    /**
     * 
     */
    public function sendMessage(Request $request);

    /**
     * 
     */
    public function webhook(Request $request);
}
