<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'DocId',
        'docnum',
        'docdate',
        'qty',
        'price',
        'admin',
        'po_docnum',
        'expdate',
        'remarks',
        'status',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
