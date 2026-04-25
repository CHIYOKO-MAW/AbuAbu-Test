<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntakeRequest extends Model
{
    protected $fillable = [
        'title',
        'category',
        'source',
        'notes',
        'priority',
        'status',
    ];
}
