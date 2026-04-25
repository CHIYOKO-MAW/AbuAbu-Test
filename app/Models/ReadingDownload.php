<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReadingDownload extends Model
{
    protected $fillable = [
        'reading_item_id',
        'enabled',
        'disk',
        'path',
        'filename',
        'label',
        'size',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function readingItem(): BelongsTo
    {
        return $this->belongsTo(ReadingItem::class);
    }
}
