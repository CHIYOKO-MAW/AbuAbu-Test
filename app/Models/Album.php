<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Album extends Model
{
    protected $fillable = [
        'artist_id',
        'title',
        'slug',
        'type',
        'genre',
        'formats',
        'release_date',
        'originated',
        'label',
        'duration',
        'featured',
        'recommended',
        'cover_image',
        'cover_alt',
        'cover_palette',
        'cover_accent',
        'spec_audio',
        'spec_note',
        'bit_depth',
        'sample_rate',
        'editor_notes',
    ];

    protected $casts = [
        'formats' => 'array',
        'release_date' => 'date',
        'originated' => 'date',
        'featured' => 'boolean',
        'recommended' => 'boolean',
        'cover_palette' => 'array',
    ];

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    public function tracks(): HasMany
    {
        return $this->hasMany(Track::class)->orderBy('sort_order');
    }

    public function albumFormats(): HasMany
    {
        return $this->hasMany(AlbumFormat::class);
    }

    public function download(): HasOne
    {
        return $this->hasOne(AlbumDownload::class);
    }
}
