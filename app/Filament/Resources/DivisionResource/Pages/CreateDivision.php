<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\DivisionResource;
use App\Filament\Resources\EmployeeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDivision extends CreateRecord
{
    protected static string $resource = DivisionResource::class;
}
