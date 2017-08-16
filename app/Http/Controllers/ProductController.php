<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class ProductController extends Controller
{
    public function list() {
        $products = Product::all();
        return view('products.list', ['products' => $products]);
    }

    public function create() {
        $category_options = Category::pluck('name', 'id');
        return view('products.form', [
            'title' => 'Nuevo producto',
            'submitText' => 'Crear',
            'category_options' => $category_options
        ]);
    }

    public function save(Request $request, $id = 0) {
        $this->validate($request, [
            'name' => 'required|max:255|unique:products,name,'.$id,
            'description' => 'max:255',
            'quantity' => 'integer',
            'unit_price' => 'numeric',
            'package_price' => 'numeric',
            'published' => 'boolean',
            'category_id' => 'exists:categories,id'

        ]);

        $product = Product::findOrNew($id);
        $product->fill($request->all());
        $product['published'] = $request->input('published', false);
        $product->save();
        
        return redirect('products');
    }

    public function detail($id){
        $product = Product::find($id);
        $category_options = Category::pluck('name', 'id');
        return view('products.form', [
                'title' => 'Detalle de producto',
                'submitText' => 'Actualizar',
                'product' => $product,
                'category_options' => $category_options
            ]
        );
    }
}
