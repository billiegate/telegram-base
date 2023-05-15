<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
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
    public function subscribeToChatbot(Request $request)
    {
        // Implementation for subscribing user to a chatbot
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
    }
}
