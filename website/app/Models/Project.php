<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date',
        'url',
        'image',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
