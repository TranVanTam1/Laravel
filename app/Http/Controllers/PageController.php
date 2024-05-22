<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function index()
    {
        
                $new_products = Product::where('new',1)->get();
            
        return view('page.index', compact('new_products'));

    }
    public function show($id)
    {
        
                $product= Product::find($id);
            
        return view('page.product', compact('product'));

    }
}
