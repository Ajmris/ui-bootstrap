<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Contracts\View\View;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view("welcome",[
            'products' => Product::paginate(8),
            'categories' => ProductCategory::orderBy('name', 'ASC')->get()
        ]);
    }
}