<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_en',
        'slug',
        'price',
        'review',
        'count',
        'image',
        'guaranty',
        'discount',
        'description',
        'is_special',
        'special_expire',
        'status',
        'category_id',
        'brand_id'
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'color_product');
    }
    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'product_property');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
