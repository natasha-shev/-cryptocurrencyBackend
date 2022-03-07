<?php

namespace App\Http\Controllers;

use App\Models\Coin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavCoinsController extends Controller
{
    // unnecessary method?
    public function index(){
        return auth('sanctum')->user()->coins;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request) {
        $coin = $request->coinId;
        $user = auth('sanctum')->user();
        return $user->coins()->attach($coin, ['amount' => $request->amount,
            'bought_on' => $request->buyDate,
            'purchase_price' => $request->buyPrice]);
    }


    public function delete(int $coin_id) {
        $user = auth('sanctum')->user();
        return $user->coins()->detach($coin_id);
    }
}
