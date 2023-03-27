<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisoes', function (Blueprint $table) {
            $table->id();

            $table->integer('pessoa_id')->unsigned();
            $table->integer('carro_id')->unsigned();
            $table->date('data_revisao');
            $table->text('obs');
            $table->foreign('carro_id')->references('id')->on('carros');
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
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
        Schema::dropIfExists('revisoes');
    }
};
