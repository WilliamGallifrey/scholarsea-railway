<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAxiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('axies', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('hash_id');
            $table->unsignedInteger('nft_id');
            $table->unsignedInteger('breed_count');
            $table->unsignedInteger('matching_parts');
            $table->unsignedInteger('stage');
            $table->unsignedInteger('hp')->default(0);
            $table->unsignedInteger('skill')->default(0);
            $table->unsignedInteger('speed')->default(0);
            $table->unsignedInteger('morale')->default(0);
            $table->string('class');
            $table->string('name');
            $table->string('image');
            $table->boolean('banned');
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
        Schema::dropIfExists('axies');
    }
}
