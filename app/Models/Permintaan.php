<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'DocId',
        'requester',
        'item_id',
        'qty',
        'openqty',
        'price',
        'expdate',
        'docnum',
        'docdate',
        'duedate',
        'status',
        'remarks',
    ];

    protected $dates = ['docdate', 'expdate', 'duedate'];

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pengeluaran(){
        return $this->hasMany(Pengeluaran::class);
    }
}
