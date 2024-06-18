<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'passport_series',
        'passport_number',
        'achievement_list',
        'characteristic',
        'experience',
    ];

    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }

    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }

    public function vacations(): HasMany
    {
        return $this->hasMany(Vacation::class);
    }

    public function awards(): HasMany
    {
        return $this->hasMany(Award::class);
    }
}
