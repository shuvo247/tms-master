<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariableProductStock extends Model
{
    use HasFactory;
    public function size_attribute()
    {
        return $this->hasOne('App\Models\AttributeValue','id','size_attribute_id');
    }
    public function grade_attribute()
    {
        return $this->hasOne('App\Models\AttributeValue','id','grade_attribute_id');
    }
}
