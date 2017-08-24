<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Package;
use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class PackageController extends Controller
{
    public function list() {
        $packages = Package::all();
        return view('packages.list', ['packages' => $packages]);
    }

    public function create() {
        $category_options = Category::pluck('name', 'id');
        $product_options = Product::where('published', true)->pluck('name', 'id');
        return view('packages.form', [
            'title' => 'Nuevo paquete',
            'submitText' => 'Crear',
            'category_options' => $category_options,
            'product_options' => $product_options
        ]);
    }

    public function save(Request $request, $id = 0) {
        $rules = [
            'name' => 'required|max:255|unique:packages,name,'.$id,
            'description' => 'max:255',
            'qty' => 'integer',
            'package_price' => 'numeric',
            'foreign_package_price' => 'numeric',
            'published' => 'boolean',
            'category_id' => 'exists:categories,id',
            'product' => 'required',
            'image' => 'image'
        ];

        $messages = [
            'product.required' => 'Debes incluir al menos un producto'
        ];

		$product = $request->get('product');
		if ($product and is_array($product)) {
			foreach($request->get('product') as $key => $val) {
				$rules['product.'.$key.'.qty'] = 'required|integer';
				$messages['product.'.$key.'.qty.required'] = 'El campo cantidad debe ser un entero';
				$messages['product.'.$key.'.qty.integer'] = 'El campo cantidad debe ser un entero';
			}
		}

        $this->validate($request, $rules, $messages);

        $package = Package::findOrNew($id);
        $package->fill($request->all());
        $package['published'] = $request->input('published', false);
        $package->products()->detach();
        if ($request->hasFile('image')) {
            $image = Input::file('image');

            $package['image'] = $this->saveImage($image);
        }

        $package->save();

        if ($request->input('product')) {
            foreach ($request->input('product') as $product) {
                $package->products()->attach($product['id'], ['qty' => $product['qty']]);
            }
        }
        
        return redirect('packages');
    }

    public function detail($id){
        $package = Package::find($id);
        $category_options = Category::pluck('name', 'id');
        $product_options = Product::pluck('name', 'id');
        return view('packages.form', [
                'title' => 'Detalle de paquete',
                'submitText' => 'Actualizar',
                'package' => $package,
                'category_options' => $category_options,
                'product_options' => $product_options
            ]
        );
    }

    protected function saveImage($image) {
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $name = $timestamp.'_'.$image->getClientOriginalName();
        $image->move(public_path().'/images/', $name);

        return $name;
    }
}
