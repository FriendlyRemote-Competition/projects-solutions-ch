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
        Schema::create('bookings', function (Blueprint $table) {
            $table->string("booking_code", 10)->primary();
            $table->string("line_code", 2);
            $table->foreign("line_code")->references("line_code")->on("lines")->cascadeOnDelete();
            $table->date("departure_date");
            $table->time("departure_time");
            $table->string("departure_station", 3);
            $table->foreign("departure_station")->references("station_code")->on("stations")->cascadeOnDelete();
            $table->string("first_name", 255);
            $table->string("last_name", 255);
            $table->string("email", 255);
            $table->integer("setas");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
