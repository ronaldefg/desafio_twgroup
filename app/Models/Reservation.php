<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'date',
        'time',
        'end_time',
        'status',
    ];

    protected $attributes = [
        'status' => 'Pendiente',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public static function isRoomAvailable($roomId, $reservationDate, $startTime)
    {
        $endTime = date("H:i:s", strtotime($startTime) + 3600);

        return !self::where('room_id', $roomId)
            ->where('date', $reservationDate)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime]);
            })->exists();
    }
}
