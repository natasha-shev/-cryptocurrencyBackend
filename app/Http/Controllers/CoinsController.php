<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoinsController extends Controller
{
    public function index(){
        $thisUserId = auth('sanctum')->id();
        return DB::table('coins')
            ->leftJoin('user_coin', function($join) use ($thisUserId) {
                $join->on('user_coin.coin_id', '=', 'coins.id')
                    ->on('user_coin.user_id', '=', DB::raw($thisUserId));

            })
            ->get();
    }
}
