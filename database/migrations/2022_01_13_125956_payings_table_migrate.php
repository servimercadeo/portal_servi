<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PayingsTableMigrate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payings2', function (Blueprint $table) {
            $table->id();
            $table->string('operation');
            $table->string('_link');
            $table->string('tipo');
            $table->string('periodo');
            $table->foreignId('id_pais')->constrained('paises')->nullable();
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
        Schema::dropIfExists('payings2');
    }
}
