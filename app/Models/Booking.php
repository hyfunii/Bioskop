<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'showtime_id',
        'room_id',
        'booked',
        'user_id',
    ];

    /**
     * Relasi ke model Showtime (1 Booking berhubungan dengan 1 Showtime).
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function showtime()
    {
        return $this->belongsTo(Showtime::class, 'showtime_id', 'showtime_id');
    }

    /**
     * Relasi ke model Room (1 Booking berhubungan dengan 1 Room).
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    /**
     * Relasi ke model Film melalui Showtime (indirect relation).
     */
    public function film()
    {
        return $this->hasOneThrough(Film::class, Showtime::class, 'showtime_id', 'film_id', 'showtime_id', 'film_id');
    }
}
