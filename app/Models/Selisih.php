<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selisih extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'DocId',
        'docnum',
        'docdate',
        'qty',
        'admin',
        'remarks',
        'status',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
