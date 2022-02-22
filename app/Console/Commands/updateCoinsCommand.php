<?php

namespace App\Console\Commands;

use App\Models\Coin;
use Illuminate\Console\Command;

class updateCoinsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:coins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates coins table.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = 'https://min-api.cryptocompare.com/data/top/totaltoptiervolfull?limit=50&tsym=USD';
        $data = json_decode(file_get_contents($url))->Data;
        foreach ($data as $value) {
            if (!isset($value->RAW->USD->PRICE)) {
                continue;
            }
            $coin = Coin::where('name', $value->CoinInfo->Name)->first();
            if ($coin==null) {
                Coin::create([
                    'name' => $value->CoinInfo->Name,
                    'full_name' => $value->CoinInfo->FullName,
                    'icon_url' => 'https://www.cryptocompare.com/' . $value->CoinInfo->ImageUrl,
                    'price_usd' => $value->RAW->USD->PRICE,
                ]);
            } else {
                $coin->update(['price_usd' => $value->RAW->USD->PRICE]);
            }
        }
    }
}
