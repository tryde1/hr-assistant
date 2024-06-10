<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Division::insert([
            [
                'name' => 'Бухгалтерия',
            ],
            [
                'name' => 'Отдел кадров',
            ],
            [
                'name' => 'Администрация',
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
