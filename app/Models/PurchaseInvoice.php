<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    use HasFactory;
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier','supplier_id');
    }

    public function purchaseFirst()
    {
        return $this->hasMany('App\Models\Purchase','purchase_invoice_id')->take(1);
    }
    public function purchase()
    {
        return $this->hasMany('App\Models\Purchase','purchase_invoice_id')->skip(1)->take(PHP_INT_MAX);
    }
}
