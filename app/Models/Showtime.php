<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory;

    protected $primaryKey = 'showtime_id';
    protected $fillable = ['film_id', 'room_id', 'showtime'];

    // Relasi ke model Film
    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id', 'film_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'film_id', 'film_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'showtime_id', 'showtime_id');
    }

}