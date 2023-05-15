<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Contracts\IChatBotService;
use App\Services\TelegramService;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *     path="/subscribe/chatbot",
 *     summary="Subscribe user to a chatbot",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="user_id", type="string"),
 *                 @OA\Property(property="chatbot_id", type="string"),
 *             ),
 *         ),
 *     ),
 *     @OA\Response(response="200", description="Successfully subscribed"),
 *     @OA\Response(response="400", description="Bad request"),
 * )
 */
class SubscribeController extends Controller
{
    protected IChatBotService $iChatBotService;

    public function __construct(TelegramService $telegramService) {
        $this->iChatBotService = $telegramService;
    }

    public function subscribeToChatbot(Request $request)
    {
        // Implementation for subscribing user to a chatbot
        return $this->iChatBotService->subscribe($request->chatId, $request->userId);
    }

    /**
     * @OA\Post(
     *     path="/subscribe/channel",
     *     summary="Subscribe user to a channel",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="user_id", type="string"),
     *                 @OA\Property(property="channel_id", type="string"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Successfully subscribed"),
     *     @OA\Response(response="400", description="Bad request"),
     * )
     */
    public function subscribeToChannel(Request $request)
    {
        // Implementation for subscribing user to a channel
        return $this->iChatBotService->subscribeToChannel($request->channelId, $request->userId);
    }
}
