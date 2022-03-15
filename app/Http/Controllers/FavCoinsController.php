<?php

namespace App\Http\Controllers;

use App\Models\Coin;

use App\Models\PriceHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'date' => $request->date,
            'price' => $request->price,
            'action' => $request->action]);
    }

    public function delete(int $coin_id) {
        $user = auth('sanctum')->user();
        return $user->coins()->detach($coin_id);
    }

    public function total(Request $request) {
        $user = auth('sanctum')->user();
        $coins = $user->coins()->allRelatedIds();
        return [];
//          return  PriceHistory::select('*')->whereIn('coin_id', $coins)
//                ->leftJoin('user_coin', function($join) use ($user) {
//                    $join->on('coin_id', '=', 'user_coin.coin_id')
//                        ->on('user_coin.user_id', '=', DB::raw($user->id));
//                })
//                ->get();

          // return [smth like 'date', 'total']
    }
}
