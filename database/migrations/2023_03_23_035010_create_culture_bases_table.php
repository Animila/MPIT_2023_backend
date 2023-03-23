<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCultureBasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('culture_bases', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('url');
            $table->integer('countPeople');
            $table->integer('price');
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
        Schema::dropIfExists('culture_bases');
    }
}
