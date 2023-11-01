<?php

namespace App\Models;

use App\Models\Establishment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstablishmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state'
    ];

    public function establishments(): HasMany
    {
        return $this->hasMany(Establishment::class);
    }
}
