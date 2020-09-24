<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        'name', 'category_id', 'seller_id'
    ];

    protected $table = 'subcategories';

    public function category()
    {
        return $this->belongsToMany('App\Models\Category');
    }

}