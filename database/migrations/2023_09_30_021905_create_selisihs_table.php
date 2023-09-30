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
        Schema::create('selisihs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id');
            $table->string('docnum');
            $table->date('docdate');
            $table->integer('qty');
            $table->string('admin');
            $table->string('remarks');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selisihs');
    }
};
