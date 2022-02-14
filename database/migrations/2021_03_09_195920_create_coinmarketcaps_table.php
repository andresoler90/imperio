<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinmarketcapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coinmarketcaps', function (Blueprint $table) {
            $table->id();
            $table->string("currency");
            $table->string("symbol");
            $table->float("price");
            $table->float("volume_24h");
            $table->float("percent_change_1h");
            $table->float("percent_change_24h");
            $table->float("percent_change_7d");
            $table->float("percent_change_30d");
            $table->float("percent_change_60d");
            $table->float("percent_change_90d");
            $table->float("market_cap");
            $table->dateTime("last_updated");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coinmarketcaps');
    }
}
