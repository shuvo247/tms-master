<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    public function expense_category()
    {
        return $this->belongsTo('App\Models\ExpenseCategory','expense_category_id');
    }

    public function payment_method()
    {
        return $this->belongsTo('App\Models\PaymentMethod','payment_method_id');
    }
}
