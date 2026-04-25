<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlbumFormat extends Model
{
    protected $fillable = [
        'album_id',
        'format',
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
