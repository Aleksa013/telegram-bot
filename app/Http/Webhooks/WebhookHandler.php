<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\Handlers\WebhookHandler as DefWebhookHandler;
use Illuminate\Support\Stringable;
use Illuminate\Support\Facades\Log;

class WebhookHandler extends DefWebhookHandler
{
    public function __construct()
    {
    Log::info("Мой кастомный WebhookHandler инициализирован!");
    parent::__construct();
    }

    // Обрабатывает простые текстовые сообщения (не-команды)
    protected function handleChatMessage(Stringable $text): void
    {
        Log::info($text);
        // $this->chat — текущий TelegraphChat (модель)
        $this->chat->message("Вы написали: {$text}")->send();
    }

    // Обрабатывает команды /command
    public function home($name): void
    {
        // $this->chat->html("<b>Привет!</b>\n\nЯ — бот на Laravel.")->send();
        $this->chat->message("Hi, {$name}")->send();
        return;

    }
}
