<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceHistory extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'coin_id',
        'price_usd',
    ];

    /**
     * @var string
     */
    protected $table = 'price_history';

    /**
     * @var string
     */
    protected $primaryKey = 'id';
}
