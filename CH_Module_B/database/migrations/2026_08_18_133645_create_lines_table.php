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
        Schema::create('lines', function (Blueprint $table) {
            $table->string("line_code", 4)->primary();
            $table->string("line_name", 255);
            $table->enum("line_status", ["active", "suspended"]);
            $table->string("station_a_code", 3);
            $table->foreign("station_a_code")->references("station_code")->on("stations")->cascadeOnDelete();
            $table->string("station_b_code", 3);
            $table->foreign("station_b_code")->references("station_code")->on("stations")->cascadeOnDelete();
            $table->integer("seat_capacity");
            $table->integer("crossing_minutes");
            $table->float("fare_cny");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lines');
    }
};
