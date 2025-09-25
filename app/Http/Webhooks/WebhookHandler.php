<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\Handlers\WebhookHandler as DefWebhookHandler;
use Illuminate\Support\Stringable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\TelegraphBot;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Models\User;


class WebhookHandler extends DefWebhookHandler
{

    public function __construct()
    {
        Log::info('Correct');
    parent::__construct();
    }

    protected function handleChatMessage(Stringable $text): void
    {
        $user = User::where('telegram_id', $this->chat->chat_id)->first();
        Log::error($user.'get text');
        if($user && $user->state == 'waiting_phone') {
            Log::error($user->state.'phone');
            if(preg_match('/^\+?[0-9]{10,15}$/', $text)){
            $user->phone = $text;
            $user->save();
            $this->chat
            ->html("<b>Your phone number</b> :  {$user->phone} ")
            ->keyboard(
                Keyboard::make()->buttons([
                    Button::make('Yes')->action('save'),
                    Button::make('No')->action('addPhone'),
                    ]
                )
            )->send();
            } else {
                $this->chat->message('Incorrect format')->send();
                $this->addPhone();
            }

        }
        if($user && $user->state == 'waiting_address'){
            $city = $user->addresses['city'];
            Log::info($city.$user->state);
            $user->addresses = [
                    'city'=> $city,
                    'address'=> $text,
                ];
            $user->save();
            Log::info($user->addresses);
            $this->chat
            ->html("<b>Your address:</b>
                    <b>City</b>:{$user->addresses['city']}
                    <b>Address</b>:{$user->addresses['address']}")
            ->keyboard(
                Keyboard::make()->buttons([
                    Button::make('Yes')->action('save'),
                    Button::make('No')->action('addAddress'),
                    ]
                )
            )->send();
        }
        if($user && $user->state == 'waiting_name'){
            Log::error($user->state.'name');
            $user->name = $text;
            $user->save();
            $this->chat
            ->html("<b>Your name</b> :  {$user->name} ")
            ->keyboard(
                Keyboard::make()->buttons([
                    Button::make('Yes')->action('save'),
                    Button::make('No')->action('changeName'),
                    ]
                )
            )->send();
        }
        $this->chat->message("Вы написали: {$text}");
    }

    public function save(): void
    {
        $user = User::where('telegram_id', $this->chat->chat_id)->first();;
        $user->state = null;
        $user->save();
        $this->reply('Changes saved');
    }

    protected function handleUnknownCommand(Stringable $text): void
    {
        if($text == '/start'){
            $this->chat->message('Nice to meet you!')->send();
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
        $chatID = $this->chat->chat_id;
        $user = User::where('telegram_id', $this->chat->chat_id)->first();;

        if($user) {
            $this->chat->message('Hello again, '.$user->name)
                ->keyboard(Keyboard::make()->buttons([
                    Button::make('Review')->action('review'),
                    Button::make('See menu')->action('showMenu'),
                ]))->send();
        } else {
           $this->chat->message('Hello!')->
            keyboard(Keyboard::make()->buttons([
                Button::make('Register')->action('registerUser'),
                Button::make('See menu')->action('showMenu'),
            ]))->send();

            $fromArray = $this->message->from()->toArray();
            $name = $fromArray['first_name'].' '.$fromArray['last_name'];
            Log::info($chatID);
            if(!$fromArray['is_bot']){
                User::factory()->create([
                    'name'              => $name,
                    'telegram_id'       => $fromArray['id'],
                    // 'chat_telegram_id'  => $chatID,
                    'email'             => '',
                    'password'          => '',
                    'state'             => null,
                    'phone'             => '',
                    'addresses'         => [],
                    'payment_methods'   => 'cash',
                ]);

            }
        }
    }

    public function settings(){
        $this->chat->message('Your data')->
        keyboard(Keyboard::make()->buttons([
                Button::make('Phone')->action('addPhone'),
                Button::make('Address')->action('addAddress'),
        ]))->send();
    }

    public function registerUser(){
           $this->chat->message('OK! Let`s start! I need your phone and address')->
            keyboard(Keyboard::make()->buttons([
                Button::make('Phone')->action('addPhone'),
                Button::make('Address')->action('addAddress'),
            ]))->send();
    }

        public function addPhone(){
            $user = User::where('telegram_id', $this->chat->chat_id)->first();;
            Log::error($user->state);
            if($user) {
            $user->state = 'waiting_phone';
            $user->save();
             $this->chat->message("Please, get your phone number:")->send();
            }else{
                $this->reply('Something went wrong!');
            }
        }


        public function addAddress(){
            $this->chat->message("Please, choce your city.")
            ->keyboard(
                Keyboard::make()->buttons([
                    Button::make('Burgas')->action('addStreet')->param('city', 'Burgas'),
                    Button::make('Varna')->action('addStreet')->param('city', 'Varna'),
                    Button::make('Sofia')->action('addStreet')->param('city', 'Sofia'),
                    ]
                )
            )->send();

        }

        public function addStreet(){
            $city = $this->data->get('city');
             $user = User::where('telegram_id', $this->chat->chat_id)->first();;
            if($user) {
                $user->state = 'waiting_address';
                $user->addresses = ['city'=>$city];
                $user->save();
            } else {
                $this->reply('Something went wrong!');
            }
            $this->chat->message("Please, Enter the address")->send();

        }


    public function help():void{
        $this->chat->html('I can to learn you everything')->send();
    }

    public function info(){
        $user = User::where('telegram_id', $this->chat->chat_id)->first();;
        Log::info($user);
        $name= $user->name??'Name unknown';
        $phone = $user->phone??'Phone unknown';
        $address = $user->addresses?$user->addresses['city'].", ".$user->addresses['address']:'Address unknown';
        $this->chat->html("<b><i>Your info:</i></b>
                <i>Name:</i> {$name}
                <i>Phone:</i> {$phone}
                <i>Address:</i> {$address}")
                ->keyboard( Keyboard::make()->buttons([
                    Button::make('Yes')->action('save'),
                    Button::make('No')->action('changeInfo'),
                ]))->send();
    }


    public function changeInfo(){
        $this->chat->markdownV2("*What is wrong?*")
                ->keyboard( Keyboard::make()->buttons([
                    Button::make('Name')->action('changeName'),
                    Button::make('Phone')->action('addPhone'),
                    Button::make('Address')->action('addAddress'),
                ]))->send();
    }

    public function changeName(){
            $user = User::where('telegram_id', $this->chat->chat_id)->first();
            if($user) {
            $user->state = 'waiting_name';
            $user->save();
            $this->chat->message("Please, get your correct name ")->send();
            }else{
                $this->reply('Something went wrong!');
            }
    }
}
