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
        Schema::create('chemical_safety_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chemical_id')->constrained()->onDelete('cascade');
            $table->foreignId('safety_item_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chemical_safety_item');
    }
};
