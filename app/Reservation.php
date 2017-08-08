<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'location', 'customer', 'total'
    ];

    public function packages() {
        return $this->morphedByMany('App\Package', 'rentable')
                ->withPivot('rented_qty');
    }

    public function products() {
        return $this->morphedByMany('App\Product', 'rentable')
                ->withPivot('rented_qty');
    }
}
