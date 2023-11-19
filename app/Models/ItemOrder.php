<?php

namespace App\Models;

use App\Models\Person;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'barcode',
        'image',
        'establishment',
        'category',
        'brand',
        'person_id',
        'quantity'
    ];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
