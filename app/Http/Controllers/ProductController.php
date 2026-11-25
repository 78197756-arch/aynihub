<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /** READ (lista): catálogo público, con filtro opcional por categoría. */
    public function index(Request $request): JsonResponse
    {
        $query = Product::query();

        if ($request->filled('category') && $request->category !== 'todos') {
            $query->where('category', $request->category); // consulta parametrizada
        }

        return response()->json($query->latest()->get());
    }

    /** READ (detalle): un producto. */
    public function show(Product $product): JsonResponse
    {
        return response()->json($product);
    }

    /** CREATE: solo productor o gestor. */
    public function store(ProductRequest $request): JsonResponse
    {
        $this->authorize('create', Product::class);

        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        return response()->json(Product::create($data), 201);
    }

    /** UPDATE: gestor o dueño del producto. */
    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        $this->authorize('update', $product);

        $product->update($request->validated());

        return response()->json($product->fresh());
    }

    /** DELETE: gestor o dueño del producto. */
    public function destroy(Product $product): JsonResponse
    {
        $this->authorize('delete', $product);

        $product->delete();

        return response()->json(['message' => __('Producto eliminado.')]);
    }
}
