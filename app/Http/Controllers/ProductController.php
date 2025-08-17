<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view("product.index",[
            'products'=>Product::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("product.create", [
            'categories'=>ProductCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $product = new Product($request->validated()); // <-- bez pliku w mass assignment
        if ($request->hasFile('image')) {
            $product->image_path = $request->file('image')->store('products', 'public');
        }
        $product->save();
        return redirect()->route('product.index')
        ->with('success', 'Produkt został dodany.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view("product.show",['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view("product.edit",[
            'product'=>$product,
            'categories'=>ProductCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
    $product->fill($request->validated());
    if ($request->hasFile('image')) {
        $product->image_path = $request->file('image')->store('products', 'public');
    }
    $product->save();
    return redirect()->route('product.index')->with('success', 'Produkt został zaktualizowany.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        try{
            $product->delete();
            return response()->json([
                'status'=>'success'
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>'Wystąpił błąd!'
            ])->setStatusCode(500);
        }
    }
}