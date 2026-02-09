<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    protected $guarded = ['created_at', 'updated_at', 'deleted_at', 'id'];

    protected $casts = [
        'featured_image' => 'boolean',
        'is_featured' => 'boolean',
    ];
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

