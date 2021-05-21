<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization','organization_id');
    }
}
