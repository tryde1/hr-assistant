<?php

namespace App\Filament\Pages;

use App\Models\Employee;
use Carbon\CarbonPeriod;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use App\Models\Timesheet as TimesheetModel;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Collection;

class Timesheet extends Page
{
    protected static ?string $title = 'Табель';

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    protected static string $view = 'filament.pages.timesheet';

    public ?array $data = [];

    protected Collection $employees;

    protected array $dates;

    public function __construct()
    {
        $this->employees = Employee::with('timesheets', 'awards')->get();
        $period = CarbonPeriod::create(now()->startOfMonth(), now()->endOfMonth());
        foreach ($period as $date) {
            $this->dates[] = $date;
        }
    }

    public function mount(): void
    {
        $data = [];
        foreach ($this->employees as $employee) {
            $data[$employee->id] = $employee->timesheets->where('date', now()->format('Y-m-d'))->first();
        }

        $this->form->fill($data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchema())
            ->statePath('data');
    }

    protected function getFormSchema(): array
    {
        $checkboxes = [];
        foreach ($this->employees as $employee) {
            $checkboxes[] = Checkbox::make($employee->id)->label('');
        }

        return $checkboxes;
    }

    public function submit(): void
    {
        $checkedEmployees = TimesheetModel::where('date', '=', now()->format('Y-m-d'))->pluck('employee_id')->toArray();

        $employeesToCheck = array_keys(array_filter($this->data, static function ($presence, $employeeId) use ($checkedEmployees) {
            return $presence && !in_array((int)$employeeId, $checkedEmployees, true);
        }, ARRAY_FILTER_USE_BOTH));
        $employeesToUncheck = array_keys(array_filter($this->data, static function ($presence, $employeeId) use ($checkedEmployees) {
            return !$presence && in_array((int)$employeeId, $checkedEmployees, true);
        }, ARRAY_FILTER_USE_BOTH));

        $dataToInsert = array_map(static function ($employeeId) {
            return ['date' => now()->format('Y-m-d'), 'employee_id' => $employeeId];
        }, $employeesToCheck);

        TimesheetModel::insert($dataToInsert);
        TimesheetModel::where('date', '=', now()->format('Y-m-d'))
            ->whereIn('employee_id', $employeesToUncheck)
            ->delete();

        Notification::make()
            ->title('Сохранено')
            ->success()
            ->send();
    }

    protected function getViewData(): array
    {
        return [
            'employees' => $this->employees,
            'dates' => $this->dates
        ];
    }

    protected function getTableActions(): array
    {
        $actions = [];
        $startOfMonth = now()->startOfMonth()->format('Y-m-d');
        foreach ($this->employees as $employee) {
            $actions[] = Action::make('award')
                ->label($employee->awards->where('start_of_month', $startOfMonth)->first() ? '✓' : 'x')
                ->url(route('filament.admin.pages.timesheet.award.toggle', $employee))
                ->color($employee->awards->where('start_of_month', $startOfMonth)->first() ? 'success' : 'danger');
        }

        return $actions;
    }
}
