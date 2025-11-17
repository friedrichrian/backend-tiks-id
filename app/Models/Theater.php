<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    protected $table = 'theater';

    protected $fillable = [
        'name',
        'section',
        'col',
        'row'
    ];

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
