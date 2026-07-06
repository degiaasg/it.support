<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('form_pemeriksaan_perangkat', function (Blueprint $table) {
            $table->string('kategori_asset')->after('no_form');
            $table->json('form_data')->after('keterangan');
        });
    }

    public function down(): void
    {
        Schema::table('form_pemeriksaan_perangkat', function (Blueprint $table) {
            $table->dropColumn(['kategori_asset', 'form_data']);
        });
    }
};
