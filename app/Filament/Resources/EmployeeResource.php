<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Filament\Resources\EmployeeResource\RelationManagers\PositionsRelationManager;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $modelLabel = 'Сотрудник';

    protected static ?string $pluralModelLabel = 'Сотрудники';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('ФИО')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('Почта')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required(),
                Forms\Components\TextInput::make('passport_series')
                    ->label('Серия паспорта')
                    ->numeric()
                    ->mask('9999')
                    ->length(4)
                    ->required(),
                Forms\Components\TextInput::make('passport_number')
                    ->label('Номер паспорта')
                    ->numeric()
                    ->mask('999999')
                    ->length(6)
                    ->required(),
                Forms\Components\RichEditor::make('achievement_list')
                    ->label('Послужной список'),
                Forms\Components\RichEditor::make('characteristic')
                    ->label('Характеристика'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('ФИО'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Почта'),
                Tables\Columns\TextColumn::make('passport_series')
                    ->label('Серия паспорта'),
                Tables\Columns\TextColumn::make('passport_number')
                    ->label('Номер паспорта'),
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
            PositionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
