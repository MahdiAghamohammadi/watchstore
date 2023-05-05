<?php

namespace App\Models;

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
}
