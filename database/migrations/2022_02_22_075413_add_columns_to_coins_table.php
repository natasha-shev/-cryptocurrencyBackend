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
        });
    }

    function dropColumnIfExists($column)
    {
        if (Schema::hasColumn('coins', $column))
        {
            Schema::table('coins', function (Blueprint $table) use ($column) {
                $table->dropColumn($column);
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::table('coins', function (Blueprint $table) {
            $table->dropColumnIfExists('name');
            $table->dropColumnIfExists('full_name');
            $table->dropColumnIfExists('icon_url');
            $table->dropColumnIfExists('price_usd');
        });
    }
}
