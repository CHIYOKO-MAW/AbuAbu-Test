<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wishlist extends Model
{
    protected $fillable = [
        'user_id',
        'name',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(WishlistItem::class)->orderBy('position');
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'wishlist_items')
            ->withPivot('position')
            ->orderBy('position');
    }

    public function addAlbum(Album $album): WishlistItem
    {
        $maxPosition = $this->items()->max('position') ?? 0;
        
        return WishlistItem::updateOrCreate(
            [
                'wishlist_id' => $this->id,
                'album_id' => $album->id,
            ],
            [
                'position' => $maxPosition + 1,
            ]
        );
    }

    public function removeAlbum(Album $album): bool
    {
        return WishlistItem::where('wishlist_id', $this->id)
            ->where('album_id', $album->id)
            ->delete() > 0;
    }

    public function hasAlbum(Album $album): bool
    {
        return $this->items()->where('album_id', $album->id)->exists();
    }
}