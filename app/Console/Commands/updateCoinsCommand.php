<?php

namespace App\Console\Commands;

use App\Models\Coin;
use App\Models\PriceHistory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

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
        $names = implode(',', Coin::pluck('name')->toArray());
        $url = 'https://min-api.cryptocompare.com/data/pricemulti?fsyms='.$names.'&tsyms=USD,EUR';
        $data = Http::get($url)->json();
        foreach ($data as $key => $value) {
            if (!isset($value["USD"])) {
                continue;
            }
            $coin = Coin::where('name', $key)->first();
            $coin->update(['price_usd' => $value["USD"]]);
            PriceHistory::create([
                'coin_id' => $coin->id,
                'price_usd' => $value["USD"]
                ]);
        }
    }
}
