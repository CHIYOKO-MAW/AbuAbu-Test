<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class RequestStore
{
    public static function store(): array
    {
        return config('request', []);
    }

    public static function requests(): Collection
    {
        if (! self::databaseIsReady()) {
            return collect();
        }

        return \App\Models\IntakeRequest::query()
            ->orderByDesc('created_at')
            ->get()
            ->map(fn (\App\Models\IntakeRequest $request) => self::requestViewModel($request))
            ->values();
    }

    protected static function databaseIsReady(): bool
    {
        try {
            return Schema::hasTable('intake_requests');
        } catch (\Throwable) {
            return false;
        }
    }

    protected static function requestViewModel(\App\Models\IntakeRequest $request): array
    {
        return [
            'id' => $request->id,
            'title' => $request->title,
            'category' => $request->category,
            'source' => $request->source,
            'notes' => $request->notes,
            'priority' => $request->priority,
            'status' => $request->status,
            'created_at' => $request->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
