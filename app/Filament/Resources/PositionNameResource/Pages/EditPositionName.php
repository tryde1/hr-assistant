<?php

namespace App\Filament\Resources\PositionNameResource\Pages;

use App\Filament\Resources\PositionNameResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPositionName extends EditRecord
{
    protected static string $resource = PositionNameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
