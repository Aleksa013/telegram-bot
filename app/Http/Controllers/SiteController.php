<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\Review;


class SiteController extends Controller
{
    public function getProductList(ProductService $resolver, $type){
        $model = $resolver->getModel($type);
        return $model::all();
    }

    public function getReviews(){
        $reviews = Review::all();
        return response()->json($reviews);
    }
}
