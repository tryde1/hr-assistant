<?php

namespace Database\Seeders;

use App\Models\PositionName;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PositionNameSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        PositionName::truncate();
        PositionName::factory(50)->create();

        Schema::enableForeignKeyConstraints();
    }
}
