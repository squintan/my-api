<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        // Iniciar la consulta
        $query = Inventario::query();

        // Filtrar por nombre si se proporciona en la solicitud
        if ($request->has('nombre')) {
            $query->where('nombre', 'like', '%' . $request->query('nombre') . '%');
        }

        // Validar y asignar la columna para ordenar
        $validColumns = ['nombre', 'precio', 'cantidad']; // Columnas permitidas para ordenar
        $orderBy = in_array($request->query('order_by'), $validColumns) ? $request->query('order_by') : 'nombre';

        // Validar la dirección de orden
        $direction = $request->query('direction') === 'desc' ? 'desc' : 'asc';

        // Ejecutar la consulta con orden y devolver los resultados
        return $query->orderBy($orderBy, $direction)->get();
    }
}

