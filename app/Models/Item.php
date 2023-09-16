<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'itemgroup_id',
        'uom',
        'price',
        'expdate',
        'qty',
        'status',
    ];

    public function itemgroup(){
        return $this->belongsTo(ItemGroup::class);
    }

    public function barangmasuk(){
        return $this->belongsTo(BarangMasuk::class);
    }

    public function permintaan(){
        return $this->belongsTo(Permintaan::class);
    }
}
