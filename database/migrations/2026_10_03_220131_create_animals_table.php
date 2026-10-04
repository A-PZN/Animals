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
        #crea un tabla llamada animal con un id y un time
        Schema::create('animales', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('species');
            $table->integer('age');

           # $table->timestamps(); le agrega dos columans mas a la tabla
        });
    }

    /**
     * Reverse the migrations.
     */
    #elimina la  tabla animales 
    public function down(): void
    {
        Schema::dropIfExists('animales');
    }
};
