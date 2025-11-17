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
        'row',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ['total'];

    /**
     * Calculate total capacity of the theater
     *
     * @return int
     */
    public function getTotalAttribute()
    {
        return $this->section * $this->col * $this->row;
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
