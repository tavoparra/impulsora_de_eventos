<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rfc extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'client_id', 'rfc', 'name', 'address', 'phone', 'email'
    ];
    

    public $timestamps = false;
}
