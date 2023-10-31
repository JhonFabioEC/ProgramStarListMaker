<?php

namespace App\Models;

use App\Models\Municipality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    public function municipalities(): HasMany
    {
        return $this->hasMany(Municipality::class);
    }
}
