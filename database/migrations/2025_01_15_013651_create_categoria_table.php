<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaTable extends Migration
{
    public function up()
    {
        Schema::create('categoria', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre de la categoría
            $table->timestamps(); // Marca de tiempo para 'created_at' y 'updated_at'
        });
    }

    public function down()
    {
        Schema::dropIfExists('categoria');
    }
}
