<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAxiePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('axie_parts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('axie_game_id');
            $table->string('part_axie_id');
            $table->string('name');
            $table->string('class');
            $table->string('type');
            $table->unsignedInteger('match');
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
        Schema::dropIfExists('axie_parts');
    }
}
