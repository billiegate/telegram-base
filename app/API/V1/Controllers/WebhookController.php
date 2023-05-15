<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Contracts\IChatBotService;
use App\Services\TelegramService;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *     path="/webhook/create",
 *     summary="Create a webhook url",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="url", type="string"),
 *             ),
 *         ),
 *     ),
 *     @OA\Response(response="200", description="Successfully created"),
 *     @OA\Response(response="400", description="Bad request"),
 * )
 */
class WebhookController extends Controller
{
    protected IChatBotService $iChatBotService;

    public function __construct(TelegramService $telegramService) {
        $this->iChatBotService = $telegramService;
    }

    public function create(Request $request)
    {
        return $this->iChatBotService->setWebhook($request->url);
    }

    /**
     * @OA\Post(
     *     path="/notification",
     *     summary="Recieves a webhook notification",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="ok"),
     * )
     */
    public function listen(Request $request)
    {
        return $this->iChatBotService->webhook($request);
    }
}
