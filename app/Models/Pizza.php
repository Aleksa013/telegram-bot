<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
        use HasFactory;

    protected $fillable = ['name', 'ingredients', 'image_path', 'price'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function orderItems()
    {
        return $this->morphMany(OrderItem::class, 'product');
    }
}
