<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PositionName extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'salary'
    ];

    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }
}
