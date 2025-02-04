<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // or however you fetch products
        return view('produtos', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produto não encontrado.'], 404);
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        return response()->json(['success' => true, 'message' => 'Produto atualizado com sucesso.']);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produto não encontrado.'], 404);
        }

        $product->delete();

        return response()->json(['success' => true, 'message' => 'Produto excluído com sucesso.']);
    }
}