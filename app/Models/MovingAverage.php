<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovingAverage extends Model
{
    use HasFactory;

    protected $fillable = [
        'itemIn_id',
        'qtyIn',
        'totalIn',
        'DocTypeIn',
        'DocNumIn',

        'itemOut_id',
        'qtyOut',
        'totalOut',
        'DocTypeOut',
        'DocNumOut',

        'itemSaldo_id',
        'qtySaldo',
        'totalSaldo',
        'docdate',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'itemSaldo_id');
    }
}
