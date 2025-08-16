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
            $table->boolean('isWFG')->default(false);
            $table->boolean('isWRT')->default(false);
            $table->boolean('isWRM')->default(false);
            $table->boolean('isHRG')->default(false);
            $table->boolean('isDGS')->default(false);
            $table->boolean('isSLS')->default(false);
            $table->boolean('isMKT')->default(false);
            $table->boolean('isDEL')->default(false);
            $table->boolean('isPRD')->default(false);
            $table->boolean('isPPI')->default(false);
            $table->boolean('isRPR')->default(false);
            $table->boolean('isPCH')->default(false);
            $table->boolean('isQCT')->default(false);
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
