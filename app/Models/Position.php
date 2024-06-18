<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'position_name_id',
        'employment_date',
        'dismissal_date',
        'acceptance_document',
        'dismissal_document',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function positionName(): BelongsTo
    {
        return $this->belongsTo(PositionName::class);
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }
}
