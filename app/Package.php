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
        'name', 'description', 'package_price', 'published', 'category_id'
    ];

    public function products() {
        return $this->belongsToMany('App\Product')
                ->withPivot('qty');
    }

    public function getContentAttribute() {
        $contents = [];
        foreach($this->products as $product) {
            $contents[] = $product->pivot->qty.' '.$product->name;
        }

        return implode(', ', $contents);
    }
}
