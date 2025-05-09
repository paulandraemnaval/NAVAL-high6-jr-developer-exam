<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Brgy extends Model
{
    //

    protected $table = "brgys";
    protected $fillable = [
        'name',
        'city_id'
    ];

    public function city():BelongsTo {
        return $this->belongsTo(City::class,'city_id');
    }

    public function patients():HasMany{
        return $this->hasMany(Patient::class);
    }
}
