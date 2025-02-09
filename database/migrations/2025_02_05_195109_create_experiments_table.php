<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('experiments', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name_en'); // English name
            $table->string('name_sk'); // Slovak name
            $table->text('description_en')->nullable(); // English description
            $table->text('description_sk')->nullable(); // Slovak description
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('experiments');
    }
}
