<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAxieCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('axie_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('axie_id')->nullable();
            $table->string('name',300);
            $table->unsignedInteger('attack');
            $table->unsignedInteger('defense');
            $table->unsignedInteger('energy');
            $table->string('description',300);
            $table->string('background_url',300);
            $table->string('effect_icon_url',300);
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
        Schema::dropIfExists('axie_cards');
    }
}
