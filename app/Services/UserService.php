<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

class UserService
{
    protected $table = 'users';

    /**
     * Create/Update User
     *
     * $params = [
     *   'chat_id'          => '',
     *   'user_id'          => '',
     *   'first_name'       => '',
     *   'last_name'        => '',
     *   'user_name'        => '',
     * ];
     *
     * @param  array  $params
     *
     * @return Model|object|static|null
     *
     */
    public function persist($params)
    {
        $userID  = $params['user_id'];
        $chatID = $params['chat_id'];
        $user    = $this->getUser($userID, $chatID);
        $now     = date('Y-m-d H:i:s');

        $params['updated_at'] = $now;
        if($user) {
            $affected = DB::table($this->table)
                          ->where('user_id', $userID)
                          ->where('chat_id', $chatID)
                          ->update($params);
        } else {
            $params['created_at'] = $now;
            $affected             = DB::table($this->table)->insert($params);
        }

        if($affected)
            return $this->getUser($userID, $chatID);
        elseif($user)
            return $user;
        else
            return false;
    }

    /**
     * Get user by Telegram user ID
     *
     * @param  Integer  $userID  User ID
     * @param  Integer  $chatID  Group ID
     *
     * @return Model|object|static|null
     */
    public function getUser($userID, $chatID)
    {
        return DB::table($this->table)
                 ->where('user_id', $userID)
                 ->where('chat_id', $chatID)
                 ->first();
    }

    /**
     * Get all users
     *
     * @param  
     *
     * @return Collection|object|null
     */
    public function getChats()
    {
        return DB::table($this->table)->select('chat_id')->distinct()->get();
    }

    
}