<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlbumDownload extends Model
{
    protected $fillable = [
        'album_id',
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

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
