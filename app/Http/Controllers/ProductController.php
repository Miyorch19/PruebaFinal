<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Importar Log

class ProductController extends Controller
{
    public function index()
    {
        try {
            $productos = Product::with('categoria')->get();
            $categorias = Categoria::all();

            Log::info('Se accedió a la vista de productos.');

            return view('Productos', compact('productos', 'categorias'));
        } catch (\Exception $e) {
            Log::error('Error al cargar productos: ' . $e->getMessage());
            return redirect()->route('Productos')->with('error', 'Error al cargar los productos.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required',
                'precio' => 'required|numeric',
                'descripcion' => 'required',
                'stock' => 'required|integer',
                'categoria_id' => 'required|exists:categoria,id',
            ]);

            $producto = Product::create($request->all());

            Log::info('Producto registrado correctamente', [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'stock' => $producto->stock,
                'categoria_id' => $producto->categoria_id,
            ]);

            return redirect()->route('Productos')->with('success', 'Producto registrado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al registrar producto: ' . $e->getMessage());
            return redirect()->route('Productos')->with('error', 'Error al registrar el producto.');
        }
    }

    public function update(Request $request, Product $product)
    {
        try {
            $request->validate([
                'nombre' => 'required',
                'precio' => 'required|numeric',
                'descripcion' => 'required',
                'stock' => 'required|integer',
                'categoria_id' => 'required|exists:categoria,id',
            ]);

            $product->update($request->all());

            Log::info('Producto actualizado correctamente', [
                'id' => $product->id,
                'nombre' => $product->nombre,
                'precio' => $product->precio,
                'stock' => $product->stock,
                'categoria_id' => $product->categoria_id,
            ]);

            return redirect()->route('Productos')->with('success', 'Producto actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar producto: ' . $e->getMessage());
            return redirect()->route('Productos')->with('error', 'Error al actualizar el producto.');
        }
    }

    public function search(Request $request)
    {
        try {
            $search = $request->get('search');

            $productos = Product::with('categoria')
                ->where('nombre', 'LIKE', '%' . $search . '%')
                ->orWhere('descripcion', 'LIKE', '%' . $search . '%')
                ->orWhereHas('categoria', function ($query) use ($search) {
                    $query->where('nombre', 'LIKE', '%' . $search . '%');
                })
                ->get();

            Log::info('Búsqueda realizada', ['término' => $search, 'resultados' => count($productos)]);

            return response()->json($productos);
        } catch (\Exception $e) {
            Log::error('Error en la búsqueda de productos: ' . $e->getMessage());
            return response()->json(['error' => 'Error en la búsqueda de productos'], 500);
        }
    } 

    public function destroy(Product $product)
    {
        try {
            $product->delete();

            Log::info('Producto eliminado correctamente', [
                'id' => $product->id,
                'nombre' => $product->nombre
            ]);

            return redirect()->route('Productos')->with('success', 'Producto eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar producto: ' . $e->getMessage());
            return redirect()->route('Productos')->with('error', 'Error al eliminar el producto.');
        }
    }
}
