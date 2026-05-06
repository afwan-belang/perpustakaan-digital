<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Matikan sementara pengecekan relasi agar tidak error saat dihapus
        Schema::disableForeignKeyConstraints();

        // 2. Hapus tabel peminjaman yang lama (karena strukturnya salah)
        Schema::dropIfExists('borrowings');

        // 3. Bersihkan tabel books (Buku Digital) dari kolom-kolom fisik kemarin
        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'type')) {
                $table->dropColumn(['type', 'genre', 'stock']);
            }
        });

        // 4. Nyalakan kembali pengecekan relasi
        Schema::enableForeignKeyConstraints();

        // 5. Buat tabel peminjaman (Borrowings) yang BARU dan BENAR
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // Relasinya sekarang ke tabel library_books (bukan books)
            $table->foreignId('library_book_id')->constrained('library_books')->cascadeOnDelete();
            
            // Status alur peminjaman sesuai SOP
            $table->enum('status', ['pending', 'approved', 'returned', 'rejected'])->default('pending');
            
            // Tanggal-tanggal ini boleh kosong (nullable) karena diisi nanti saat Admin ACC
            $table->date('borrow_date')->nullable(); 
            $table->date('due_date')->nullable();    
            $table->date('returned_at')->nullable(); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};