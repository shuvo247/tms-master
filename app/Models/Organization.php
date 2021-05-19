<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    public function supplier_type()
    {
        return $this->belongsTo('App\Models\SupplierType','organization_type');
    }

    public function SupplierType($supplier_id)
    {
        return $this->belongsTo('App\Models\SupplierType',$supplier_id);
    }
}
