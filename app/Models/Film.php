<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $primaryKey = 'film_id';

    protected $fillable = ['name', 'genre_id', 'director', 'synopsis', 'duration', 'image'];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function showtimes()
    {
        return $this->hasMany(Showtime::class, 'film_id', 'film_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'film_id');
    }
}
