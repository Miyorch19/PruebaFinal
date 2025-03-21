<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    /**
     * Especifica el nombre de la tabla en la base de datos.
     */
    protected $table = 'categoria'; // Nombre exacto de la tabla en la base de datos

    /**
     * Relación con la tabla de Productos.
     */
    public function productos()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Campos asignables de manera masiva.
     */
    protected $fillable = [
        'nombre', // Nombre de la categoría
    ];
}
