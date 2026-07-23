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
    Schema::create('qc_returs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('stok_id')->constrained('stoks')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->decimal('qty_rusak', 10, 2);
        $table->text('alasan');
        $table->enum('tindakan', ['buang', 'retur']);
        $table->date('tanggal_qc');
        $table->string('status');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qc_returs');
    }
};
