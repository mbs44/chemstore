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
        Schema::create('dangerous_properties', function (Blueprint $table) {
            $table->id();
            $table->string('name_en'); // Name of the dangerous property
            $table->string('name_sk'); // Name of the dangerous property
            $table->text('description_en')->nullable(); // Description of the property
            $table->text('description_sk')->nullable(); // Description of the property
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dangerous_properties');
    }
};
