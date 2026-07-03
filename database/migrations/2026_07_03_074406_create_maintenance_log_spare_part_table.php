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
        Schema::create('maintenance_log_spare_part', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_log_id')->constrained()->cascadeOnDelete();
            $table->foreignId('spare_part_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity_used')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_log_spare_part');
    }
};
