<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('moving_averages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('itemIn_id')->nullable();
            $table->integer('qtyIn')->nullable();
            $table->integer('totalIn')->nullable();
            $table->string('DocTypeIn')->nullable();
            $table->string('DocNumIn')->nullable();

            $table->foreignId('itemOut_id')->nullable();
            $table->integer('qtyOut')->nullable();
            $table->integer('totalOut')->nullable();
            $table->string('DocTypeOut')->nullable();
            $table->string('DocNumOut')->nullable();

            $table->foreignId('itemSaldo_id');
            $table->integer('qtySaldo');
            $table->integer('totalSaldo');
            $table->date('docdate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moving_averages');
    }
};
