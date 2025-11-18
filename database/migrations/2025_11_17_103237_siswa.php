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
    if (!Schema::hasTable('siswa')) {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lembaga_id')->constrained()->onDelete('cascade');
            $table->string('nis')->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
