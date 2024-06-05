<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Position::truncate();
        Position::factory(50)->create();

        Schema::enableForeignKeyConstraints();
    }
}
