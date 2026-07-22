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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pelapor
            $table->string('line'); // Line A, B, C
            $table->string('section'); // Mixing, Cutting, Oven
            $table->string('komponen'); // Servo, Bearing, dll
            $table->text('deskripsi_kerusakan'); // Keterangan kerusakan
            $table->string('foto')->nullable(); // 📸 Kolom foto kerusakan (opsional)
            $table->string('status')->default('pending'); // Status otomatis untuk admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
