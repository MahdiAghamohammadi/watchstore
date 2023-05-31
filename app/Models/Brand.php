<?php

namespace App\Models;

use App\Http\Resources\BrandResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image'
    ];

    public static function getAllBrands()
    {
        $brands = self::query()->get();
        return BrandResource::collection($brands);
    }
}
