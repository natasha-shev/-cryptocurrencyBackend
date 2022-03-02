<?php

namespace Database\Seeders;

use App\Models\Coin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CoinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url = 'https://min-api.cryptocompare.com/data/top/mktcapfull?limit=50&tsym=USD';
        $data = Http::get($url)->json()["Data"];
        foreach ($data as $value) {
            if (!isset($value["RAW"]["USD"]["PRICE"])) {
                continue;
            }
            Coin::create([
                'name' => $value["CoinInfo"]["Name"],
                'full_name' => $value["CoinInfo"]["FullName"],
                'icon_url' => 'https://www.cryptocompare.com/' . $value["CoinInfo"]["ImageUrl"],
                'price_usd' => $value["RAW"]["USD"]["PRICE"],
            ]);
        }
    }
}
