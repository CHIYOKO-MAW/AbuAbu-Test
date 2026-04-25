<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ToolDownload extends Model
{
    protected $fillable = [
        'tool_id',
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

    public function tool(): BelongsTo
    {
        return $this->belongsTo(Tool::class);
    }
}
