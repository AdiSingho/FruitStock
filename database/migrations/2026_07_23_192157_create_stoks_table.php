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
    Schema::create('stoks', function (Blueprint $table) {
        $table->id();
        
        // 3 Relasi Foreign Key ke tabel master
        $table->foreignId('buah_id')->constrained('buahs')->onDelete('cascade'); 
        $table->foreignId('gudang_id')->constrained('gudangs')->onDelete('cascade'); 
        $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade'); 
        
        $table->string('kode_batch'); 
        
        // Menggunakan decimal (total 10 digit, 2 di belakang koma) untuk akurasi timbangan
        $table->decimal('jumlah', 10, 2); 
        
        // Tipe data date untuk perhitungan umur simpan (FEFO)
        $table->date('tanggal_masuk'); 
        $table->date('estimasi_kadaluarsa'); 
        
        $table->string('status'); 
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stoks');
    }
};
