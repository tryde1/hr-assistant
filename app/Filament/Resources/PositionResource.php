<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PositionResource\Pages;
use App\Filament\Resources\PositionResource\RelationManagers;
use App\Models\Employee;
use App\Models\Position;
use App\Models\PositionName;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PositionResource extends Resource
{
    protected static ?string $model = Position::class;

    protected static ?string $modelLabel = 'Должность';

    protected static ?string $pluralModelLabel = 'Должности';

    protected static ?string $navigationIcon = 'heroicon-o-identification';

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
                Select::make('position_name_id')
                    ->label('Должность')
                    ->relationship('positionName', 'name')
                    ->searchable(['name'])
                    ->preload()
                    ->required(),
                Select::make('division_id')
                    ->label('Подразделение')
                    ->relationship('division', 'name')
                    ->searchable(['name'])
                    ->preload()
                    ->required(),
                DatePicker::make('employment_date')
                    ->label('Дата принятия')
                    ->default(now())
                    ->required(),
                DatePicker::make('dismissal_date')
                    ->label('Дата увольнения'),
                FileUpload::make('acceptance_document')
                    ->label('Документ о принятии на работу')
                    ->downloadable(true),
                FileUpload::make('dismissal_document')
                    ->label('Документ об увольнении с работы')
                    ->downloadable(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->searchable()
                    ->label('Сотрудник'),
                TextColumn::make('positionName.name')
                    ->searchable()
                    ->label('Должность'),
                TextColumn::make('division.name')
                    ->searchable()
                    ->label('Подразделение'),
                TextColumn::make('employment_date')
                    ->label('Дата принятия')
                    ->date('d.m.Y'),
                TextColumn::make('dismissal_date')
                    ->label('Дата увольнения')
                    ->date('d.m.Y'),
                TextColumn::make('acceptance_document')
                    ->label('Документ о принятии на работу'),
                TextColumn::make('dismissal_document')
                    ->label('Документ об увольнении с работы'),

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
            ])
            ->defaultSort('id', 'DESC');
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
            'index' => Pages\ListPositions::route('/'),
            'create' => Pages\CreatePosition::route('/create'),
            'edit' => Pages\EditPosition::route('/{record}/edit'),
        ];
    }
}
