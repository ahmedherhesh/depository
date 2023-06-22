<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depository extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    function delivery()
    {
        return $this->hasMany(Delivery::class,'depot_id')->latest();
    }
}
