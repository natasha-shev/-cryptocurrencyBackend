<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPurchasePriceToUserCoinPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_coin', function (Blueprint $table) {
            $table->float('purchase_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('user_coin', 'purchase_price')) {
            Schema::table('user_coin', function (Blueprint $table) {
                $table->dropColumn('purchase_price');
            });
        }
    }
}
