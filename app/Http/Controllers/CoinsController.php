<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Support\Facades\DB;

class CoinsController extends Controller
{
    public function index(){
        $thisUserId = auth('sanctum')->id();
        if ($thisUserId) {
            return DB::table('coins')
                ->leftJoin('user_coin', function($join) use ($thisUserId) {
                    $join->on('user_coin.coin_id', '=', 'coins.id')
                        ->on('user_coin.user_id', '=', DB::raw($thisUserId));
                })
                ->get();
        } else {
            return Coin::all();
        }
    }
}
