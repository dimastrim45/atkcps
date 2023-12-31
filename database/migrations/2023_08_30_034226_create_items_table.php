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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('itemgroup_id');
            $table->string('name');
            $table->string('uom');      // 'uom' field of type string
            $table->decimal('price', 10, 2);   // 'price' field of type decimal with precision 
            $table->date('expdate')->nullable();   // 'expdate' field of type date, nullable
            $table->integer('qty')->nullable()->default(0);    // 'qty' field of type integer
            $table->integer('min_qty')->nullable()->default(0);
            $table->string('status');  // 'status' field of type string
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
