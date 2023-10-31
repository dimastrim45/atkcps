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
        'message',
        'message_type',
        'image_path',
    ];

    public function feedback(){
        return $this->belongsTo(Feedback::class, 'feedback_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
}
