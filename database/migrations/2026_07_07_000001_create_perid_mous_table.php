<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perid_mous', function (Blueprint $table) {
            $table->string('id_mous', 20)->primary();
            $table->string('hostname', 50);
            $table->string('sn', 50);
            $table->string('barcode', 50);
            $table->string('id_asset_category', 10);
            $table->string('category', 50);
            $table->string('brand', 50);
            $table->string('type', 100);
            $table->enum('casing', ['GOOD', 'BAD']);
            $table->enum('connection', ['Wireless USB', 'Bluetooth', 'Wire']);
            $table->enum('conditions', ['GOOD', 'BAD']);
            $table->enum('sub_con', ['GREAT', 'NORMAL', 'COUTIONS', 'POOR']);
            $table->longText('note_con')->nullable();
            $table->enum('solution', ['KEEP', 'UPGRADE', 'REPAIR', 'REPLACE', 'DISPOSE']);
            $table->longText('note_sol')->nullable();
            $table->enum('functions', ['PERUSED', 'GROUP', 'SYSTEM', 'OPERATIONAL']);
            $table->longText('note_func')->nullable();
            $table->longText('history_pic')->nullable();
            $table->string('location', 100);
            $table->string('note_loc', 100);
            $table->enum('status', ['IN USE', 'IN STORE', 'IN REPAIR', 'DISPOSING', 'DISPOSED', 'IN ACTIVE']);
            $table->integer('pic_nip')->nullable();
            $table->string('pic_name', 100)->nullable();
            $table->integer('total_maintenance_corr')->default(0);
            $table->date('last_maintenance_corr')->nullable();
            $table->integer('total_maintenance_prev')->default(0);
            $table->date('last_maintenance_prev')->nullable();
            $table->integer('total_maintenance_pred')->default(0);
            $table->date('last_maintenance_pred')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perid_mous');
    }
};
