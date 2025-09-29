<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'travel_category_id',
        'filename',
        'original_name',
        'file_path',
        'title',
        'description'
    ];

    public function category()
    {
        return $this->belongsTo(TravelCategory::class, 'travel_category_id');
    }

    public function getUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
}
