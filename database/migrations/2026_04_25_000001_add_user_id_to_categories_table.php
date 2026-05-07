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
        Schema::table('categories', function (Blueprint $table) {
            // Kita hanya tambah kolom user_id dan product_id di sini
            if (!Schema::hasColumn('categories', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
            }
            
            if (!Schema::hasColumn('categories', 'product_id')) {
                $table->foreignId('product_id')->nullable()->after('user_id')->constrained()->cascadeOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Menghapus foreign key dan kolom jika rollback
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('product_id');
        });
    }
};