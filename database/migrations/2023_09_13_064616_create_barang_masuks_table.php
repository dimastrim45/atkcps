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
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->integer('DocId');
            $table->foreignId('item_id');
            $table->string('docnum');
            $table->date('docdate');
            $table->date('expdate')->nullable();   // 'expdate' field of type date, nullable
            $table->integer('qty');
            $table->integer('price');   // 'price' field of type decimal with precision 
            $table->string('admin');
            $table->string('po_docnum');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};
