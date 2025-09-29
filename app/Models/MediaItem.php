<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    protected $fillable = [
        'media_category_id',
        'type',
        'title',
        'content',
        'description',
        'thumbnail',
        'sort_order',
        'is_active'
    ];

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function category()
    {
        return $this->belongsTo(MediaCategory::class, 'media_category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
