<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){

        $user = User::where('id', 9)->first();
        return view('admin.orders', ['data' => $user]);
    }
}
