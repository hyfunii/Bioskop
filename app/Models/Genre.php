<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $primaryKey = 'genre_id';

    protected $fillable = [
        'name',
    ];

    public function films()
    {
        return $this->hasMany(Film::class, 'genre_id');
    }
}
