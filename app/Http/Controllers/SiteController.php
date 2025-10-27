<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\Review;
use App\Models\User;


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

    public function getReview($review){
        $reviewItem = Review::find($review);
        return response()->json($reviewItem);
    }

    public function getUser($id){
        $user = User::find($id);
        return response()->json($user);
    }
}
