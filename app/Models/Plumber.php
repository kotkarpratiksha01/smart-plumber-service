<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plumber extends Model
{
    use HasFactory;

    protected $fillable = ['name','phone','location','services','rating','experience_years','available'];

    protected $casts = [
        'services' => 'array',
        'available' => 'boolean',
        'rating' => 'float',
    ];

    public function servicesList()
    {
        return $this->belongsToMany(\App\Models\Service::class, 'plumber_service');
    }
}
