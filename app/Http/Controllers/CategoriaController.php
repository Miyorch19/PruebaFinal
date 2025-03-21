<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoria = Categoria::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        Categoria::create($request->all());

        return redirect()->route('Categoria')->with('success', 'Categoria registrada correctamente.');
    }

    public function update (Request $request, Categoria $categoria)
    {
        
    }
    

}
