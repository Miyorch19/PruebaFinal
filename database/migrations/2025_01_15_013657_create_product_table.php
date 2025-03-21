<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del producto
            $table->decimal('precio', 8, 2); // Precio del producto
            $table->text('descripcion'); // Descripción del producto
            $table->integer('stock'); // Cantidad disponible en inventario
            $table->foreignId('categoria_id')->constrained('categoria')->onDelete('cascade'); // Relación con la tabla 'categorias'
            $table->timestamps(); // Marca de tiempo para 'created_at' y 'updated_at'
        });
    }

    public function down()
    {
        Schema::dropIfExists('product');
    }
}
