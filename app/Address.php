<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'address_name', 'address', 'street', 'number', 'colony', 'city', 'state', 'zip', 'lat', 'long', 'addres_type'
    ];

    public $timestamps = false;
}
