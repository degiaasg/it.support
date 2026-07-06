<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_pemeriksaan_perangkat', function (Blueprint $table) {
            $table->id();
            $table->string('no_form');
            $table->string('device_name');
            $table->date('tanggal_pemeriksaan');
            $table->string('pemeriksa');
            $table->text('hasil_pemeriksaan');
            $table->text('keterangan')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_pemeriksaan_perangkat');
    }
};
