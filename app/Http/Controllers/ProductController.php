<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $products = [];

    public function index()
    {
        return view('products.index', ['products' => $this->products]);
    }

    public function show($id)
    {
        $product = $this->findProductById($id);
    
        return view('products.show', compact('product'));
    }
    

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'libelle' => 'required|string',
            'marque' => 'required',
            'prix' => 'required|numeric',
            'stock' => 'required|integer|min:1|max:9999',
            'image' => 'nullable|file',
        ]);
    
        $this->products[] = $validatedData;
    
        $lastProductId = count($this->products);
    
        return redirect()->route('products.show', ['id' => $lastProductId]);
    }
    

    public function edit($id)
    {
        $product = $this->findProductById($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = $this->findProductById($id);

        $validatedData = $request->validate([
            'libelle' => 'required|string',
            'marque' => 'required',
            'prix' => 'required|numeric',
            'stock' => 'required|integer|min:1|max:9999',
            'image' => 'nullable|file',
        ]);

        $product = array_merge($product, $validatedData);

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $index = $this->findProductIndexById($id);

        if ($index !== false) {
            array_splice($this->products, $index, 1);
        }

        return redirect()->route('products.index');
    }

    private function findProductById($id)
    {
        foreach ($this->products as $product) {
            if ($product['id'] == $id) {
                return $product;
            }
        }

        return null;
    }

    private function findProductIndexById($id)
    {
        foreach ($this->products as $index => $product) {
            if ($product['id'] == $id) {
                return $index;
            }
        }

        return false;
    }
}

