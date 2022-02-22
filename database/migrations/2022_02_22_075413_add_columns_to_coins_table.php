<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coins', function (Blueprint $table) {
            $table->string('name');
            $table->string('full_name');
            $table->text('icon_url');
            $table->float('price_usd');
            $table->text('additional_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coins', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('full_name');
            $table->dropColumn('icon_url');
            $table->dropColumn('price_usd');
            $table->dropColumn('additional_data');
        });
    }
}
