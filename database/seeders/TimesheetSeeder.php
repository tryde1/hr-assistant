<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Timesheet;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TimesheetSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Timesheet::truncate();
        $this->seedTimesheets();

        Schema::enableForeignKeyConstraints();
    }

    protected function seedTimesheets(): void
    {
        $dates = [];
        $period = CarbonPeriod::create(now()->startOfMonth(), now());
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
        }

        $dataToInsert = [];
        $employees = Employee::all('id');
        foreach ($employees as $employee) {
            foreach ($dates as $date) {
                $dataToInsert[] = ['employee_id' => $employee->id, 'date' => $date];
            }
        }
        foreach (range(1, 30) as $i) {
            unset($dataToInsert[random_int(0, count($dataToInsert) - 1)]);
        }

        Timesheet::insert($dataToInsert);
    }
}
