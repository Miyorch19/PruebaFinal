<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Especifica el nombre de la tabla en la base de datos.
     */
    protected $table = 'product'; // Nombre de la tabla en singular

    /**
     * Los campos que se pueden asignar de manera masiva.
     */
    protected $fillable = ['nombre', 'precio', 'descripcion', 'stock', 'categoria_id'];

    /**
     * Relación con el modelo Categoria.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id'); // Relación con 'categoria_id'
    }
}
