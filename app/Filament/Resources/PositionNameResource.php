<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PositionNameResource\Pages;
use App\Filament\Resources\PositionNameResource\RelationManagers;
use App\Models\PositionName;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PositionNameResource extends Resource
{
    protected static ?string $model = PositionName::class;

    protected static ?string $modelLabel = 'Штатное расписание';

    protected static ?string $pluralModelLabel = 'Штатное расписание';

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->name('Наименование')
                    ->required(),
                Forms\Components\TextInput::make('salary')
                    ->name('Зарплата (₽)')
                    ->numeric()
                    ->minValue(0)
                    ->inputMode('decimal')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Наименование'),
                Tables\Columns\TextColumn::make('salary')
                    ->label('Зарплата (₽)'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPositionNames::route('/'),
            'create' => Pages\CreatePositionName::route('/create'),
            'edit' => Pages\EditPositionName::route('/{record}/edit'),
        ];
    }
}
