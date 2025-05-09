<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    //
    protected $fillable = [
        "name",
    ];

    public function brgys():HasMany
    {
        return $this->hasMany(Brgy::class,'city_id');
    } 
}
