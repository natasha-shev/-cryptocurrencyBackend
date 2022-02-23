<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;

class CoinsController extends Controller
{
    public function index(){
        return Coin::all();
    }
}
