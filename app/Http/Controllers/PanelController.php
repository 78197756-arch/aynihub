<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;

/** Dashboard del gestor: indicadores y lista de usuarios. */
class PanelController extends Controller
{
    /** Totales con una sola consulta agregada por tabla (sin cargar modelos). */
    public function resumen(): JsonResponse
    {
        return response()->json([
            'users'    => User::query()->selectRaw('role, COUNT(*) AS total')->groupBy('role')->pluck('total', 'role'),
            'products' => Product::count(),
            'orders'   => Order::query()->selectRaw('status, COUNT(*) AS total')->groupBy('status')->pluck('total', 'status'),
            'revenue'  => (float) Order::where('status', '!=', 'cancelado')->sum('total'),
        ]);
    }

    public function usuarios(): JsonResponse
    {
        return response()->json(
            User::select('id', 'name', 'contact', 'role', 'location', 'created_at')->latest()->get()
        );
    }
}
