<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            
            $table->date('borrow_date');
            $table->date('due_date'); // Tenggat waktu pengembalian
            $table->date('returned_at')->nullable(); // Kapan riilnya dikembalikan
            
            // Status peminjaman
            $table->enum('status', ['borrowed', 'returned', 'late'])->default('borrowed');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};