<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'city',
        'province',
        'address',
        'status',
    ];

    public function user(){
        return $this->hasMany(User::class);
    }
}
