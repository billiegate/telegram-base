<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Contracts\IChatBotService;
use App\Services\TelegramService;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *     path="/send/message",
 *     summary="Send message to subscribers",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="message", type="string"),
 *                 @OA\Property(property="subscribers", type="array", @OA\Items(type="string")),
 *             ),
 *         ),
 *     ),
 *     @OA\Response(response="200", description="Successfully sent"),
 *     @OA\Response(response="400", description="Bad request"),
 * )
 */
class MessageController extends Controller
{
    protected IChatBotService $iChatBotService;

    public function __construct(TelegramService $telegramService) {
        $this->iChatBotService = $telegramService;
    }
    
    public function sendMessage(Request $request)
    {
        return $this->iChatBotService->sendMessage($request);
    }
}
