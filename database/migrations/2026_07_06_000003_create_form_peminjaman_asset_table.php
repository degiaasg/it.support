<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_peminjaman_asset', function (Blueprint $table) {
            $table->id();
            $table->string('no_form');
            $table->string('asset_name');
            $table->string('peminjam');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_rencana_kembali');
            $table->text('keperluan');
            $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_peminjaman_asset');
    }
};
