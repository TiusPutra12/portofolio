<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationSub extends Model
{
    use HasFactory;

    protected $fillable = [
        'education_id',
        'institution',
        'start_date',
        'end_date',
        'start_year',
        'end_year',
        'supervisor',
        'status',
        'description',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function education()
    {
        return $this->belongsTo(Education::class);
    }
}
