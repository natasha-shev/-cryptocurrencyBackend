<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'full_name',
        'icon_url',
        'price_usd',
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'user_coin');
    }
}
