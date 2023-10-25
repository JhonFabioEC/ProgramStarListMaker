<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Establishment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'name',
    //     'sex',
    //     'breed',
    //     'birth_date',
    //     'weight',
    //     'height',
    //     'image',
    //     'category_id'
    // ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function establishment(): BelongsTo
    {
        return $this->belongsTo(Establishment::class);
    }
}
