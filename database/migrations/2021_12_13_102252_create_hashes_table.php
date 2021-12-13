<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hashes', function (Blueprint $table) {
            $table->id();

            $table->string('hash',42);
            $table->string('alias')->nullable();
            $table->integer('total')->nullable();
            $table->integer('claimable')->nullable();
            $table->integer('yesterday')->nullable();
            $table->integer('today_so_far')->nullable();
            $table->integer('average')->nullable();
            $table->integer('elo')->nullable();
            $table->integer('rank')->nullable();
            $table->date('last_claimed')->nullable();
            $table->integer('gained_slp')->nullable();
            $table->integer('max_slp')->nullable();

            $table->unique('hash');

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
        Schema::dropIfExists('hashes');
    }
}
