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
    Schema::create('buahs', function (Blueprint $table) {
        $table->id();
        
        // Relasi Foreign Key ke tabel kategoris
        $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
        
        $table->string('nama_buah'); 
        
        // Menggunakan decimal untuk nominal uang (15 digit total, 2 di belakang koma)
        $table->decimal('harga_beli', 15, 2); 
        $table->decimal('harga_jual', 15, 2); 
        
        $table->integer('estimasi_masa_simpan'); // dalam satuan hari
        $table->string('satuan'); // misal: kg, pcs, pack
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buahs');
    }
};
