<?php

namespace App\Models;

use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'parent_id',
    ];

    public function parent(): BelongsTo
    {
        return $this
            ->belongsTo(self::class, 'parent_id', 'id')
            ->withDefault(['title' => '-------']);
    }

    public function child(): HasMany
    {
        return $this
            ->hasMany(self::class, 'parent_id', 'id');
    }

    public static function getAllCategories()
    {
        $categories = self::query()->get();
        return CategoryResource::collection($categories);
    }
}
