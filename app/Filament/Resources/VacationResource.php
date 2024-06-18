<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VacationResource\Pages;
use App\Models\Employee;
use App\Models\Vacation;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VacationResource extends Resource
{
    protected static ?string $model = Vacation::class;

    protected static ?string $modelLabel = 'Отпуск';

    protected static ?string $pluralModelLabel = 'Отпуска';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('employee_id')
                    ->label('Сотрудник')
                    ->relationship('employee', 'name')
                    ->searchable(['name', 'passport_series', 'passport_number'])
                    ->getOptionLabelFromRecordUsing(fn (Employee $employee) => "{$employee->name} ({$employee->passport_series} {$employee->passport_number})")
                    ->preload()
                    ->required(),
                DatePicker::make('start_date')
                    ->label('Дата начала')
                    ->required(),
                DatePicker::make('end_date')
                    ->label('Дата окончания')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->searchable()
                    ->label('Сотрудник'),
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
            'index' => Pages\ListVacations::route('/'),
            'create' => Pages\CreateVacation::route('/create'),
            'edit' => Pages\EditVacation::route('/{record}/edit'),
        ];
    }
}
