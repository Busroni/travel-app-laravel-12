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
        Schema::create('history_travel', function (Blueprint $table) {
            $table->id('id_history');
            $table->integer('id_travel');
            $table->integer('id_user');
            $table->integer('id_invoice');
            $table->timestamps('tanggal_pesan');
            $table->string('status_bayar');
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_travel');
    }
};
