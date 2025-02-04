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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->storeId = auth()->id();
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->imageURL = '/storage/' . $path;
        }
    
        $product->save();
    
        return response()->json(['success' => true, 'message' => 'Produto adicionado com sucesso!']);
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