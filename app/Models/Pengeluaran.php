<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'permintaan_id',
        'DocId',
        'user_id',
        'requester_id',
        'requester_name',
        'admin',
        'item_id',
        'qty',
        'price',
        'expdate',
        'docnum',
        'docdate',
        'status',
        'remarks',
    ];

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function permintaan(){
        return $this->belongsTo(Permintaan::class, 'permintaan_id');
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }
}


