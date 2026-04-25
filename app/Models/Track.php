<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Track extends Model
{
    protected $fillable = [
        'album_id',
        'disc_number',
        'track_number',
        'display_number',
        'title',
        'artist_name',
        'duration',
        'preview_url',
        'sort_order',
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
