<?php
// database/migrations/xxxx_xx_xx_create_chemical_experiment_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChemicalExperimentTable extends Migration
{
    public function up():void
    {
        Schema::create('chemical_experiment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chemical_id')->constrained()->onDelete('cascade');
            $table->foreignId('experiment_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down():void
    {
        Schema::dropIfExists('chemical_experiment');
    }
}
