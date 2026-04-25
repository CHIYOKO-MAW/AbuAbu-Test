<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolHelpArticle extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'product',
        'summary',
        'symptoms',
        'steps',
        'related_tools',
    ];

    protected $casts = [
        'symptoms' => 'array',
        'steps' => 'array',
        'related_tools' => 'array',
    ];
}
