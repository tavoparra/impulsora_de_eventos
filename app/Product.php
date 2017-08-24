<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'quantity', 'unit_price', 'foreign_price', 'published', 'category_id', 'image'
    ];

    /**
     * Relate product to its category
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
