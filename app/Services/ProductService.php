<?php

namespace App\Services;

use App\Models\Pizza;
use App\Models\Drink;
use App\Models\Dish;
use Illuminate\Database\Eloquent\Model;

class ProductService {
    public function getModel(string $type): string
    {
        return match ($type) {
            'pizza' => Pizza::class,
            'drink' => Drink::class,
            'dish'  => Dish::class,
            default => throw new \InvalidArgumentException("Unknown product type: $type"),
        };
    }

    public function find(string $type, int $id): ?Model
    {
        $modelClass = $this->getModel($type);
        return $modelClass::find($id);
    }
}
