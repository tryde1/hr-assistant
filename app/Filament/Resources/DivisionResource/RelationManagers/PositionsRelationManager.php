<?php

namespace App\Filament\Resources\EmployeeResource\RelationManagers;

use App\Models\Employee;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PositionsRelationManager extends RelationManager
{
    protected static string $relationship = 'positions';

    protected static ?string $modelLabel = 'Должность';

    protected static ?string $pluralModelLabel = 'Должности';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('position_name_id')
                    ->label('Должность')
                    ->relationship('positionName', 'name')
                    ->searchable(['name'])
                    ->preload()
                    ->required(),
                Select::make('employee_id')
                    ->label('Сотрудник')
                    ->relationship('employee', 'name')
                    ->searchable(['name', 'passport_series', 'passport_number'])
                    ->getOptionLabelFromRecordUsing(fn (Employee $employee) => "{$employee->name} ({$employee->passport_series} {$employee->passport_number})")
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

    public function table(Table $table): Table
    {
        return $table
            ->heading('Должности')
            ->columns([
                Tables\Columns\TextColumn::make('positionName.name'),
                TextColumn::make('positionName.name')
                    ->label('Должность'),
                TextColumn::make('employee.name')
                    ->sortable()
                    ->searchable()
                    ->label('Сотрудник'),
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
