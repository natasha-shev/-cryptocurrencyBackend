<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUserCoinPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_coin', function (Blueprint $table) {
            $table->decimal('amount');
            $table->date('bought_on')->default(date("Y-m-d H:i:s"));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('user_coin', 'amount')) {
            Schema::table('user_coin', function (Blueprint $table) {
                $table->dropColumn('amount');
            });
        }
        if (Schema::hasColumn('user_coin', 'bought_on')) {
            Schema::table('user_coin', function (Blueprint $table) {
                $table->dropColumn('bought_on');
            });
        }
    }
}
