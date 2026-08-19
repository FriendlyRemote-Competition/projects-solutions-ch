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
        Schema::create('cancelled_departures', function (Blueprint $table) {
            $table->id();
            $table->string("line_code", 4);
            $table->foreign("line_code")->references("line_code")->on("lines")->cascadeOnDelete();
            $table->date("departure_date");
            $table->time("departure_time");
            $table->string("departure_station", 3);
            $table->foreign("departure_station")->references("station_code")->on("stations")->cascadeOnDelete();
            $table->string("reason", 255);
            $table->dateTimeTz("cancelled_at");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancelled_departures');
    }
};
