<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class Telegram {

    protected $http;
    const $path = 'https://api.telegram.org/bot';

    public function __construct( Http $http)
    {
        $this->http = $http;
    }
    public function sendMessage($chat_id, $message){
   $this->http::post($this->path.'8334372435:AAFsp2AlBsRNTstQTFiVQkqXUbcigrIVm04/sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>$message,
        'parse_mode'=> 'HTML',
    ]);
    }
}
