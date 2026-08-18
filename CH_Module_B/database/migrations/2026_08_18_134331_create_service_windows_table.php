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
        Schema::create('service_windows', function (Blueprint $table) {
            $table->id();
            $table->string("line_code", 4);
            $table->foreign("line_code")->references("line_code")->on("lines")->cascadeOnDelete();
            $table->time("service_start");
            $table->time("service_end");
            $table->integer("interval_minutes");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_windows');
    }
};
