<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\Handlers\WebhookHandler as DefWebhookHandler;
use Illuminate\Support\Stringable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\TelegraphBot;


class WebhookHandler extends DefWebhookHandler
{
    public function __construct()
    {
    Log::info("Мой кастомный WebhookHandler инициализирован!");
    parent::__construct();
    }

    protected function handleChatMessage(Stringable $text): void
    {
        Log::info($text);
        $this->reply("Вы написали: {$text}");
    }

    public function home(Stringable $name): void
    {
        $this->chat->message("Hi, {$name}")->send();
    }

    protected function handleUnknownCommand(Stringable $text): void
    {
        if($text == '/start'){
            $this->chat->message('Nice to meet you!')->send();
        }else if($text == '/hello'){
            $this->home(Str::of("Mia"));
        }else if($text == '/register'){
            $this->register();
        } else {
            $this->reply('Unsupport command!');
        }
    }

    public function register(){
        $telegraphBot = TelegraphBot::find(3);
        $telegraphBot->registerCommands([
        '/start' => 'for start conversation',
        '/help' =>  'what can I do?',
        '/settings' => 'your settings',
        '/info' => 'Most important info'
        ])->send();
    }

    public function start():void{
        $this->chat->message('Hello!')->send();
        Log::info($this->chat->name);
        $name = explode(']',$this->chat->name??'')[1];
        Log::info($name);
        $this->reply('Nice to meet You, ' .$name .'!');

    }

    public function help():void{
        $this->chat->html('I can to learn you everything')->send();
    }

    public function settings():void
    {

    }
}
