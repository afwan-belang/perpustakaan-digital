<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Cek dan tambahkan kolom 'type' jika belum ada
            if (!Schema::hasColumn('books', 'type')) {
                $table->enum('type', ['digital', 'physical'])->default('digital')->after('description');
            }
            
            // Cek dan tambahkan kolom 'genre' jika belum ada
            if (!Schema::hasColumn('books', 'genre')) {
                $table->string('genre')->nullable()->after('type');
            }
            
            // Cek dan tambahkan kolom 'stock' jika belum ada
            if (!Schema::hasColumn('books', 'stock')) {
                $table->integer('stock')->default(0)->after('genre');
            }
            
            // PENYELESAIAN ERROR: 
            // Cek apakah kolom path_pdf ada. Jika ada, ubah. Jika tidak, buat baru.
            if (Schema::hasColumn('books', 'path_pdf')) {
                $table->string('path_pdf')->nullable()->change();
            } else {
                $table->string('path_pdf')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Hapus kolom hanya jika kolom tersebut ada
            if (Schema::hasColumn('books', 'type')) {
                $table->dropColumn('type');
            }
            if (Schema::hasColumn('books', 'genre')) {
                $table->dropColumn('genre');
            }
            if (Schema::hasColumn('books', 'stock')) {
                $table->dropColumn('stock');
            }
        });
    }
};