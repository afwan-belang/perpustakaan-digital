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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            
            // --- INI KODE YANG KITA TAMBAHKAN ---
            $table->string('name'); // Kolom untuk nama kategori
            $table->string('slug')->nullable(); // Opsional: untuk URL yang rapi (misal: buku-novel)
            // ------------------------------------

            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
