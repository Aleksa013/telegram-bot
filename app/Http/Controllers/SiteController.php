<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;


class SiteController extends Controller
{
    public function getProductList(ProductService $resolver, $type){
        $model = $resolver->getModel($type);
        return $model::all();
    }
}
