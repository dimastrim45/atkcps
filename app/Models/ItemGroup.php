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
        'isWFG',
        'isWRT',
        'isWRM',
        'isHRG',
        'isDGS',
        'isSLS',
        'isMKT',
        'isDEL',
        'isPRD',
        'isPPI',
        'isRPR',
        'isPCH',
        'isQCT',
    ];

    public function item(){
        return $this->hasMany(Item::class);
    }

    //
}
