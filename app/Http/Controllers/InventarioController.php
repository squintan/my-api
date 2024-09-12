<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InventarioController extends Controller
{
    // Mostrar todos los inventarios
    public function index()
    {
        $inventarios = Inventario::all();
        return response()->json($inventarios);
    }

    // Mostrar un inventario por su ID
    public function show($id)
    {
        $inventario = Inventario::find($id);

        if ($inventario) {
            return response()->json($inventario);
        }

        return response()->json(['error' => 'Inventario no encontrado'], 404);
    }

    // Crear un nuevo inventario
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'producto_id' => 'required|integer|unique:inventarios,producto_id',
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
            'ubicacion' => [
                'required',
                'regex:/^Estante [A-C] Fila [1-5]$/'
            ]
        ], [
            'producto_id.unique' => 'No se puede ingresar, el ID de producto ya está ocupado.',
            'cantidad.min' => 'La cantidad no puede ser menor que 0.',
            'precio.min' => 'El precio no puede ser menor que 0.',
            'ubicacion.regex' => 'La ubicación debe estar en el rango de Estante A-C y Fila 1-5.'
        ]);

        $inventario = Inventario::create($validatedData);
        return response()->json($inventario, 201);
    }

    // Actualizar un inventario
    public function update(Request $request, $id)
    {
        $inventario = Inventario::find($id);

        if (!$inventario) {
            return response()->json(['error' => 'Inventario no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'producto_id' => ['required', 'integer', Rule::unique('inventarios')->ignore($inventario->id)],
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
            'ubicacion' => [
                'required',
                'regex:/^Estante [A-C] Fila [1-5]$/'
            ]
        ]);

        $inventario->update($validatedData);
        return response()->json($inventario);
    }

    // Eliminar un inventario
    public function destroy($id)
    {
        $inventario = Inventario::find($id);

        if ($inventario) {
            $inventario->delete();
            return response()->json(['message' => 'Inventario eliminado']);
        }

        return response()->json(['error' => 'Inventario no encontrado'], 404);
    }

    public function findByName($nombre)
{
    $inventarios = Inventario::where('nombre', 'like', '%' . $nombre . '%')->get();

    if ($inventarios->isEmpty()) {
        return response()->json(['message' => 'No se encontraron productos con ese nombre'], 404);
    }

    return response()->json($inventarios);
}

}
