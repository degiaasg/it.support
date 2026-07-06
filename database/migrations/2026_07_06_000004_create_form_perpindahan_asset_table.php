<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_perpindahan_asset', function (Blueprint $table) {
            $table->id();
            $table->string('no_form');
            $table->string('asset_name');
            $table->date('tanggal_pindah');
            $table->string('dari_lokasi');
            $table->string('ke_lokasi');
            $table->string('penanggung_jawab');
            $table->text('keterangan')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_perpindahan_asset');
    }
};
