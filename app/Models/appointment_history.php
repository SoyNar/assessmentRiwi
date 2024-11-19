<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class appointment_history extends Model
{
    protected $fillable = [
        'scheduled_appoinemnts_id',
        'date',
        'status',
        'notes',


    ];

    public function scheduled_appointments()
    {
        return $this->belongsTo(ScheduledAppoinments::class, 'appoinments_id');
    }
}
