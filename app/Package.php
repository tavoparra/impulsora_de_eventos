<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'package_price', 'foreign_package_price', 'published', 'category_id', 'image'
    ];

    public function products() {
        return $this->belongsToMany('App\Product')
                ->withPivot('qty');
    }

    /**
     * Relate product to its category
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function getContentAttribute() {
        $contents = [];
        foreach($this->products as $product) {
            $contents[] = $product->pivot->qty.' '.$product->name;
        }

        return implode(', ', $contents);
    }
}
