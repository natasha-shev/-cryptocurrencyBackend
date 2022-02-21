<?php

namespace App\Http\Controllers;

use App\Models\Coin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavCoinsController extends Controller
{
    public function index(){
        return auth('sanctum')->user()->coins;
    }

    public function store(Coin $coin){
        return auth('sanctum')->user()->coins()->toggle($coin);
    }
}
