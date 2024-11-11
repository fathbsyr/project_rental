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
        //
        $tables = ['mobil', 'ulasan', 'denda', 'pelanggan', 'reservasi', 'pembayaran', 'promosi'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                if (!Schema::hasColumn($table->getTable(), 'created_at') && !Schema::hasColumn($table->getTable(), 'updated_at')) {
                    $table->timestamps(); 
                }
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        $tables = ['mobil', 'ulasan', 'denda', 'pelanggan', 'reservasi', 'pembayaran', 'promosi'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropTimestamps(); // Menghapus kolom created_at dan updated_at jika migration di-rollback
            });
        }
    }
};
