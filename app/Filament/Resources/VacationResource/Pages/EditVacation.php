<?php

namespace App\Filament\Resources\VacationResource\Pages;

use App\Filament\Resources\VacationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVacation extends EditRecord
{
    protected static string $resource = VacationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
