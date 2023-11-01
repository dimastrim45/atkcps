<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedback_id',
        'user_id',
        'staff_id',
        'message',
        'message_type',
        'image_path',
        'is_read',
    ];

    public function feedback(){
        return $this->belongsTo(Feedback::class, 'feedback_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
}
