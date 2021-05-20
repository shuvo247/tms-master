<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // Join with Category Table
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
    // Join with brand Table
    public function brand(){
        return $this->belongsTo('App\Models\Brand','brand_id');
    }

    // Join with Product Stock Table
    public function product_stock()
    {
        return $this->hasOne('App\Models\ProductStock','product_id');
    }

    public function variable_product_stock(){
        return $this->hasMany('App\Models\VariableProductStock','product_id');
    }
}
