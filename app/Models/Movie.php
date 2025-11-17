<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movie';

    protected $fillable = [
        'title',
        'description',
        'duration',
        'release_date',
        'poster',
    ];

    protected $hidden = [];

    public function getPosterAttribute($value)
    {
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }

        return $value
            ? asset('storage/'.$value)
            : null;
    }

    public function genre()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
