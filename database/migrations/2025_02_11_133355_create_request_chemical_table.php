<?php
// database/migrations/xxxx_xx_xx_create_chemical_experiment_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up():void
    {
        Schema::create('request_chemical', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chemical_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_request_id')->constrained()->onDelete('cascade');
            $table->decimal('quantity');
            $table->foreignId('measure_unit_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down():void
    {
        Schema::dropIfExists('request_chemical');
    }
};
