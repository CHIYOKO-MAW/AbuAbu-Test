<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ReadingItem extends Model
{
    protected $fillable = [
        'type',
        'slug',
        'title',
        'author',
        'year',
        'topic',
        'published_at',
        'updated_at_date',
        'summary',
        'abstract',
        'publisher',
        'pages',
        'format',
        'cover_image',
        'cover_alt',
        'cover_palette',
    ];

    protected $casts = [
        'published_at'   => 'date',
        'updated_at_date' => 'date',
        'cover_palette'  => 'array',
    ];

    public function download(): HasOne
    {
        return $this->hasOne(ReadingDownload::class);
    }
}
