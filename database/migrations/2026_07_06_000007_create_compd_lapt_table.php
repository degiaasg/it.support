<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compd_lapt', function (Blueprint $table) {
            $table->string('id_lapt', 20)->primary();
            $table->string('hostname', 50);
            $table->string('sn', 50);
            $table->string('barcode', 50);
            $table->string('id_asset_category', 10);
            $table->string('category', 50);
            $table->string('brand', 50);
            $table->string('type', 100);
            $table->string('processors', 100);
            $table->integer('gen');
            $table->integer('ram_cap');
            $table->string('ram_slot', 20);
            $table->string('ram_type', 100);
            $table->integer('disk1_cap');
            $table->string('disk1_type', 100);
            $table->integer('disk2_cap')->nullable();
            $table->string('disk2_type', 100)->nullable();
            $table->enum('os', ['WINDOWS', 'MACHINTOS', 'LINUX']);
            $table->string('os_type', 100);
            $table->string('os_ver', 20);
            $table->string('product_id', 50);
            $table->string('product_key', 50);
            $table->decimal('bh', 5, 2)->nullable();
            $table->integer('dc')->nullable();
            $table->integer('fcc')->nullable();
            $table->enum('casing', ['GOOD', 'BAD']);
            $table->enum('display', ['GOOD', 'BAD']);
            $table->enum('port_display', ['GOOD', 'BAD']);
            $table->enum('keyboard', ['GOOD', 'BAD']);
            $table->enum('touchpad', ['GOOD', 'BAD']);
            $table->enum('port_usb', ['GOOD', 'BAD']);
            $table->enum('port_jeck', ['GOOD', 'BAD']);
            $table->enum('port_psu', ['GOOD', 'BAD']);
            $table->enum('fan', ['GOOD', 'BAD']);
            $table->enum('webcam', ['GOOD', 'BAD']);
            $table->enum('microfon', ['GOOD', 'BAD']);
            $table->enum('speaker', ['GOOD', 'BAD']);
            $table->enum('connection', ['GOOD', 'BAD']);
            $table->enum('conditions', ['GOOD', 'BAD']);
            $table->enum('sub_con', ['GREAT', 'NORMAL', 'CAUTIONS', 'POOR']);
            $table->longText('note_con')->nullable();
            $table->enum('solution', ['KEEP', 'UPGRADE', 'REPAIR', 'REPLACE', 'DISPOSE']);
            $table->longText('note_sol')->nullable();
            $table->enum('functions', ['PERSONAL', 'GROUP', 'SYSTEM', 'OPERATIONAL']);
            $table->longText('note_func')->nullable();
            $table->longText('history_pic')->nullable();
            $table->string('location', 100);
            $table->string('note_loc', 100);
            $table->enum('status', ['IN USE', 'IN STORE', 'IN REPAIR', 'DISPOSING', 'DISPOSED', 'INACTIVE']);
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
        Schema::dropIfExists('compd_lapt');
    }
};
