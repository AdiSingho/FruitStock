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
        Schema::table('stoks', function (Blueprint $table) {
            // Cek dulu, kalau belum ada kolomnya, baru tambahkan
            if (!Schema::hasColumn('stoks', 'tanggal_masuk')) {
                $table->date('tanggal_masuk')->nullable();
            }
            
            if (!Schema::hasColumn('stoks', 'estimasi_kadaluarsa')) {
                $table->date('estimasi_kadaluarsa')->nullable();
            }
            
            if (!Schema::hasColumn('stoks', 'status')) {
                $table->string('status')->default('Aman');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stoks', function (Blueprint $table) {
            // Menghapus kolom jika migrasi di-rollback
            $table->dropColumn(['tanggal_masuk', 'estimasi_kadaluarsa', 'status']);
        });
    }
};