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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feedback_id');
            $table->foreignId('user_id');
            $table->foreignId('staff_id')->nullable();
            $table->text('message'); // Use a text column to store both text messages and image paths
            $table->enum('message_type', ['text', 'image']); // Add a column for message type
            $table->string('image_path')->nullable(); // Add a column for image path
            $table->boolean('is_read')->default(false); // Add the "is_read" field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }

    public function feedback(){
        return $this->belongsTo(Feedback::class, 'feedback_id');
    }
};
