<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'title',
        'slug',
        'item_type',
        'preview_text',
        'description',
        'genre',
        'status',
        'portrait',
        'landscape',
        'director',
        'studio',
        'network',
        'countri',
        'episode',
        'duration',
        'featured',
        'rates',
        'view',
        'release_date'
    ];
}
