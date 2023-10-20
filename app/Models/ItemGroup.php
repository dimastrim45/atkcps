<?php

namespace App\Models;
//
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'isENG',
        'isFAT',
        'isGFG',
        'isGRT',
        'isGRM',
        'isHRGA',
        'isDGSL',
        'isSLS',
        'isMRKT',
        'isDEL',
        'isPROD',
        'isPPIC',
        'isRPR',
        'isPRCH',
    ];

    public function item(){
        return $this->hasMany(Item::class);
    }

    //
}
