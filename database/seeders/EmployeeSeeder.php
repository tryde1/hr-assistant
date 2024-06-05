<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Employee::truncate();
        Employee::factory(20)->create();

        Schema::enableForeignKeyConstraints();
    }
}
