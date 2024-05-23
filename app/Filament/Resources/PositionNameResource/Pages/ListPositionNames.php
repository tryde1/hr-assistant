<?php

namespace App\Filament\Resources\PositionNameResource\Pages;

use App\Filament\Resources\PositionNameResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPositionNames extends ListRecords
{
    protected static string $resource = PositionNameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
