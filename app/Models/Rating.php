<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $primaryKey = 'rating_id';

    protected $fillable = ['showtime_id', 'film_id', 'user_id', 'rating', 'comment'];

    // Define relationships if necessary
    public function showtime()
    {
        return $this->belongsTo(Showtime::class);
    }

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}