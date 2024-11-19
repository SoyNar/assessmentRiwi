<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalSchedule extends Model
{
    use HasFactory;


    protected $table = 'medical_schedule';


    protected $fillable = [
        'user_id',
        'date',
        'available_from',
        'available_to',
        'available',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
