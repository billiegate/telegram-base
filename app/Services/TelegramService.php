<?php

namespace App\Services;

use App\Services\Contracts\IChatBotService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
// use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;
class TelegramService implements IChatBotService
{

    use ResponseTrait;

    protected $telegram, $user;

    /**
     * Create a new controller instance.
     *
     * @param $telegram Api
     *
     * @return void
     */
    public function __construct(
        // Api $telegram, 
        UserService $userService
    )
    {
        $this->telegram = Telegram::bot('common');
        $this->user  = $userService;
    }


    /**
     * 
     */
    public function subscribe($chatId, $userId) {

        try {
            $member = $this->telegram->getChatMember([
                'user_id' => $userId,
                'chat_id' => $chatId
            ]);
            $user = $member["user"];
            $firstName = isset($user['first_name']) ? $user['first_name'] : null;
            $LastName  = isset($user['last_name']) ? $user['last_name'] : null;
            $userName  = isset($user['username']) ? $user['username'] : null;
        
            $user = $this->user->persist(array(
                'chat_id'   => $chatId,
                'user_id'    => $userId,
                'first_name' => $firstName,
                'last_name'  => $LastName,
                'user_name'  => $userName,
            ));
        
            return $this->successResponse($user, "User subscribed");
        } catch (\Exception $e) {
            return $this->errorResponse([], $e->getMessage().', '.$e->getFile().', '.$e->getLine());
        }
    
    }

    /**
     * 
     */
    public function subscribeToChannel(String $channelId, String $userId) {
        
        try {
            $add = $this->telegram->addChatMember([
                'chat_id' => $channelId,
                'user_id' => $userId
            ]);

            return $this->subscribe($channelId, $userId);
        } catch (\Exception $e) {
            return $this->errorResponse([], $e->getMessage().', '.$e->getFile().', '.$e->getLine());
        }
    }

    /**
     * 
     */
    public function sendMessage(Request $request) {

        // if no channel to send a message, we assume the message is intended for all users
       
        try {
            if ( $request->chatId ) {
                $this->telegram->sendMessage([
                    'chat_id'   => $request->chatId,
                    'text'      => $request->text
                ]);
            } else {
                $users = $this->user->getChats();
                foreach ($users as $user) {
                    $this->telegram->sendMessage([
                        'chat_id'   => $user->chat_id,
                        'text'      => $request->text
                    ]);
                }
            }

            return $this->successResponse([], "Message sent!");

        } catch (\Exception $e) {
            return $this->errorResponse([], $e->getMessage().', '.$e->getFile().', '.$e->getLine());
        }
    }

    /**
     * 
     */
    public function setWebhook($url) {
        try {
            $url        = env('TELEGRAM_WEBHOOK_URL', url('/'));
            $response   = $this->telegram->setWebhook([
                'url' => $url,
                //'allowed_updates' => ['message', 'inline_query', 'chosen_inline_result', 'callback_query'] // Dont supported in current version of irazasyed/telegram-bot-sdk 3.0
            ]);
            if ($response)
                return $this->successResponse($response, 'Set Webhook Successfully.');
            else
                return $this->errorResponse([], 'Set Webhook with Error!');

        } catch (\Exception $e) {
            return $this->errorResponse([], $e->getMessage().', '.$e->getFile().', '.$e->getLine());
        }
    }


    /**
     * 
     */
    public function webhook(Request $request) {

        $params = $this->telegram->getWebhookUpdate();
        
        if (isset($params['message']['left_chat_member']))
            exit();

        $allowedCommands  = explode(',', env('TELEGRAM_BOT_ALLOWED_COMMANDS', ''));

        if (
            !isset($params['message']['chat']['id']) ||
            !in_array($params['message']['chat']['type'], ['group', 'supergroup']) ||
            $params['message']['from']['is_bot']
        )
            exit();

        $isNewChatMember = isset($params['message']['new_chat_member']);
        $text            = isset($params['message']['text']) ? trim($params['message']['text']) : false;
        $command         = $text && substr($text, 0, 1) === '/' ? explode(' ', $text)[0] : false;
        $command         = $command ? str_replace('/', '', $command) : '';
        $isSubscribeCommand  = in_array($command, $allowedCommands) && $command === "subscribe"; // or start or anything

        if ( $isNewChatMember && $isSubscribeCommand ) {

            $chatId       = $params['message']['chat']['id'];
            $from          = $params['message']['from'];
            $fromId        = $from['id'];

            return $this->subscribe($chatId, $fromId);
        }

        echo $text;

    }
}
