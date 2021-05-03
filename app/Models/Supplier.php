<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public function supplier_type()
    {
        return $this->belongsTo('App\Models\SupplierType','supplier_type_id');
    }
}
