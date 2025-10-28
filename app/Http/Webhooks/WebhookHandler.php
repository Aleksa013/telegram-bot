<?php

namespace App\Http\Webhooks;

use App\Models\Dish;
use DefStudio\Telegraph\Handlers\WebhookHandler as DefWebhookHandler;
use Illuminate\Support\Stringable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\TelegraphBot;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use App\Models\User;
use App\Models\Drink;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pizza;
use App\Models\Product;
use App\Models\Review;
use App\Services\ProductService;
use Carbon\Exceptions\Exception;
use Throwable;

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
        $review = Review::where('user_id', $user->id)->where('text', 'No text')->first();
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
             $this->reply($city);
            $user->addresses = [
                    'city'=> $city,
                    'address'=> $text,
                ];
            $user->save();

            $listOfAddresses = "<b>Your address :</b>
                                    <b>City</b>:{$city}
                                    <b>Address</b>:{$user->addresses['address']}
                                    ";


            $this->chat
            ->html($listOfAddresses)
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
        if($review){
            $this->leaveReviewText($review->id, $text);
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

    public function register()
    {
        $telegraphBot = TelegraphBot::find(3);
        $telegraphBot->registerCommands([
        '/start' => 'for start conversation',
        '/menu' => 'for order',
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
                    Button::make('📒 Review')->action('review'),
                    Button::make('🍽️ See menu')->action('menu'),
                ]))->send();
        } else {
           $this->chat->message('Hello!')->
            keyboard(Keyboard::make()->buttons([
                Button::make('✒️ Register')->action('registerUser'),
                Button::make('🍽️ See menu')->action('menu'),
            ]))->send();

            $fromArray = $this->message->from()->toArray();
            $name = $fromArray['first_name'].' '.$fromArray['last_name'];
            Log::info($chatID);
            if(!$fromArray['is_bot']){
                User::factory()->create([
                    'name'              => $name,
                    'telegram_id'       => $fromArray['id'],
                    'chat_telegram_id'  => $chatID,
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
                Button::make('📱 Phone')->action('addPhone'),
                Button::make('🏠 Address')->action('addAddress'),
        ]))->send();
    }

    public function registerUser(){
           $this->chat->message('OK! Let`s start! I need your phone and address')->
            keyboard(Keyboard::make()->buttons([
                Button::make('📱 Phone')->action('addPhone'),
                Button::make('🏠 Address')->action('addAddress'),
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
        $this->chat->message("Please, choice your city.")
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
        $user = User::where('telegram_id', $this->chat->chat_id)->first();
        if($user) {
            Log::debug('Before', [
    'addresses_type' => gettype($user->addresses),
    'addresses_value' => $user->addresses,
    'casts' => isset($user->casts) ? $user->casts : null,
]);
            Log::error($city);
            $user->state = 'waiting_address';
            // $user->addresses = [];
            $user->addresses = ['city' => $city];
            // $user->addresses[] = [count($user->addresses)=>['city'=>$city]];
            $user->save();
            Log::error($user);
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
                ->keyboard( Keyboard::make()->row([
                    Button::make('✅ Yes')->action('save'),
                    Button::make('⛔ No')->action('changeInfo'),
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

    public function menu()
    {
        $this->chat->message('What do you want to order?')
        ->keyboard(Keyboard::make()->buttons([
        Button::make("🥤 Drink")->action("chooceProduct")->param('type', 'drink'),
        Button::make("🍕 Pizza")->action("chooceProduct")->param('type', 'pizza'),
        Button::make("🍝 Dishes")->action('chooceProduct')->param('type', 'dish'),
        Button::make("📋 Go to site")->url('http://127.0.0.1:8000/'),
    ])->chunk(2))->send();
    }

    public function chooceProduct(ProductService $resolver,$type) {
        $product = $resolver->getModel($type);
        $orders = $product::all();

        $keyboard = Keyboard::make();

        $row = [];
        foreach($orders as $order){
            $row[] = Button::make($order->name)
            ->action('getProduct')
            ->param('id', $order->id)
            ->param('type', $type);

            if (count($row) === 3) {
            $keyboard->row($row);
            $row = [];
            }
        }

        if (!empty($row)) {
            $keyboard->row($row);
        }
        $answer = $this->chat->html('<b>We have : </b>')->keyboard($keyboard->chunk(3))->send();
        Log::error($answer);
    }

    public function getProduct(ProductService $resolver,$id, $type) {
        $product = $resolver->find($type, $id);
        Log::error($product);
        $answer = $this->chat->
            photo('../resources/assets/img/images/'.$product->image_path)->
            html("
            <b>Ingredients: </b>{$product->ingredients}
            <b>Price: </b> {$product->price}")->
            keyboard(Keyboard::make()->row([
                        Button::make("⬅️ Prev")->action("getProduct")->param('id', $id==0?10:$id-1)->param('type', $type),
                        Button::make("🍕 I want it!")->action("makeOrder")->param('id', $id)->param('type', $type),
                        Button::make("➡️ Next")->action("getProduct")->param('id', $id==10?0:$id+1)->param('type', $type),
            ]))->
            send();
        Log::error($answer);
    }

    public function makeOrder(ProductService $resolver,$id, $type) {
        $user = User::where('telegram_id',$this->chat->chat_id)->first();
        $order = Order::where('user_id', $user->id)->where('status', 'new')->first();

        if(!$order){
            try{
            Log::info($this->chat->chat_id);
            $user = User::where('telegram_id',$this->chat->chat_id)->first();
            $order = Order::create([
                'user_id' => $user->id,
                'status' =>'new',
                'items' => [],
                'total' => '0.00',
            ]);

            // $order->save();
            Log::info($order);
            } catch (\Exception $e) {
    Log::error('Order creation failed: ' . $e->getMessage());
}

        }

        $product = $resolver->find($type, $id);

        $answer = $this->chat->message('You want to add to order')
        ->photo('../resources/assets/img/images/'.$product->image_path)
        ->keyboard(Keyboard::make()->row([
                Button::make('✅ Yes')->action('knowQuantity')->param('id', $id)->param('type', $type),
                Button::make('⛔ No')->action("chooceProduct")->param('type', $type),
        ]))
        ->send();
    }

    public function knowQuantity(ProductService $resolver,$id, $type){
        $product = $resolver->find($type, $id);
        $answer = $this->chat->html("<b>How many itmes of {$product->name} do you want?</b>")
                ->keyboard(Keyboard::make()->row([
                    Button::make('One')->action('addIntoOrder')->param('id', $id)->param('type', $type)->param('count', 1),
                    Button::make('Two')->action('addIntoOrder')->param('id', $id)->param('type', $type)->param('count', 2),
                    Button::make('More')->action('writeQuantity')->param('id', $id)->param('type', $type),
                    ]))
                ->send();
        Log::info($answer);
    }

    public function addIntoOrder(ProductService $resolver, $id, $type, $count){
        $product = $resolver->find($type, $id);
        $user = User::where('telegram_id',$this->chat->chat_id)->first();
        $order = Order::where('user_id', $user->id)->where('status', 'new')->first();
        $item = OrderItem::create([
            'order_id'=> $order->id,
            'product_id'=> $product->id,
            'product_type'=>$type,
            'quantity'=>$count,
            'price'=>$product->price
        ]);
        $order->items = array_merge($order->items??[], [$item->id]);
        $order->total = $order->total + ($product->price*$count);
        $order->save();

        $this->chat->html('<b>Something else?</b>')->keyboard(Keyboard::make()->row([
            Button::make('It`s all')->action('saveOrder'),
            Button::make('Yes!')->action('menu')
        ]))->send();
    }

    public function saveOrder(ProductService $resolver){
        $user = User::where('telegram_id',$this->chat->chat_id)->first();
        $order = Order::where('user_id', $user->id)->where('status', 'new')->first();
        $order->save();


        $listOfProduct = "<b>Your order: </b>";
        foreach($order->items as $item){
            $indexOfProduct = OrderItem::find($item)->product_id;
            Log::info($item);
            $product = $resolver->find(OrderItem::find($item)->product_type, $indexOfProduct);
            $type = OrderItem::find($item)->product_type;
            $quantity = OrderItem::find($item)->quantity;

            $listOfProduct .= "
            <b>{$type} : {$product->name}</b> - {$quantity} items  " ;
        }

        try{
            $this->chat->html($listOfProduct . "
            <b>Total price: </b> <i>{$order->total}</i>" )->
            keyboard(Keyboard::make()->row([
                Button::make('🏃🏻 Order')->action('checkAddress'),
                Button::make('📝 Correct the Order')->action('CorrectOrder')
                ]))->send();
        }catch(\Exception $error){
            Log::error($error);
        }

    }

    public function checkAddress()
    {
        try{
            $user = User::where('telegram_id',$this->chat->chat_id)->first();
        $address = $user->getAddress();

        $this->chat->html("<b>Your address: </b> " .($address?$address['address']: 'no address'))->
            keyboard(Keyboard::make()->row([
                Button::make('✅Yes')->action('saveOrder'),
                Button::make("📝 I want change address")->action('addAddress')
            ]))->send();
        }catch(Throwable $error){
            Log::error($error);
        }

    }

    public function review(){
        $this->chat->message('Please, leave a review (from 1 to 5 stars)')
        ->keyboard(Keyboard::make()->row([
            Button::make('1⭐')->action('leaveReview')->param('stars', 1),
            Button::make('2⭐')->action('leaveReview')->param('stars', 2),
            Button::make('3⭐')->action('leaveReview')->param('stars', 3),
            Button::make('4⭐')->action('leaveReview')->param('stars', 4),
            Button::make('5⭐')->action('leaveReview')->param('stars', 5),
        ]))->send();

    }

    public function leaveReview($stars){
        $user = User::where('telegram_id',$this->chat->chat_id)->first();
        $review =Review::create([
            'user_id' => $user->id,
            'stars' => $stars,
            'text' => 'No text',
        ]);
        $this->chat->message('What do you like most, '.$user->name.'?')->send();
    }

    public function leaveReviewText($review, $text){
        $review = Review::find($review);
        $review->text = $text;
        $review->save();
        $this->chat->message('Thank you for your review')->send();
    }
}
