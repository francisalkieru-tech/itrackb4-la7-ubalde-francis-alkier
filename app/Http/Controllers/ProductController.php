<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = $request->query('category', '');
        $stock = $request->query('stock', '');

        $products = $this->products();

        if($category){
            $products = array_filter($products, function($product) use($category) {
                return $product['category'] === $category;
            });
        }

        if($stock && $stock !== 'all'){
            $products = array_filter($products, function ($product) use($stock){
                return $stock === 'low' ? $product['stock'] < 10 : $product['stock'] >= 10;
            });
        }

        return view('products.index', [
            'products' => $products,
            'category' => $category,
            'stock'    => $stock,
        ]);
    }
    
    //return view('products.index', ['products' => $this->products()]);

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|numeric|min:1|max:1000',
            'stock' => 'required|numeric|max:100',
            'category' => 'required|in:Canned Goods,Instant Noodles,Beverages,Alcoholic Beverages,Snacks'
        ]);
        $products = $this->products();
        $id = max(array_keys($products)) + 1;

        $products[$id] = [
            'id' => $id,
            'name' => $request->input('name'),
            'price' => (int) $request->input('price'),
            'stock' => (int) $request->input('stock'),
            'category' => $request->input('category'),
        ];

        $this->saveProducts($products);

        return redirect()
        ->route('products.index')
        ->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = $this->products();
        if(!isset($products[$id])){
            abort(404);
        }
        return view('products.show', ['product' => $products[$id]]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function products()
    {
        $path = storage_path('app/products.json');

        return json_decode(file_get_contents($path), true);
    }
    private function saveProducts(array $products){
        file_put_contents(
            storage_path('app/products.json'),
            json_encode($products, JSON_PRETTY_PRINT)
        );
    }
}

