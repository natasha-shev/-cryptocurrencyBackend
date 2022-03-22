<?php

namespace App\Http\Controllers;

use App\Models\Coin;

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

    /**
     * @param int $coin_id
     * @return mixed
     */
    public function delete(int $coin_id) {
        $user = auth('sanctum')->user();
        return $user->coins()->detach($coin_id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function total(Request $request) {
        $user = auth('sanctum')->user();
        return DB::table('price_history AS h')
            ->select(
                DB::raw('DATE_FORMAT(h.created_at, \'%Y-%m-%d %H:%i\') AS datetime'),
                DB::raw('(SUM(IF(uc.action = \'buy\', uc.amount, 0)*h.price_usd) - SUM(IF(uc.action = \'sell\', uc.amount, 0)*h.price_usd)) AS total')
            )
            ->leftJoin('user_coin AS uc', function($join) use ($user)
            {
                $join->on('uc.coin_id', '=', 'h.coin_id');
                $join->on('uc.date','<=', 'h.created_at');
                $join->on('uc.user_id','=', DB::raw($user->id));

            })
            ->whereRaw("h.created_at >= (SELECT MIN(ucc.date) AS minDate FROM user_coin AS ucc WHERE ucc.user_id = {$user->id})")
            ->groupBy('datetime')
            ->orderBy('datetime')
            ->get();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function sales(Request $request) {
        $user = auth('sanctum')->user();
        return DB::table('user_coin AS uc')
            ->select('uc.price', 'uc.date', 'uc.amount', 'c.name', DB::raw('uc.price * uc.amount AS income'))
            ->leftJoin('coins AS c', 'uc.coin_id', '=', 'c.id')
            ->whereRaw("uc.action = 'sell' AND uc.user_id={$user->id}")
            ->get();
    }
}
