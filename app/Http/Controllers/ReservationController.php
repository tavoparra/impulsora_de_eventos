<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Reservation;
use App\Package;
use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function list() {
        $reservations = Reservation::where('date', ">=", Carbon::today())->get();
        return view('reservations.list', ['reservations' => $reservations]);
    }

    public function create() {
        $products = Product::where('published', true)->get();
        $packages = Package::where('published', true)->get();

        return view('reservations.form', [
            'title' => 'Nueva reservación',
            'submitText' => 'Reservar',
            'products' => $products,
            'packages' => $packages
        ]);
    }

    public function save(Request $request, $id = 0) {
        $validator = $this->customValidator($request, $id);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $errors = $validator->messages()->toArray();
        if (count($errors) > 0) {
            return Redirect::back()
                ->withErrors($validator->getMessageBag()->messages)
                ->withInput();
        }

        $reservation = Reservation::findOrNew($id);
        $reservation->fill($request->all());
        $reservation->packages()->detach();
        $reservation->products()->detach();
        $reservation->save();

        if ($request->input('package')) {
            foreach ($request->input('package') as $package) {
                $reservation->packages()->attach($package['id'], ['rented_qty' => $package['qty']]);
            }
        }
        
        if ($request->input('product')) {
            foreach ($request->input('product') as $product) {
                $reservation->products()->attach($product['id'], ['rented_qty' => $product['qty']]);
            }
        }
        
        return redirect('reservations');
    }

    private function customValidator(Request $request, $reservationId) {
        $rules = [
            'date' => 'bail|required|date_format:Y-m-d|after_or_equal:today',
            'total' => 'numeric'
        ];

        $messages = [
            'product.required' => 'Debes incluir al menos un producto',
            'date.after_or_equal' => 'No puedes reservar para una fecha pasada'
        ];

        $requiredProducts = [];

		$products = $request->get('product');
		if ($products && is_array($products)) {
			foreach($products as $key => $product) {
				$rules['product.'.$key.'.qty'] = 'required|integer';
				$messages['product.'.$key.'.qty.required'] = 'El campo cantidad debe ser un entero';
				$messages['product.'.$key.'.qty.integer'] = 'El campo cantidad debe ser un entero';

                if(array_key_exists($product['id'], $requiredProducts)) {
                    $requiredProducts[$product['id']] += $product['qty'];
                } else {
                    $requiredProducts[$product['id']] = $product['qty'];
                }
			}
		}
        
        $validator = Validator::make($request->all(), $rules, $messages);

		$packages = $request->get('package');
		if ($packages && is_array($packages)) {
			foreach($packages as $key => $package) {
				$rules['package.'.$key.'.qty'] = 'required|integer';
				$messages['package.'.$key.'.qty.required'] = 'El campo cantidad debe ser un entero';
				$messages['package.'.$key.'.qty.integer'] = 'El campo cantidad debe ser un entero';

                $packageObj = Package::find($package['id']);

                foreach($packageObj->products()->get() as $product) {
                    if(array_key_exists($product->id, $requiredProducts)) {
                        $requiredProducts[$product->id] += $product->pivot->qty;
                    } else {
                        $requiredProducts[$product->id] = ($product->pivot->qty * $package['qty']);
                    }
                }
			}
		}

        $productExceptions = $this->getProductExceptions($requiredProducts, $request->get('date'), $reservationId);

        foreach ($productExceptions as $exception) {
            $validator->getMessageBag()->add('product', $exception);    
        }

        return $validator;
    }

    private function getProductExceptions(array $requiredProducts, $date, $reservationId) {
        $exceptions = [];

        foreach ($requiredProducts as $productId => $quantity) {
            $product_qty = DB::select("SELECT SUM(rprod.rented_qty) as total_prods FROM reservations
                INNER JOIN rentables rprod ON reservations.id = rprod.reservation_id AND rprod.rentable_type LIKE '%Product' AND reservations.id != :reservation
                AND rprod.rentable_id = :id AND reservations.date = :date", ['id' => $productId, 'date' => $date, 'reservation' => $reservationId]);

            $pack_prod_qty = DB::select("SELECT SUM(pp.qty * rpack.rented_qty) as total_prods FROM reservations
                INNER JOIN rentables rpack ON reservations.id = rpack.reservation_id AND reservations.id != :reservation
                AND rpack.rentable_type LIKE '%Package' AND reservations.date = :date
                INNER JOIN package_product pp ON rpack.rentable_id = pp.package_id AND pp.product_id = :id", ['id' => $productId, 'date' => $date, 'reservation' => $reservationId]);

            $total_rented = $product_qty[0]->total_prods + $pack_prod_qty[0]->total_prods;

            $product = Product::find($productId);

            if ($product->quantity < ($total_rented + $quantity)) {
                $exceptions[] = 'No hay suficientes '.$product->name.'(s) disponibles para la fecha seleccionada';
            }
        }
        
        return $exceptions;
    }

    public function detail($id){
        $reservation = Reservation::find($id);
        $products = Product::where('published', true)->get();
        $packages = Package::where('published', true)->get();
        return view('reservations.form', [
                'title' => 'Detalle de reservación',
                'submitText' => 'Actualizar',
                'reservation' => $reservation,
                'packages' => $packages,
                'products' => $products
            ]
        );
    }
}
