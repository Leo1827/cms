<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Product;

class ProductController extends Controller
{
    //Funcion para atraer un producto invidualmente
    public function getProduct($id, $slug){
        $product = Product::findOrFail($id);
        $data = ['product' => $product];
        return view('product.product_single', $data);
    }
}
