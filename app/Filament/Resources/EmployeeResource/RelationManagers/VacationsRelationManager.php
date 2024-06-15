<?php

namespace App\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VacationsRelationManager extends RelationManager
{
    protected static string $relationship = 'vacations';

    protected static ?string $modelLabel = 'Отпуск';

    protected static ?string $pluralModelLabel = 'Отпуска';

    protected static ?string $title = 'Отпуска';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('start_date')
                    ->label('Дата начала')
                    ->required(),
                DatePicker::make('end_date')
                    ->label('Дата окончания')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('start_date')
                    ->label('Дата начала')
                    ->date('d.m.Y'),
                TextColumn::make('end_date')
                    ->label('Дата окончания')
                    ->date('d.m.Y'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
