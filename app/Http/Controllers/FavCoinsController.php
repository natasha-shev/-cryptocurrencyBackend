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

    public function store(Request $request) {
        $coin = $request->coinId;
        $user = auth('sanctum')->user();
        if($user->coins->contains($coin)) {
           return $user->coins()->detach($coin);
        } else {
            return $user->coins()->attach($coin, ['amount' => $request->amount,
                'bought_on' => $request->buyDate,
                'purchase_price' => $request->buyPrice]);
        }
    }
}
