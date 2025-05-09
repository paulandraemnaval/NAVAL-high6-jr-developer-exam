<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brgy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\CaseType;
use App\CoronavirusType;
use App\Mail\CoronavirusMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class Patient extends Model
{
    //
    protected $casts = [
        'case_type' => CaseType::class,
        'coronavirus_status' => CoronavirusType::class 
    ];
    protected $fillable = [
        "name",
        "brgy_id",
        'number',
        'email',
        'case_type',
        'coronavirus_status'
        ];

        public function brgy():BelongsTo{
            return $this->belongsTo(Brgy::class);
        }

        public function city():BelongsTo{
            return $this->belongsTo(City::class);
        }
    
        protected static function booted()
        {
            static::updated(function ($patient){
                if(
                    $patient->isDirty('case_type')
                ){
                    Mail::to($patient->email)->send(new CoronavirusMail($patient));
                }
            });
        }
}
