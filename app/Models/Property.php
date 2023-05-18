<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'property_group_id'
    ];

    public function property_group(): BelongsTo
    {
        return $this->belongsTo(PropertyGroup::class);
    }
}
