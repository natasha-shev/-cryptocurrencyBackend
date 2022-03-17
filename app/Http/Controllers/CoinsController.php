<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\PriceHistory;
use Illuminate\Support\Facades\DB;

class CoinsController extends Controller
{
    /**
     * @return Coin[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function index(){
        $thisUserId = auth('sanctum')->id();
        if ($thisUserId) {
            return DB::table('coins')->select('coins.*', 'user_coin.user_id',
            DB::raw('SUM(IF (action=\'sell\', -1*amount, amount)) as amount'),
            DB::raw('SUM(IF (action=\'sell\', -1*amount*user_coin.price, amount*user_coin.price)) as valuation'))
                ->leftJoin('user_coin', function($join) use ($thisUserId) {
                $join->on('user_coin.coin_id', '=', 'coins.id')
                    ->on('user_coin.user_id', '=', DB::raw($thisUserId));
            })->groupBy('coins.id')->get();
        } else {
            return Coin::all();
        }
    }

    /**
     * @param int $coin_id
     * @return mixed
     */
    public function history(int $coin_id)
    {
       return PriceHistory::where('coin_id', $coin_id)->get();
    }
}
