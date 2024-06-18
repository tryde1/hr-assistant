<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('positions', function (Blueprint $table) {
            $table->string('division_id');
        });

        Schema::table('employees', static function (Blueprint $table) {
            $table->float('experience');
        });

        Schema::table('positions', static function (Blueprint $table) {
            $table->string('acceptance_document')->nullable();
            $table->string('dismissal_document')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};
