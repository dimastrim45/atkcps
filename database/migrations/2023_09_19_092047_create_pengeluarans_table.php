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
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->integer('DocId');
            $table->foreignId('permintaan_id');
            $table->foreignId('user_id');
            $table->foreignId('requester_id');
            $table->string('requester_name');
            $table->string('admin');
            $table->foreignId('item_id');
            $table->integer('qty')->default(0);
            $table->decimal('price', 10, 2); 
            $table->decimal('subtotal', 15, 2);
            $table->date('expdate')->nullable();
            $table->string('docnum');
            $table->date('docdate');
            $table->string('status');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluarans');
    }
};
