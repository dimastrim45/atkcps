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
        Schema::create('item_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->boolean('isENG')->default(false);
            $table->boolean('isFAT')->default(false);
            $table->boolean('isGFG')->default(false);
            $table->boolean('isGRT')->default(false);
            $table->boolean('isGRM')->default(false);
            $table->boolean('isHRGA')->default(false);
            $table->boolean('isDGSL')->default(false);
            $table->boolean('isSLS')->default(false);
            $table->boolean('isMRKT')->default(false);
            $table->boolean('isDEL')->default(false);
            $table->boolean('isPROD')->default(false);
            $table->boolean('isPPIC')->default(false);
            $table->boolean('isRPR')->default(false);
            $table->boolean('isPRCH')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_groups');
    }
};
