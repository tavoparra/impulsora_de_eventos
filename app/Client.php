<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'email', 'comments', 'status'
    ];


   /**
    * Has one RFC
    */
   public function rfc() {
       return $this->hasOne('App\Rfc');
   }

   /**
    * Has many addresses
    */
   public function addresses() {
       return $this->hasMany('App\Address');
   }
}
