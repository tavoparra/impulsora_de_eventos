<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

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
}
