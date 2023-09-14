<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'docnum',
        'docdate',
        'qty',
        'admin',
        'po_docnum',
        'expdate',
        'remarks',
    ];

    public function item(){
        return $this->hasMany(Item::class);
    }
}
