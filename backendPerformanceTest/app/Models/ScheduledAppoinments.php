<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledAppoinments extends Model
{
    use HasFactory;

    protected $table = 'scheduled_appointments';

    protected $fillable = [
        'user_id',
        'doctor_id',
        'appointment_date',
        'status',
        'reason',
        'created_by',
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
