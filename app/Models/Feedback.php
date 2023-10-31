<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedback_docnum',
        'user_id',
        'admin_id',
        'DocId',
        'docdate',
        'duedate',
        'topic',
        'status',
        'is_read',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin(){
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function chat(){
        return $this->hasMany(Chat::class);
    }
}
