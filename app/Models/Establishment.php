<?php

namespace App\Models;

use App\Models\User;
use App\Models\Municipality;
use App\Models\EstablishmentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Establishment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'zone_type',
        'address',
        'user_id',
        'establishment_type_id',
        'municipality_id'
    ];

    public function establishmentType(): BelongsTo
    {
        return $this->belongsTo(EstablishmentType::class);
    }

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
