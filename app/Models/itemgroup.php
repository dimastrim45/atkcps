<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'name',
    //     'itemgroup_id',
    //     'uom',
    //     'price',
    //     'expdate',
    //     'qty',
    //     'status',
    // ];

    public function item(){
        return $this->hasMany(Item::class);
    }
}
