<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\BookingCreated;

class bookedconfrenceroom extends Model
{
    use HasFactory;
    protected $primaryKey = 'booked_confrence_room_id';
    protected $casts = [
        'participant_emails' => 'array',
    ];
    protected $dispatchesEvents = [
        'created' => BookingCreated::class,
    ];
}
