<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Package;

class CategoryController extends Controller
{
    public function list() {
        $categories = Category::all();
        return view('categories.list', ['categories' => $categories]);
    }

    public function create() {
        return view('categories.form', ['title' => 'Nueva categoría', 'submitText' => 'Crear']);
    }

    public function save(Request $request, $id = 0) {
        $this->validate($request, [
            'name' => 'required|max:255|unique:users,name,'.$id,
        ]);

        $category = Category::findOrNew($id);
        $category->fill($request->all());
        $category->save();
        
        return redirect('categories');
    }

    public function detail($id){
        $category = Category::find($id);
        return view(
            'categories.form',
            ['title' => 'Detalle de categoría', 'submitText' => 'Actualizar', 'category' => $category]
        );
    }

    /**
     * Renders list of products and packages for the given category
     */
    public function items($id) {
        $category = Category::find($id);
        $products = Product::where('category_id', $id)
                    ->where('published', true)
                    ->get();

        $packages = Package::where('category_id', $id)
                    ->where('published', true)
                    ->get();
        
        return view(
            'categories.items',
            compact(['products', 'packages', 'category'])
        );
    }
}
