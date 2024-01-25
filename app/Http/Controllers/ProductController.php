<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {

        $productId = DB::table('products')->insertGetId([
            'libelle' => $request->libelle,
            'marque' => $request->marque,
            'prix' => $request->prix,
            'stock' => $request->stock,
            'image' => $request->image,
        ]);

        return redirect()->route('products.show', $productId)
            ->with('success', 'Produit créé avec succès');
    }

    public function show($id)
    {
        $product = DB::table('products')->find($id);

        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = DB::table('products')->find($id);

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {

        DB::table('products')
            ->where('id', $id)
            ->update([
                'libelle' => $request->libelle,
                'marque' => $request->marque,
                'prix' => $request->prix,
                'stock' => $request->stock,
                'image' => $request->image,
            ]);

        return redirect()->route('products.show', $id)
            ->with('success', 'Produit mis à jour avec succès');
    }

    public function destroy($id)
    {
        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produit supprimé avec succès');
    }
}
