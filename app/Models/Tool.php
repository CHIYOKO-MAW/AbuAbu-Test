<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tool extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'cover_image',
        'cover_alt',
        'vendor',
        'version',
        'category',
        'os',
        'tags',
        'summary',
        'featured',
        'accent',
        'icon',
        'updated_at_date',
        'filesize',
        'checksum',
        'download_count',
        'release_notes',
        'notes',
        'dependencies',
        'release_status',
        'license_state',
        'build_type',
        'archive_notes',
        'screenshots',
        'requirements',
    ];

    protected $casts = [
        'os' => 'array',
        'tags' => 'array',
        'featured' => 'boolean',
        'updated_at_date' => 'date',
        'notes' => 'array',
        'dependencies' => 'array',
        'archive_notes' => 'array',
        'screenshots' => 'array',
        'requirements' => 'array',
    ];

    public function download(): HasOne
    {
        return $this->hasOne(ToolDownload::class);
    }
}
