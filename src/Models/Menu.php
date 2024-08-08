<?php

namespace MrVaco\Orchid\Menu\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;

class Menu extends Model
{
    use AsSource;

    protected $fillable = [
        'parent_id',
        'name',
        'description',
        'slug',
        'target',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function scopeWithoutCurrent(Builder $query, int $id): Builder
    {
        return $query->where('id', '!=', $id);
    }
}
