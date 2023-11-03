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
        Schema::create('permintaans', function (Blueprint $table) {
            $table->id();
            $table->integer('DocId');
            $table->foreignId('user_id');
            $table->string('requester');
            $table->foreignId('item_id');
            $table->integer('qty')->default(0);
            $table->integer('openqty')->default(0);
            $table->decimal('price', 10, 2);   // 'price' field of type decimal with precision 
            $table->date('expdate')->nullable();   // 'expdate' field of type date, nullable
            $table->string('docnum');
            $table->date('docdate');
            $table->date('duedate');
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
        Schema::dropIfExists('permintaans');
    }

};
