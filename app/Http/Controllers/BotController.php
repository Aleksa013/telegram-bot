<?php

namespace App\Http\Controllers;

use DefStudio\Telegraph\Models\TelegraphChat;
use DefStudio\Telegraph\DTO\Update;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BotController extends Controller
{
    public function sendHello()
    {
        $chatId = env('TELEGRAM_ID');

        $chat = TelegraphChat::findOrFail($chatId);
        return $chat->message("Hello from Laravel")->send();
    }
}
