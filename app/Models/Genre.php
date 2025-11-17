<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genre';

    protected $fillable = [
        'name'
    ];

    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    public function movie()
    {
        return $this->belongsToMany(Movie::class);
    }
}
