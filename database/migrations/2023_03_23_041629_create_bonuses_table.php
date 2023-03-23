<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_base');
            $table->unsignedBigInteger('id_user');
            $table->integer('count');
            $table->tinyInteger('type');
            $table->timestamps();

            $table->index('id_base');
            $table->foreign('id_base')->on('culture_bases')->references('id');
            $table->index('id_user');
            $table->foreign('id_user')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonuses');
    }
}
