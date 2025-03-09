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
        Schema::create('data_travel', function (Blueprint $table) {
            $table->id('id_travel');
            $table->string('tujuan');
            $table->timestamp('tanggal_berangkat');
            $table->integer('kuota');
            $table->integer('harga_tiket');
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_travel');
    }
};
